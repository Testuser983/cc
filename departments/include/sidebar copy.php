<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="widget widget-menu unstyled">
              
        
               
                  <li class="mt">
                      <a href="dashboard.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>


                  <li>
                  <a class="collapsed" data-toggle="collapse" href="#togglePages">
									<i class="menu-icon icon-cog"></i>
									<i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>
									Manage Complaint
								</a>
                    <ul id="togglePages" class="collapse unstyled">
                          <li>
                          <a href="notprocess-complaint.php">
											<i class="icon-tasks"></i>
											Not Process Yet Complaint
											<?php
$rt = mysqli_query($con,"SELECT * FROM tblcomplaints where status is null");
$num1 = mysqli_num_rows($rt);
{?>
		
											<b class="label orange pull-right"><?php echo htmlentities($num1); ?></b>
											<?php } ?>
										</a>
                            </li>
                          <li>
                          <a href="inprocess-complaint.php">
											<i class="icon-tasks"></i>
											Pending Complaint
                   <?php 
  $status="in Process";                   
$rt = mysqli_query($con,"SELECT * FROM tblcomplaints where status='$status'");
$num1 = mysqli_num_rows($rt);
{?><b class="label orange pull-right"><?php echo htmlentities($num1); ?></b>
<?php } ?>
										</a>
                        </li>
                        <a href="closed-complaint.php">
											<i class="icon-inbox"></i>
											Closed Complaints
	     <?php 
  $status="closed";                   
$rt = mysqli_query($con,"SELECT * FROM tblcomplaints where status='$status'");
$num1 = mysqli_num_rows($rt);
{?><b class="label green pull-right"><?php echo htmlentities($num1); ?></b>
<?php } ?>

										</a>
                        

                        </li>
                      </ul>
                  </li>
                  <li>
                  <a href="manage-users.php">
									<i class="menu-icon icon-group"></i>
									Manage users
								</a>
                    </li>
                  </li>
                  <li>
                  <a href="manage-departmnet.php">
									<i class="menu-icon icon-group"></i>
									Manage Department
								</a>
                      
                  </li>
</ul>
<ul class="widget widget-menu unstyled">
        <li>
                                <a class="collapsed" data-toggle="collapse" href="#togglePage">
									<i class="menu-icon icon-plus"></i>
									<i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>
									ADD
								</a>
                 
            <ul id="togglePage" class="collapse unstyled">
                 <li>
                    <a href="category.php">
                        <i class="icon-tasks"></i>
                            category
                                            
                    </a>
                 </li>
                <li>
                     <a href="state.php">
                        <i class="icon-tasks"></i>
                             state
                    </a>
				</li>
                <li>
					<a href="chatbot.php">
						<i class="icon-inbox"></i>
							chatbot
					</a>
				</li>
            </ul>
        </li>
        <li>
								<a href="#">
									<i class="icon-comments"></i>
									Feedback
								</a>
							</li>
                            <li>
								<a href="#">
									<i class="icon-bell"></i>
									Notification
								</a>
							</li>
</ul>
<ul class="widget widget-menu unstyled">
<li>
								<a class="collapsed" data-toggle="collapse" href="#togglePa">
									<i class="menu-icon icon-cog"></i>
									<i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>
									LOGS
								</a>
								<ul id="togglePa" class="collapse unstyled">
									<li>
										<a href="dept-logs.php">
											<i class="icon-tasks"></i>
											Department
											
										</a>
									</li>
									<li>
										<a href="user-logs.php">
											<i class="icon-tasks"></i>
											User
										</a>
									</li>
									
								</ul>
							</li>
                            <li>
								<a href="#">
									<i class="icon-file"></i>
									Report
								</a>
							</li>
							<li>
								<a href="logout.php">
									<i class="menu-icon icon-signout"></i>
									Logout
								</a>
							</li>
</ul>
              
          </div><!-- sidebar menu end-->
      </aside>