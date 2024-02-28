<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else { ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>CCP | Admin Dashboard</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="../users/assets/css/bootstrap.css" rel="stylesheet"> -->
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="../users/assets/lineicons/style.css">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="../users/assets/js/chart-master/Chart.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
  </head>

  <body>
    <?php include("include/header.php"); ?>
    <div class="wrapper">
      <div class="container">
        <div class="row">
          <?php include('include/sidebar.php'); ?>
          <div class="span9">
            <div class="module">
              <div class="module-head">
                <h3>Admin Dashboard</h3>
              </div>
              <!-- <div class="col-lg-9 main-chart">
                  
                  
                  	<div class="col-md-2 col-sm-2 box0">
                        <div>
                 
                  </div></div> -->




              <div class="col-md-2 col-sm-2 box0">
                <div class="box1">
                  <span class="li_news"></span>
                  <?php

                  $rt = mysqli_query($con,"SELECT * FROM tblcomplaints where status is null");
                  $num1 = mysqli_num_rows($rt);
                  // {
                  ?>
                  <h3>
                    <?php
                    echo htmlentities($num1);
                    ?>
                  </h3>
                </div>
                <p><?php
                    echo htmlentities($num1);
                    ?>
                  Complaints not Process yet
                </p>
              </div>
              <?php
              // }
              ?>


              <div class="col-md-2 col-sm-2 box0">
                <div class="box1">
                  <span class="li_news"></span>
                  <?php
                    $status="in Process";                   
                  $rt = mysqli_query($con,"SELECT * FROM tblcomplaints where status='$status'");
                  $num1 = mysqli_num_rows($rt);
                  {
                  ?>
                  <h3><?php
                      echo htmlentities($num1);
                      ?></h3>
                </div>
                <p><?php
                    echo htmlentities($num1);
                    ?> Complaints Status in process</p>
              </div>
              <?php
              }
              ?>

              <div class="col-md-2 col-sm-2 box0">
                <div class="box1">
                  <span class="li_news"></span>
                  <?php
                    $status="closed";                   
                  $rt = mysqli_query($con,"SELECT * FROM tblcomplaints where status='$status'");
                  $num1 = mysqli_num_rows($rt);
                  {
                  ?>
                  <h3><?php
                      echo htmlentities($num1);
                      ?></h3>
                </div>
                <p><?php
                    echo htmlentities($num1);
                    ?> Complaint has been closed</p>
              </div>

            <?php } ?>


            </div><!-- /row mt -->



          </div>
        </div>
      </div>
    </div>





    <?php include("include/footer.php"); ?>


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>
    <script src="assets/js/zabuto_calendar.js"></script>
  </body>

  </html>
  <?php
  } 
  ?>