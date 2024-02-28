<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
  { 
header('location:index.php');
}
else {
  if(isset($_POST['update']))
  {
// $complaintnumber=$_GET['cid'];
// $status=$_POST['status'];
// $remark=$_POST['remark'];
// $query=mysqli_query($con,"insert into complaintremark(complaintNumber,status,remark) values('$complaintnumber','$status','$remark')");
// $sql=mysqli_query($con,"update tblcomplaints set status='$status' where complaintNumber='$complaintnumber'");

// echo "<script>alert('Complaint details updated successfully');</script>";

  }

 ?>
<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}ser
function f3()
{
window.print(); 
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>User Profile</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="anuj.css" rel="stylesheet" type="text/css">
</head>
<body>

<div style="margin-left:50px;">
 <form name="updateticket" id="updatecomplaint" method="post"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <?php

$query=mysqli_query($con,"select * from tblcomplaints where complaintNumber='".$_GET['cid']."'");
while($arry=mysqli_fetch_array($query))
{
    
    $userId=$arry['userId'];
     $category=$arry['category'];
     $subject=$arry['complaintDetails'];
}

echo "<tr> <td> <b> Complain </b> </td>";
echo "     <td> ".$userId."</td></tr>";






echo "<tr> <td> <b> Complain </b> </td>";
echo "     <td> ".$subject."</td></tr>";

echo "<tr> <td> <b> category </b> </td>";
echo "     <td> ".$category."</td></tr>";
?>


   



       <!-- <tr><td colspan="2">&nbsp;</td></tr> -->
    
    <!-- <tr>
  <td></td>
      <td >   
      <input name="Submit2" type="submit" class="txtbox4" value="Close this window " onClick="return f2();" style="cursor: pointer;"  /></td>
    </tr> -->
   

 
</table>
 </form>
</div>

</body>
</html>

     <?php
     } 
     ?>