<?php
session_start();
include("includes/config.php");
$_SESSION['d_login']=="";
date_default_timezone_set('Asia/Kolkata');
$ldate=date( 'd-m-Y h:i:s A', time () );
mysqli_query($con,"UPDATE deptlog  SET logout = '$ldate' WHERE Dept_name = '".$_SESSION['d_login']."' ORDER BY id DESC LIMIT 1");
session_unset();

?>
<script language="javascript">
document.location="../index.html";
</script>
