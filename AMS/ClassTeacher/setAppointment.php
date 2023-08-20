<?php 

include '../Includes/dbcon.php';
include '../Includes/session.php';

    $query = "SELECT tblclass.className,tblclassarms.classArmName 
    FROM tblclassteacher
    INNER JOIN tblclass ON tblclass.Id = tblclassteacher.classId
    INNER JOIN tblclassarms ON tblclassarms.Id = tblclassteacher.classArmId
    Where tblclassteacher.Id = '$_SESSION[userId]'";

$rs = $conn->query($query);
$num = $rs->num_rows;
$rrw = $rs->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/attnlg.jpg" rel="icon">
  <title>Upload Files</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 50px;
    }
  </style>
</head>


<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
   <?php include "Includes/sidebar.php";?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
           <?php include "Includes/topbar.php";?>
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Class Teacher Dashboard (<?php echo $rrw['className'].' - '.$rrw['classArmName'];?>)</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <!---Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Set Counseling Appointments (<?php echo $rrw['className'].' - '.$rrw['classArmName'];?>)</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Set Appointments</li>
        </ol>
    </div>

    <div class="row mb-3">
        <div class="container">
            <h2>Set Counseling Appointments</h2>
            <form action="process_appointment.php" method="post">
                <!-- Teacher's class and section information -->
                <input type="hidden" name="teacherId" value="<?php echo $_SESSION['userId']; ?>">

                <!-- Appointment date -->
                <div class="mb-3">
                    <label for="appointment-date">Select Appointment Date:</label>
                    <input type="date" class="form-control" name="appointment-date" required>
                </div>

                <!-- Appointment time range -->
                <div class="mb-3">
                    <label for="start-time">Start Time:</label>
                    <input type="time" class="form-control" name="start-time" required>
                </div>
                <div class="mb-3">
                    <label for="end-time">End Time:</label>
                    <input type="time" class="form-control" name="end-time" required>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary">Set Appointment</button>
            </form>
        </div>
    </div>


        <div class="row mb-3">
        <div class="container">
            <h2>View Your Counseling Appointments</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch teacher's appointments from the database
                    $appointmentsQuery = "SELECT * FROM tblcounselingslots WHERE teacherId = '$_SESSION[userId]'";
                    $appointmentsResult = $conn->query($appointmentsQuery);

                    while ($appointmentRow = $appointmentsResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $appointmentRow['date'] . "</td>";
                        echo "<td>" . $appointmentRow['startTime'] . "</td>";
                        echo "<td>" . $appointmentRow['endTime'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
              </table>
          </div>
      </div>

         
      </div>
      
    </div>
    <!-- Footer -->
    <?php include 'includes/footer.php';?>
      <!-- Footer -->
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
</body>
</html>