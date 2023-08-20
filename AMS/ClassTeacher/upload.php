<?php

include '../Includes/session.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle the uploaded file
    if (isset($_FILES["content"]) && $_FILES["content"]["error"] === 0) {
        $targetDir = "C:/xampp/htdocs/elms/AMS/img/"; // Change this to your desired directory
        $targetFile = $targetDir . basename($_FILES["content"]["name"]);
        $uploadSuccess = move_uploaded_file($_FILES["content"]["tmp_name"], $targetFile);

        if ($uploadSuccess) {
            // Get form data
            $title = $_POST["title"];
            $courseId = $_POST["course"];
            $sectionId = $_POST["section"];
            $contentType = $_POST["content-type"];
            $contentFileName = $_FILES["content"]["name"];
            $uploadDate = date("Y-m-d H:i:s");

            // Insert data into the database (You need to establish a database connection here)
            include '../Includes/dbcon.php';

            $insertQuery = "INSERT INTO tblteacheruploads (teacherId, courseId, sectionId, title, contentType, contentFileName, uploadDate) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("iiissss", $teacherId, $courseId, $sectionId, $title, $contentType, $contentFileName, $uploadDate);

            // Replace $teacherId with the actual teacher ID
            $teacherId = 1; // Change this to the logged-in teacher's ID

            if ($stmt->execute()) {
                echo "<script type = \"text/javascript\">
                window.location = (\"contentUpload.php\")
                </script>"; 
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the database connection
            $stmt->close();
            $conn->close();
        } else {
            echo "File upload failed.";
        }
    }
}
?>
