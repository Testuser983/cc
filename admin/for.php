<?php
session_start();
include('include/config.php');
// if(strlen($_SESSION['alogin'])==0)
//   { 
// header('location:index.php');
// }
// else {
  if(isset($_POST['update']))
  {
$complaintnumber=$_GET['cid'];
$status=$_POST['status'];
$remark=$_POST['remark'];
$query=mysqli_query($con,"insert into complaintremark(complaintNumber,status,remark) values('$complaintnumber','$status','$remark')");
$sql=mysqli_query($con,"update tblcomplaints set status='$status' where complaintNumber='$complaintnumber'");

echo "<script>alert('Complaint details updated successfully');</script>";

  
 

  $query1=mysqli_query($con,"select lat,lng from locations where complaintNumber='$complaintnumber'");
  while($arr1=mysqli_fetch_array($query))
  {
      $latitude=$arr1['lat'];
      $longitude=$$arr1['lng'];
  }
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
<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
</head>
<body>

<div style="margin-left:50px;">
 <form name="updateticket" id="updatecomplaint" method="post" action="forward-complaint.php"> 
    
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td  >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr height="50">
      <td><b>Complaint Number</b></td>
      <td><?php echo htmlentities($_GET['cid']); ?></td>
    </tr>
    <tr height="50">
      <td><b>Status</b></td>
      <td><select name="status" required="required">
      <option value="">Select Status</option>
      <option value="in process">In Process</option>
    <option value="closed">Closed</option>
        
      </select></td>
    </tr>


      <tr height="50">
      <td><b>Remark</b></td>
      <td><textarea name="remark" cols="50" rows="14" required="required"></textarea></td>
    </tr>
    <tr height="50">
    <td>Department</td>

<td><select>
<?php $sql=mysqli_query($con,"select fullName from Department");
while ($rw=mysqli_fetch_array($sql)) {
  ?>
  <option value="<?php echo htmlentities($rw['fullName']);?>"><?php echo htmlentities($rw['fullName']);?></option>
<?php
}
?></select></td>
    </tr>
    
<tr>
<td>
    
</td>

</tr>

        <tr height="50">
      <td>&nbsp;</td>
      <td><input type="submit" name="update" value="Submit"></td>
    </tr>



       <tr><td colspan="2">&nbsp;</td></tr>
    
    <tr>
  <td></td>
      <td >   
      <input name="Submit2" type="submit" class="txtbox4" value="Close this window " onClick="return f2();" style="cursor: pointer;"  /></td>
    </tr>
   

 
</table>
 </form>
</div>
<?Php 
$complaintno=$_GET['cid'];
  $query=mysqli_query($con,"select *from tblcomplaints where complaintNumber='$complaintno'");
  while($arr=mysqli_fetch_array($query)){
  $category=$arr['category'];
  $state=$arr['state'];
  $complaintdetails=$arr['complaintDetails'];
  $complaintfile=$arr['complaintFile'];
  $email=$arr['email'];
  }
?>
<table>
    <tr>
        <td><?php echo $category; ?></td>
        <td><?php echo $state; ?></td>
        <td><?php echo $complaintdetails; ?></td>
        <td><?php echo $complaintfile; ?></td>
        <td><?php echo $email; ?></td>
    </tr>
</table>
<?php
$v_category=$category;
$v_state=$state;
$v_complaintDetails=$complaintdetails;
$v_complaintfile=$complaintfile;
$v_email=$email;

mysqli_query($con,"insert into view_complaint values('$complaintno','$v_category',$v_state','$v_complaintDetails','$v_email') ");

?>
</body>
</html>

     <?php 
    // } 
    ?>