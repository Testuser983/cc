<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              <?php $query=mysqli_query($con,"select fullName,deptImage from department where deptEmail='".$_SESSION['d_login']."'"); 
 while($row=mysqli_fetch_array($query)) 
 {
 ?> 
                  <p class="centered"><a href="profile.php">
<?php $deptphoto=$row['deptImage'];
if($deptphoto==""):
?>
<img src="deptimages/noimage.png"  class="img-circle" width="70" height="70" >
<?php else:?>
  <img src="deptimages/<?php echo htmlentities($deptphoto);?>" class="img-circle" width="70" height="70">

<?php endif;?>
</a>
</p>
 
                  <h5 class="centered"><?php echo htmlentities($row['fullName']);?></h5>
                  <?php } ?>
                    
                  <li class="mt">
                      <a href="dashboard.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>


                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Account Setting</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="profile.php">Profile</a></li>
                          <li><a  href="change-password.php">Change Password</a></li>
                        
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>manage Complaint</span>
                      </a>
                    
                    <ul class="sub">
                    <li><a  href="notprocess-complaint.php">Not Process</a></li>
                          <li><a  href="inprocess-complaint.php">Pending</a></li>
                          <li><a  href="closed-complaint.php">Completed</a></li>
                        
                      </ul>
                  </li>
                  <!-- <li class="sub-menu">
                      <a href="report_send.php" >
                         
                          <span>REPORT</span>
                      </a>
                      
                  </li>
                  <li class="sub-menu">
                      <a href="report_generate.php" >
                         
                          <span>PDF</span>
                      </a>
                      
                  </li> -->
                  <li class="sub-menu">
                      <a href="complaint-history.php" >
                          <i class="fa fa-tasks"></i>
                          <span>Complaint History</span>
                      </a>
                      
                  </li>
                  <li class="sub-menu">
                      <a href="complaint-history.php" >
                          <i class="fa fa-sign-out"></i>
                          <span>Logout</span>
                      </a>
                      
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>