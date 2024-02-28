<?php
session_start();
include('include/config.php');
if(isset($_POST['submit']))
{
$complaintno=$_GET['cid'];
$query=mysqli_query($con,"select * from tblcomplaint where complaintnumber='$complaintno'");
while($arr=mysqli_fetch_array($query)){
$category=$arr['category'];
$state=$arr['state'];
$complaintdetails=$arr['complaintDetails'];
$complaintfile=$arr['complaintfile'];
$email=$arr['email'];
}
$query1=mysqli_query($con,"select lat,lng from locations where complaintNumber='$complaintno'");
while($arr1=mysqli_fetch_array($query))
{
    $latitude=$arr1['lat'];
    $longitude=$$arr1['lng'];
}

}
?>
