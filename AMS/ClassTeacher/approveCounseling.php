<?php 
include '../Includes/dbcon.php';
include '../Includes/session.php';

$query = "SELECT tblclass.className, tblclassarms.classArmName 
          FROM tblclassteacher
          INNER JOIN tblclass ON tblclass.Id = tblclassteacher.classId
          INNER JOIN tblclassarms ON tblclassarms.Id = tblclassteacher.classArmId
          WHERE tblclassteacher.Id = '$_SESSION[userId]'";

$rs = $conn->query($query);
$num = $rs->num_rows;
$rrw = $rs->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- ... (your head section) ... -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/attnlg.jpg" rel="icon">
  <title>Counseling</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

          <!-- Pending Counseling Requests -->
          <div class="card mb-4">
            <div class="card-header">
              Pending Counseling Requests
            </div>
            <div class="card-body">
              <table class="table">
                <!-- Table header here -->
                <thead>
                    <tr>
                    <th>Student ID</th>
                    <th>Slot ID</th>
                    <th>Counseling Date and Time</th>
                    <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                  <!-- Fetch and display pending counseling requests from tblcounselingapplications -->
                  <?php
                  $pendingQuery = "SELECT * FROM tblcounselingapplications WHERE status = 'Pending'";
                  $pendingResult = $conn->query($pendingQuery);

                  while ($pendingRow = $pendingResult->fetch_assoc()) {
                    echo "<tr>";
                    // Display necessary columns
                    echo "<td>{$pendingRow['studentId']}</td>";
                    echo "<td>{$pendingRow['slotId']}</td>";
                    echo "<td>{$pendingRow['applicationDate']}</td>";
                    echo "<td>
                    <form action='approveCounseling_process.php' method='post'>
                      <input type='hidden' name='slotId' value='{$pendingRow['slotId']}'>
                      <button class='btn btn-primary' type='submit' name='approveBtn'>Approve</button>
                    </form>
                    </td>";
                    echo "</tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Approved Counselings -->
          <div class="card mb-4">
            <div class="card-header">
              Approved Counselings
            </div>
            <div class="card-body">
            <table class="table">
            <thead>
                <tr>
                <th>Student ID</th>
                <th>Slot ID</th>
                <th>Counseling Date and Time</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $approvedQuery = "SELECT * FROM tblcounselingapplications WHERE status = 'Approved'";
                $approvedResult = $conn->query($approvedQuery);

                while ($approvedRow = $approvedResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$approvedRow['studentId']}</td>";
                    echo "<td>{$approvedRow['slotId']}</td>";
                    echo "<td>{$approvedRow['applicationDate']}</td>";
                    echo "<td>Approved</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
            </table>
            </div>
          </div>
        </div>
        <!---Container Fluid-->
      </div>
    </div>
    <!-- <?php include 'includes/footer.php';?> -->
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