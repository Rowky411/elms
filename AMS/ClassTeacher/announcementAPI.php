<?php
include '../Includes/session.php'; // Include your session handling

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $teacherId = $_SESSION['userId']; // Get teacher ID from session

    // Fetch teacher's classId and classArmId from tblclassteacher table
    include '../Includes/dbcon.php'; // Include your database connection
    $fetchQuery = "SELECT classId, classArmId FROM tblclassteacher WHERE Id = ?";
    $stmt = $conn->prepare($fetchQuery);
    $stmt->bind_param("i", $teacherId);
    $stmt->execute();
    $stmt->bind_result($classId, $classArmId);
    $stmt->fetch();
    $stmt->close();

    // Get other form data
    $announcementTitle = $_POST["announcementTitle"];
    $announcementContent = $_POST["announcementContent"];
    $announcementDate = date("Y-m-d H:i:s");

    // Insert announcement into the database
    $insertQuery = "INSERT INTO tblannouncements (teacherId, classId, classArmId, announcementTitle, announcementContent, announcementDate)
                    VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("iissss", $teacherId, $classId, $classArmId, $announcementTitle, $announcementContent, $announcementDate);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>
            window.location = 'makeAnnouncement.php'; // Redirect to the same page
        </script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>