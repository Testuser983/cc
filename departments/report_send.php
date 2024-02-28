<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['d_login']) == 0) {
  header('location:index.php');
  }
  else{
    
    if(isset($_POST['submit']))
    {
      $Subject=$_POST["subject"];
    $email=$_POST["email"];

    // File upload handling
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["compfile"]["name"]);
    move_uploaded_file($_FILES["compfile"]["tmp_name"], $target_file);

    // Email content
    $subject = "Contact Form Submission";
    
    $message .= "Email: $email\n";
    $message = "Subject: $Subject\n";

    // Set up email headers
    $headers = "From: rishalp79@gmail.com"; // Change this to your email address

    // Boundary for multipart email
    $boundary = uniqid('np');

    // Headers for attachment
    $headers .= "\nMIME-Version: 1.0\n";
    $headers .= "Content-Type: multipart/mixed; boundary=$boundary\n";

    // Message text
    $body = "--$boundary\n";
    $body .= "Content-Type: text/plain; charset=ISO-8859-1\n";
    $body .= "Content-Transfer-Encoding: 7bit\n\n";
    $body .= $message . "\n";

    // Attachment
    $body .= "--$boundary\n";
    $body .= "Content-Type: application/octet-stream; name=\"" . basename($target_file) . "\"\n";
    $body .= "Content-Transfer-Encoding: base64\n";
    $body .= "Content-Disposition: attachment\n\n";
    $body .= chunk_split(base64_encode(file_get_contents($target_file))) . "\n";
    $body .= "--$boundary--\n";

    // Send email
    $success = mail($email, $subject, $body, $headers);

    // Display success or error message
    if ($success) {
        echo "Thank you for your submission!";
    } else {
        echo "Error: Unable to send email.";
    }
}


    

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>CCP | REPORT SEND</title>

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
$query=mysqli_query($con,"select email from test where complaintNumber='".$_GET['cid']."'");
while($arr=mysqli_fetch_array($query)){


?>
  <section id="container" >
     <?php include("includes/header.php");?>
      <?php include("includes/sidebar.php");?>
      <section id="main-content">
          <section class="wrapper">
          	<h3>Report Send</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-10 ">
                  <div class="form-panel">
                  	

                 

                      <form class="form-horizontal style-form" method="post" name="complaint" enctype="multipart/form-data" >








<div class="form-group">


<label class="col-sm-2 col-sm-2 control-label">Email:</label>
<div class="col-sm-4">
<!--<input type="email" name="Email" required="required" class="form-control"> -->
<input type="email" class="form-control" id="email" name="email" required="required" value="<?php echo $arr['email']; ?>" readonly>
</div>
</div>
<?php }?>
<div class="form-group">

<label class="col-sm-2 col-sm-2 control-label">Subject: </label>
<div class="col-sm-6">
<textarea  name="subject" required="required" cols="10" rows="10" class="form-control" maxlength="2000"></textarea>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Report</label>
<div class="col-sm-4">
<input type="file" name="compfile" class="form-control" value="">
</div>
</div>




                          <div class="form-group">
                           <div class="col-sm-10" style="padding-left:25% ">
<button type="submit" name="submit" class="btn btn-primary">Submit</button>
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