<?php session_start();
include('includes/config.php');
error_reporting(0);

//validation page
/*if($_SESSION['emailid']=='' )
{
echo "<script>window.location.href='wecome.php'</script>";
}
      else{

		if(isset($_POST['verify']))
						{
						//Getting Post values
						$emailid=$_SESSION['emailid'];	
						$otp=$_POST['emailotp'];	
						// Getting otp from database on the behalf of the email
						$stmt=$con->prepare("SELECT emailOtp FROM  users where emailId=:emailid");
						$stmt->execute(array(':emailid'=>$emailid)); 
						while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
						$dbotp=$row['emailOtp'];
						}
		if($dbotp!=$otp)
		{
			echo "<script>alert('Please enter correct OTP');</script>";	
		} 
		else 
		{
		$emailverifiy=1;
		$sql="update tblusers set isEmailVerify=:emailverifiy where emailId=:emailid";
		$query = $dbh->prepare($sql);
		// Binding Post Values
		$query->bindParam(':emailid',$emailid,PDO::PARAM_STR);
		$query->bindParam(':emailverifiy',$emailverifiy,PDO::PARAM_STR);
		$query->execute();	
		session_destroy();
		echo "<script>alert('OTP verified successfully');</script>";	
		echo "<script>window.location.href='login.php'</script>";
		}
	}
}*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>CCP | User Registration</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
<!--<style>
body {
	color: #999;
	background: #e2e2e2;
	font-family: 'Roboto', sans-serif;
}
.form-control {
	min-height: 41px;
	box-shadow: none;
	border-color: #e1e1e1;
}
.form-control:focus {
	border-color: #00cb82;
}	
.form-control, .btn {        
	border-radius: 3px;
}
.form-header {
	margin: -30px -30px 20px;
	padding: 30px 30px 10px;
	text-align: center;
	background: #00cb82;
	border-bottom: 1px solid #eee;
	color: #fff;
}
.form-header h2 {
	font-size: 34px;
	font-weight: bold;
	margin: 0 0 10px;
	font-family: 'Pacifico', sans-serif;
}
.form-header p {
	margin: 20px 0 15px;
	font-size: 17px;
	line-height: normal;
	font-family: 'Courgette', sans-serif;
}
.signup-form {
	width: 390px;
	margin: 0 auto;	
	padding: 30px 0;	
}
.signup-form form {
	color: #999;
	border-radius: 3px;
	margin-bottom: 15px;
	background: #f0f0f0;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}		
.signup-form label {
	font-weight: normal;
	font-size: 14px;
}
.signup-form input[type="checkbox"] {
	position: relative;
	top: 1px;
}
.signup-form .btn {        
	font-size: 16px;
	font-weight: bold;
	background: #00cb82;
	border: none;
	min-width: 200px;
}
.signup-form .btn:hover, .signup-form .btn:focus {
	background: #00b073 !important;
	outline: none;
}
.signup-form a {
	color: #00cb82;		
}
.signup-form a:hover {
	text-decoration: underline;
}
</style> 
</head> -->
<body>
<div id="login-page">
	  	<div class="container">
	<h3 align="center" style="color:#fff"><a href="../index.html" style="color:#fff">Citizen Complaint portal</a></h3>
	<hr />
		      <form class="form-login" method="post">
		        <h2 class="form-login-heading">OTP VERIFICATION</h2>
		      
		        <div class="login-wrap">
					
		         <input type="text" class="form-control"  placeholder="Email otp"  name="emailotp" required="required" maxlength="6">
		           
		            <br>
		            
		            <button class="btn btn-theme btn-block"  type="submit" name="submit" id="submit">VERIFY</button>
		            
		            
		            
		
		        </div>
		
		      
		
		      </form>	  	
	  	
	  	</div>
	  </div>
	  <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>
</body>
</html>