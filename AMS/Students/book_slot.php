<?php
include '../Includes/session.php';
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $studentId = $_SESSION['userId']; // Assuming student ID is stored in a session
    $classId = $_POST["class"];
    $sectionId = $_POST["section"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    // Insert data into the database (You need to establish a database connection here)
    include '../Includes/dbcon.php';

    $insertQuery = "INSERT INTO tblcounselingslots (studentId, classId, sectionId, date, time) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("iiiss", $studentId, $classId, $sectionId, $date, $time);

    if ($stmt->execute()) {
        echo "<script type = \"text/javascript\">
                window.location = (\"counseling.php\")
                </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
