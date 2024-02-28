<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['d_login'])==0)
  { 
header('location:index.php');
}
else{ 
  $complaintno=$_GET['cid'];


  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>CCP | REPORT GENERATE</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
 
  </head>

  <body>
<?php
  $query=mysqli_query($con,"select *from test where complaintNumber='$complaintno'");
  while($arr=mysqli_fetch_array($query))
  {
  ?>
  <section id="container" >
     <?php include("includes/header.php");?>
      <?php include("includes/sidebar.php");?>
      <section id="main-content">
          <section class="wrapper">
          	<h3>Report generate</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	

                 

                      <form class="form-horizontal style-form" method="post" name="complaint" enctype="multipart/form-data" action="test5.php">







                      <div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">CNO:</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="cno" name="cno" required="required" value="<?Php echo $complaintno; ?>"   readonly>
</div>
  </div>

<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Email:</label>
<div class="col-sm-4">
<!--<input type="email" name="Email" required="required" class="form-control"> -->
<input type="email" class="form-control" id="email" name="email" required="required" value="<?php echo $arr['email'];?>" readonly>
</div>
</div>

<?php 
$userid=$arr['userId'];
$query2=mysqli_query($con,"select fullName,contactno from users where id='$userid'");
while($arr2=mysqli_fetch_array($query2))
{
?>
<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Name:</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="name" name="name" required="required" 
value="<?Php echo $arr2['fullName'];?>" readonly>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">PHONE:</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="contactno" name="contactno" required="required" 
value="<?Php echo $arr2['contactno'];?>" readonly>
</div>
</div>
<?php } ?>
<?php } ?>
<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Subject: </label>
<div class="col-sm-6">
<textarea  name="subject" required="required" cols="10" rows="10" class="form-control" maxlength="2000"></textarea>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Complaint Related Doc(if any) </label>
<div class="col-sm-4">
<input type="file" name="compfile" class="form-control" value="">
</div>
</div>



                          <div class="form-group">
                           <div class="col-sm-10" style="padding-left:25% ">
<button type="submit" name="submit" class="btn btn-primary">CREATE</button>
</div>
</div>

                          </form>
                          </div>
                          </div>
                          </div>
                          
          	
          	
		</section>
      </section>
    <?php include("includes/footer.php");?>
  </section>

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
<?php } ?> 
