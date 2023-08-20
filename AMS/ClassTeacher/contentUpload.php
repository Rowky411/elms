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

          <div class="row mb-3">
          <!-- New User Card Example -->
          <div class="container">
            <h2>Upload Content</h2>
            <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                        <!-- <?php 
                        // Fetch course data from the database
                        $courseQuery = "SELECT * FROM `tblclass`";
                        $courseResult = $conn->query($courseQuery);
                        while ($courseRow = $courseResult->fetch_assoc()) {
                            echo "<option value='" . $courseRow['Id'] . "'>" . $courseRow['className'] . "</option>";
                        }
                    ?> -->
                <label for="title">Select Course:</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                
            </div>
            <div class="mb-3">
                <label for="course">Select Course:</label>
                <select class="form-select" name="course">
                    <?php 
                        // Fetch course data from the database
                        $courseQuery = "SELECT * FROM `tblclass`";
                        $courseResult = $conn->query($courseQuery);
                        while ($courseRow = $courseResult->fetch_assoc()) {
                            echo "<option value='" . $courseRow['Id'] . "'>" . $courseRow['className'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="section">Select Section:</label>
                <select class="form-select" name="section">
                    <?php
                        // Fetch section data from the database
                        $sectionQuery = "SELECT * FROM `tblclassarms`";
                        $sectionResult = $conn->query($sectionQuery);
                        while ($sectionRow = $sectionResult->fetch_assoc()) {
                            echo "<option value='" . $sectionRow['Id'] . "'>" . $sectionRow['classArmName'] . "</option>";
                        }

                        // Close the database connection
                        $conn->close();
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="content-type">Select Content Type:</label>
                <select class="form-select" name="content-type">
                <option value="video">Video</option>
                <option value="file">File</option>
                <option value="image">Image</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="content">Upload Content:</label>
                <input type="file" class="form-control" name="content" accept="video/*, image/*, .pdf, .doc, .txt">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
          
          <!--Row-->

          <!-- <div class="row">
            <div class="col-lg-12 text-center">
              <p>Do you like this template ? you can download from <a href="https://github.com/indrijunanda/RuangAdmin"
                  class="btn btn-primary btn-sm" target="_blank"><i class="fab fa-fw fa-github"></i>&nbsp;GitHub</a></p>
            </div>
          </div> -->

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <?php include 'includes/footer.php';?>
      <!-- Footer -->
    </div>
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
