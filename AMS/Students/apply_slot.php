<?php
include '../Includes/dbcon.php';
include '../Includes/session.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $studentId = $_SESSION["userId"];
    $slotId = $_POST["slotId"];
    $classId = $_SESSION["classId"];
    $classArmId = $_SESSION["classArmId"];

    // Insert the application into the database
    $insertQuery = "INSERT INTO tblcounselingapplications (studentId, slotId, classId, classArmId) 
                    VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        echo "Error: Statement preparation failed.";
        exit;
    }

    // Bind parameters
    $stmt->bind_param("iiii", $studentId, $slotId, $classId, $classArmId);

    // Execute the statement
    if ($stmt->execute()) {
        // Success: Inserted the application
        echo "<script type = \"text/javascript\">
                window.location = (\"applyCounseling.php\")
                </script>";
    } else {
        // Error: Failed to insert the application
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
