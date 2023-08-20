<?php
include '../Includes/dbcon.php';
include '../Includes/session.php';

if (isset($_POST['approveBtn'])) {
    $counselingId = $_POST['slotId'];

 
    $updateQuery = "UPDATE tblcounselingapplications SET status = 'Approved' WHERE slotId = ?";
    $stmt = $conn->prepare($updateQuery);

   
    if ($stmt === false) {
        echo "Error: Statement preparation failed.";
        exit;
    }

  
    $stmt->bind_param("i", $counselingId);

    
    if ($stmt->execute()) {
       
        header("Location: approveCounseling.php"); 
    } else {
       
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
