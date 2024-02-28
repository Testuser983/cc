<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {

  if (isset($_POST['submit'])) {
    $uid = $_SESSION['id'];
    $category = $_POST['category'];
    $Useremail = $_POST['useremail'];
    $state = $_POST['state'];
    $complaintdetials = $_POST['complaindetails'];
    $compfile = $_FILES["compfile"]["name"];



    move_uploaded_file($_FILES["compfile"]["tmp_name"], "complaintdocs/" . $_FILES["compfile"]["name"]);
    $query = mysqli_query($con, "insert into tblcomplaints(userId,category,state,complaintDetails,complaintFile,email) values('$uid','$category','$state','$complaintdetials','$compfile','$Useremail')");
    // code for show complaint number
    $sql = mysqli_query($con, "select complaintNumber from tblcomplaints  order by complaintNumber desc limit 1");
    while ($row = mysqli_fetch_array($sql)) {
      $cmpn = $row['complaintNumber'];
    }
    $complainno = $cmpn;
    echo '<script> alert("Your complain has been successfully filled and your complaintno is  "+"' . $complainno . '")</script>';
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

    <title>CCP | User Register Complaint</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker.css" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />

    <style>
    </style>

    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />

    <script>
      function getCat(val) {
        //alert('val');

        $.ajax({
          type: "POST",
          url: "getsubcat.php",
          data: 'catid=' + val,
          success: function(data) {
            $("#subcategory").html(data);

          }
        });
      }
      var isOtpVerified = false;

      function sendOTP() {
        var useremail = $('#useremail').val();
        $.ajax({
          type: "POST",
          url: "otp_validation.php",
          data: {
            action: 'sendOTP',
            useremail: useremail
          },
          success: function(response) {
            alert(response);
          }


        });
      }

      function verifyOTP() {
        var otp = $('#otp').val();
        $.ajax({
          type: 'POST',
          url: 'otp_validation.php',
          data: {
            action: 'verifyOTP',
            otp: otp
          },
          success: function(response) {
            $("#user-verify-status1").html(response);
            if (response === "OTP verified successfully") {
              isOtpVerified = true;
              $('#submitBtn').prop('disabled', false);
            }
          },
          error: function() {}
        })
      }

      function submitForm() {
        if (isOtpVerified) {
          return true;
        } else {
          alert("please verify otp before submiting the form");
          return false;
        }
      }

      function submitForm() {
        if (isOtpVerified) {
          return true;
        } else {
          alert("please verify otp before submiting the form");
          return false;
        }
      }

      function popUpWindow(url) {

        window.open(url, '_blank', 'width=600,height=auto');
      }
    </script>

    <style>
      #map {
        /* left: 16px; */
        height: 275px;
        /* width: 310px; */
      }
    </style>
  </head>

  <body>

    <section id="container">
      <?php include("includes/header.php"); ?>
      <?php include("includes/sidebar.php"); ?>
      <section id="main-content">
        <section class="wrapper">
          <h3><i class="fa fa-angle-right"></i> Register Complaint</h3>

          <!-- BASIC FORM ELELEMNTS -->
          <div class="row mt">
            <div class="col-lg-12">
              <div class="form-panel">


                <?php if ($successmsg) { ?>
                  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Well done!</b> <?php echo htmlentities($successmsg); ?>
                  </div>
                <?php } ?>

                <?php if ($errormsg) { ?>
                  <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Oh snap!</b> </b> <?php echo htmlentities($errormsg); ?>
                  </div>
                <?php } ?>

                <form class="form-horizontal style-form" method="post" name="complaint" enctype="multipart/form-data" onsubmit="return submitForm();">
                  <?php
                  $query = mysqli_query($con, "select * from users where userEmail='" . $_SESSION['login'] . "'");
                  while ($row = mysqli_fetch_array($query)) { ?>
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Email</label>
                      <div class="col-sm-4">
                        <input type="email" name="useremail" required="required" value="<?php echo htmlentities($row['userEmail']); ?>" class="form-control" readonly>
                      <?php } ?>
                      </select>
                      </div>
                      <label class="col-sm-2 col-sm-2 control-label">State</label>
                      <div class="col-sm-4">
                        <select name="state" required="required" class="form-control">
                          <option value="">Select State</option>
                          <?php $sql = mysqli_query($con, "select stateName from state ");
                          while ($rw = mysqli_fetch_array($sql)) {
                          ?>
                            <option value="<?php echo htmlentities($rw['stateName']); ?>"><?php echo htmlentities($rw['stateName']); ?></option>
                          <?php
                          }
                          ?>

                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Complaint Details (max 2000 words) </label>
                      <div class="col-sm-4">
                        <textarea name="complaindetails" required="required" cols="10" rows="10" class="form-control" maxlength="2000"></textarea>
                      </div>

                      <!-- <a href="javascript:void(0);" onclick="popUpWindow('http://localhost/ccp/users/webeasystep-mapbox_markers_manager/user-map.php');">
<button type="button" class="btn btn-primary">Location</button></a>
</div> -->

                      <label class="col-sm-2 col-sm-2 control-label">Complaint Related Doc(if any) </label>
                      <div class="col-sm-4">
                        <input type="file" name="compfile" class="form-control" value="">
                      </div>


                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Location</label>
                      <div class="col-md-6" id="map">


                        <script>
                          var user_location = [77.21672, 28.644800];
                          mapboxgl.accessToken = 'pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';
                          var map = new mapboxgl.Map({
                            container: 'map',
                            style: 'mapbox://styles/mapbox/streets-v9',
                            center: user_location,
                            zoom: 3
                          });
                          var marker;

                          // After the map style has loaded on the page, add a source layer and default
                          // styling for a single point.
                          map.on('load', function() {
                            addMarker(user_location, 'load');
                          });
                          map.on('click', function(e) {
                            marker.remove();
                            addMarker(e.lngLat, 'click');
                            //console.log(e.lngLat.lat);
                            document.getElementById("lat").value = e.lngLat.lat;
                            document.getElementById("lng").value = e.lngLat.lng;

                          });

                          function addMarker(ltlng, event) {

                            if (event === 'click') {
                              user_location = ltlng;
                            }
                            marker = new mapboxgl.Marker({
                                draggable: true,
                                color: "#d02922"
                              })
                              .setLngLat(user_location)
                              .addTo(map)
                              .on('dragend', onDragEnd);
                          }


                          function onDragEnd() {
                            var lngLat = marker.getLngLat();
                            document.getElementById("lat").value = lngLat.lat;
                            document.getElementById("lng").value = lngLat.lng;
                            console.log('lng: ' + lngLat.lng + '<br />lat: ' + lngLat.lat);
                          }

                          $('#signupForm').submit(function(event) {
                            event.preventDefault();
                            var lat = $('#lat').val();
                            var lng = $('#lng').val();
                            var url = 'locations_modelcopy.php?add_location&lat=' + lat + '&lng=' + lng;
                            $.ajax({
                              url: url,
                              method: 'GET',
                              dataType: 'json',
                              success: function(data) {
                                alert(data);
                                location.reload();
                              }
                            });
                          });
                        </script>
                        <!-- <script src="./script.js"></script> -->
                      </div>
                    </div>
                    <div class="form-group">


                      <label class="col-sm-2 col-sm-2 control-label">Category</label>
                      <div class="col-sm-4">
                        <select name="category" id="category" class="form-control" onChange="getCat(this.value);" required="">
                          <option value="">Select Category</option>
                          <?php $sql = mysqli_query($con, "select id,categoryName from category ");
                          while ($rw = mysqli_fetch_array($sql)) {
                          ?>
                            <option value="<?php echo htmlentities($rw['id']); ?>"><?php echo htmlentities($rw['categoryName']); ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                      <label class="col-sm-1 control-label">lat & lng:</label>
                      <div class="col-sm-2">  
                        <input type="text" class="form-control" id="lat" name="lat" placeholder="Your lat..">
                        
                      </div>
                      <div class="col-sm-2">
                      <input type="text" class="form-control" id="lng" name="lng" placeholder="Your lng..">
                      </div>
                    </div>
                    <?php $query = mysqli_query($con, "select * from users where userEmail='" . $_SESSION['login'] . "'");
                    while ($row = mysqli_fetch_array($query)) {
                    ?>

                      <div class="form-group">
                        <input type="hidden" name="useremail" id="useremail" required="required" value="<?php echo htmlentities($row['userEmail']); ?>" class="form-control" readonly>
                        <label class="col-sm-2 col-sm-2 control-label">OTP</label>
                        <div class="col-sm-2">
                          <input type="text" name="otp" id="otp" maxlength="6" class="form-control" required>
                          
                          
                          <button class="btn btn-primary" onclick="sendOTP()" >SEND</button>
                          
                          
                          <button class="btn btn-primary" onclick="verifyOTP()">VERIFY</button>
                        </div>
                        <span id="user-verify-status1" style="font-size:18px; color:green;"></span>
                      </div>

                    <?php } ?>
                    
                        


                        <div class="form-group">
                          <div class="col-sm-10" style="padding-left:25%;">
                            <button type="submit" name="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                          </div>
                        </div>

                </form>
              </div>
            </div>
          </div>



        </section>
      </section>
      <?php include("includes/footer.php"); ?>
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>

    <!--custom switch-->
    <script src="assets/js/bootstrap-switch.js"></script>

    <!--custom tagsinput-->
    <script src="assets/js/jquery.tagsinput.js"></script>

    <!--custom checkbox & radio-->

    <script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/date.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script type="text/javascript" src="assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>


    <script src="assets/js/form-component.js"></script>


    <script>
      //custom select box

      $(function() {
        $('select.styled').customSelect();
      });
    </script>

  </body>

  </html>
<?php } ?>