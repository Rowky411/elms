
<?php 
include '../Includes/dbcon.php';
include '../Includes/session.php';


  $query = "SELECT * FROM tblstudents WHERE Id = ".$_SESSION['userId']."";
  $rs = $conn->query($query);
  $num = $rs->num_rows;
  $rows = $rs->fetch_assoc();
  $fullName = $rows['firstName']." ".$rows['lastName'];


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
  <title>Dashboard</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
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
            <h1 class="h3 mb-0 text-gray-800"><?php echo $fullName;?> </h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
             <?php 
              $query1 = mysqli_query($conn, "SELECT tblclass.className 
                                              FROM tblclass 
                                              INNER JOIN tblstudents ON tblclass.Id = tblstudents.classId
                                              WHERE tblstudents.Id = '$_SESSION[userId]' 
                                              AND tblstudents.admissionNumber = '$_SESSION[admissionNumber]'");                       

              $className = mysqli_fetch_assoc($query1)['className'];
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Class</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $className;?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span>Since last month</span> -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chalkboard fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
             <?php 
              $query1 = mysqli_query($conn, "SELECT tblclassarms.classArmName 
                                              FROM tblclassarms 
                                              INNER JOIN tblstudents ON tblclassarms.Id = tblstudents.classArmId
                                              WHERE tblstudents.Id = '$_SESSION[userId]' 
                                              AND tblstudents.admissionNumber = '$_SESSION[admissionNumber]'");                       

              $classArmName = mysqli_fetch_assoc($query1)['classArmName'];
              ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Section</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $classArmName;?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                        <span>Since last years</span> -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-code-branch fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Pending Requests Card Example -->
            <?php 
            $query1=mysqli_query($conn,"SELECT * from tblattendance where admissionNo = '$_SESSION[admissionNumber]'");                       
            $totAttendance = mysqli_num_rows($query1);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Attendance</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totAttendance;?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <!-- <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span> -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12 mb-4">
              <div class="card">
                  <div class="card-header">
                      Announcements
                  </div>
                  <div class="card-body">
                      <ul class="list-group list-group-flush">
                          <?php
                          // Fetch announcements for the current student's classArms
                          $classArmId = $rows['classArmId'];
                          $announcementsQuery = "SELECT * FROM tblannouncements WHERE classArmId = '$classArmId'";
                          $announcementsResult = $conn->query($announcementsQuery);

                          while ($announcementRow = $announcementsResult->fetch_assoc()) {
                              echo '<li class="list-group-item">';
                              echo '<h6>' . $announcementRow['announcementTitle'] . '</h6>';
                              echo '<p class="mb-0">' . $announcementRow['announcementContent'] . '</p>';
                              echo '</li>';
                          }
                          ?>
                      </ul>
                  </div>
              </div>
          </div>
        </div>
        <!---Container Fluid-->
      </div>
    </div>
    <?php include 'includes/footer.php';?>
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