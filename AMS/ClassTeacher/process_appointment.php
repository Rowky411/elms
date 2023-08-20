<?php
include '../Includes/dbcon.php';
include '../Includes/session.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $teacherId = $_POST["teacherId"];
    $classId = $_SESSION["classId"];
    $sectionId = $_SESSION["classArmId"];
    $appointmentDate = $_POST["appointment-date"];
    $startTime = $_POST["start-time"];
    $endTime = $_POST["end-time"];

    // Insert the appointment into the database
    $insertQuery = "INSERT INTO tblcounselingslots (classId, sectionId, date, teacherId, startTime, endTime) 
                    VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("iisiss", $classId, $sectionId, $appointmentDate, $teacherId,  $startTime, $endTime);

    if ($stmt->execute()) {
        echo "<script type = \"text/javascript\">
                window.location = (\"setAppointment.php\")
                </script>"; 
    } else {
        // Error: Failed to insert the appointment
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
