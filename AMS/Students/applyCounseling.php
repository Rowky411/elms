<?php 
include '../Includes/dbcon.php';
include '../Includes/session.php';

$query = "SELECT * FROM tblstudents WHERE Id = ".$_SESSION['userId']."";
$rs = $conn->query($query);
$num = $rs->num_rows;
$rows = $rs->fetch_assoc();
$fullName = $rows['firstName']." ".$rows['lastName'];

// Fetch available counseling slots for the student's class and section
$slotsQuery = "SELECT * FROM tblcounselingslots
               WHERE classId = ".$_SESSION['classId']." AND sectionId = ".$_SESSION['classArmId']."";
$slotsResult = $conn->query($slotsQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- ... (rest of your head section) ... -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/attnlg.jpg" rel="icon">
  <title>Student Counseling Booking</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
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
          
          <!-- View Available Counseling Slots -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  Available Counseling Slots
                </div>
                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($slotRow = $slotsResult->fetch_assoc()) { ?>
                        <tr>
                          <td><?php echo $slotRow['date']; ?></td>
                          <td><?php echo $slotRow['startTime']; ?></td>
                          <td><?php echo $slotRow['endTime']; ?></td>
                          <td>
                            <form action="apply_slot.php" method="post">
                              <input type="hidden" name="slotId" value="<?php echo $slotRow['Id']; ?>">
                              <button type="submit" class="btn btn-primary">Apply</button>
                            </form>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
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