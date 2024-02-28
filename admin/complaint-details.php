
<?php
session_start();
include('include/config.php');
require("include/db.php");
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	$complaintno=$_GET['cid'];
	if(isset($_POST['submit']))
	{
	  $dept=$_POST['department'];
	  
	  $query=mysqli_query($con,"select *from tblcomplaints where complaintNumber='$complaintno'");
	  while($arr=mysqli_fetch_array($query)){
	  $category=$arr['category'];
	  $state=$arr['state'];
	  $complaintdetails=$arr['complaintDetails'];
	  $complaintfile=$arr['complaintFile'];
	  $email=$arr['email'];
	  $regDate=$arr['regDate'];
	  }
	  $query2=mysqli_query($con,"select lat,lng from locations where complaintNumber='$complaintno'");
	while($arr2=mysqli_fetch_array($query2))
	{
	$latit=$arr2['lat'];
	$lngitu=$arr2['lng'];
	}
 $userid=$_SESSION['uid'];
	$query=mysqli_query($con,"insert into test(complaintNumber,userId,category,state,complaintDetails,complaintFile,regDate,lat,lng,department,email) values('$complaintno','$userid','$category','$state','$complaintdetails','$complaintfile','$regDate','$latit','$lngitu','$dept','$email')");
//  $status='forward';
	// $query3=mysqli_query($con,"update complaintremark set status='$status' where complaintNumber='$complaintno'");
	// code for show complaint number
	$sql=mysqli_query($con,"select complaintNumber from test order by complaintNumber desc limit 1");
	while($row=mysqli_fetch_array($sql))
	{
	 $cmpn=$row['complaintNumber'];
	}
	$complainno=$cmpn;
	echo '<script> alert("Your complain has been forward to department")</script>';
	}
	function get_saved_locations(){
		$con=mysqli_connect ("localhost", 'root', '','test');
		if (!$con) {
			die('Not connected : ' . mysqli_connect_error());
		}
		// update location with location_status if admin location_status.
		$cno=$_GET['cid'];
		$sqldata = mysqli_query($con,"select lng,lat from locations where complaintNumber='$cno'");
	
		$rows = array();
		while($r = mysqli_fetch_assoc($sqldata)) {
			$rows[] = $r;
	
		}
		$indexed = array_map('array_values', $rows);
	
		//  $array = array_filter($indexed);
	
		echo json_encode($indexed);
		if (!$rows) {
			return null;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Complaint Details</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>

	<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
	<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />
	<style>
	</style>
	<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
	<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />



	<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}
function popUpWindo(URLStr, left, top, width, height)
{
	popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+400+',height='+450+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>
<style>
		#map {
			height: 275px;
			width: 355px;
		}
	</style>
</head>
<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

						


						<div class="module">
							<div class="module-head">
								<h3>Complaint Details</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									
									<tbody>

<?php $st='closed';
$query=mysqli_query($con,"select tblcomplaints.*,users.fullName as name,category.categoryName as catname from tblcomplaints join users on users.id=tblcomplaints.userId join category on category.id=tblcomplaints.category where tblcomplaints.complaintNumber='".$_GET['cid']."'");
while($row=mysqli_fetch_array($query))
{
$_SESSION['uid']=$row['userId'];
?>				
<form class="form-login" name="forgot" method="post">
			<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Complaint Number #<?php echo htmlentities($row['complaintNumber']); ?></h4>
						</div>
						<div class="modal-body">
							<label>Forward to</label>
                            
							<select class="form-control" name="department" >
								<option value="">select Department</option>
								<?php $sql = mysqli_query($con, "select id,fullName from department ");
                        while ($rw = mysqli_fetch_array($sql)) {
                        ?>
                          <option value="<?php echo htmlentities($rw['id']);?>"><?php echo htmlentities($rw['fullName']);?></option>
                        <?php
                        }
                        ?>
							</select>



						</div>
						<div class="modal-footer">
							<button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
							<button class="btn btn-theme" type="submit" name="submit">Submit</button>
						</div>
					</div>
				</div>
			</div>
			<!-- modal -->
		</form>					
										<tr>
											<td><b>Complaint Number</b></td>
											<td><?php echo htmlentities($row['complaintNumber']);?></td>
											<td><b>Complainant Name</b></td>
											<td> <?php echo htmlentities($row['name']);?></td>
											<td><b>Reg Date</b></td>
											<td><?php echo htmlentities($row['regDate']);?>
											</td>
										</tr>

										<tr>
											<td><b>Category </b></td>
											<td><?php echo htmlentities($row['catname']);?></td>
											
										</tr>
										<tr>
											<td><b>State </b></td>
											<td><?php echo htmlentities($row['state']);?></td>
											<td><b>File(if any) </b></td>
											
											<td colspan="5"> <?php $cfile=$row['complaintFile'];
											if($cfile=="" || $cfile=="NULL")
											{
											echo "File NA";
											}
											else{?>
											<a href="../users/complaintdocs/<?php echo htmlentities($row['complaintFile']);?>" target="_blank"/> View File</a>
											<?php } ?></td>
										
										</tr>
										<tr>
											<td><b>Complaint Details </b></td>
											
											<td colspan="5"> <?php echo htmlentities($row['complaintDetails']);?></td>
											
										</tr>
										<tr>
												<td><b>Location</b></td>
												<td colspan="5">
													<div id="map"></div>
													<script>
														var saved_markers = <?= get_saved_locations() ?>;
														var user_location = [77.216721, 28.644800];
														mapboxgl.accessToken = 'pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';
														var map = new mapboxgl.Map({
															container: 'map',
															style: 'mapbox://styles/mapbox/streets-v9',
															center: user_location,
															zoom: 10
														});
				

													</script>
													<script src="./scripts/script.js"></script>

												</td>
											</tr>

											</tr>
										
										

										<tr>
										<td><b>Final Status</b></td>
												
										<td colspan="5">
											<?php if($row['status']=="")
												{ echo "Not Process Yet";
												} 
												else {
													echo htmlentities($row['status']);
													}
											?>
										</td>
											
										</tr>

<?php $ret=mysqli_query($con,"select complaintremark.remark as remark,complaintremark.status as sstatus,complaintremark.remarkDate as rdate from complaintremark join tblcomplaints on tblcomplaints.complaintNumber=complaintremark.complaintNumber where complaintremark.complaintNumber='".$_GET['cid']."'");
while($rw=mysqli_fetch_array($ret))
{
?>
<tr>
<td><b>Remark</b></td>
<td colspan="5"><?php echo  htmlentities($rw['remark']); ?><b>Remark Date :</b><?php echo  htmlentities($rw['rdate']); ?></td>
</tr>

<tr>
<td><b>Status</b></td>
<td colspan="5"><?php echo  htmlentities($rw['sstatus']); ?></td>
</tr>
<?php } ?>





<tr>
											<td><b>Action</b></td>
											
											<td> 
											<?php if($row['status']=="closed"){

												} else {?>
<a href="javascript:void(0);" onClick="popUpWindow('http://localhost/ccp/admin/updatecomplaint.php?cid=<?php echo htmlentities($row['complaintNumber']);?>');" title="Update order">
											 <button type="button" class="btn btn-primary">Take Action</button></td>
											 
											</a><?php } ?></td>

											<td> 

											<a data-toggle="modal" href="#myModal">
		<button class="btn btn-primary">FORWARD</button></a>
						
											<td colspan="4"> 
											<a href="javascript:void(0);" onClick="popUpWindow('http://localhost/ccp/admin/userprofile.php?uid=<?php echo htmlentities($row['userId']);?>');" title="Update order">
											 <button type="button" class="btn btn-primary">View User Detials</button></a></td>
											
										</tr>
										<?php  } ?>
										
								</table>
							</div>
						</div>						

						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

	
<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>
<?php } ?>