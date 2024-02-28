<div class="span3">
					<div class="sidebar">


<ul class="widget widget-menu unstyled">
							<li>
								<a href="dashboard.php">
									<i class="menu-icon icon-group"></i>
									dashboard
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
									<li>
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
							<li>
								<a href="manage-departmnet.php">
									<i class="menu-icon icon-group"></i>
									Manage Department
								</a>
							</li>
						</ul>


						<ul class="widget widget-menu unstyled">
                               <!-- <li><a href="category.php"><i class="menu-icon icon-tasks"></i> Add Category </a></li>
                                <li><a href="subcategory.php"><i class="menu-icon icon-tasks"></i>Add Sub-Category </a></li>
                                <li><a href="state.php"><i class="menu-icon icon-paste"></i>Add State</a></li>
								-->
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
								<a href="feedback.php
								">
									<i class="icon-comments"></i>
									Feedback
								</a>
							</li>
							<li>
								<a href="dept-notification.php">
									<i class="icon-bell"></i>
									Notification
								</a>
							</li>
                            </ul><!--/.widget-nav-->

						<ul class="widget widget-menu unstyled">
						<!--	<li><a href="user-logs.php"><i class="menu-icon icon-tasks"></i>User Login Log </a></li> -->
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
								<a href="logout.php">
									<i class="menu-icon icon-signout"></i>
									Logout
								</a>
							</li>
						</ul>

					</div><!--/.sidebar-->
				</div><!--/.span3-->
