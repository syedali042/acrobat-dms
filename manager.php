<?php
	include_once 'includes/database.php';
	session_start();
	if($_SESSION['user_email'] == '' OR $_SESSION['user_role'] != 'Manager' ){
		header('Location:index.php');
	}

  	include_once 'includes/header.php'; 
  
?>


	<!-- Page content -->
	<div class="page-content">

		<?php include 'includes/manager_sidebar.php' ?>

		<!-- Main content -->
		<div class="content-wrapper">

			
			<!-- Content area -->
			<div class="content">

			<!-- All The Content Goes down here -->

            <!-- statistics -->
				<div class="mb-3">
					<h2 class="mb-0 font-weight-semibold">
                        Dashboard
					</h2>
				</div>

				<div class="row">
					<div class="col-sm-6 col-xl-4">
						<div class="card card-body" style="cursor: pointer;" onclick="window.location.href='manager_files.php'">
							<div class="media">
								<div class="mr-3 align-self-center">
									<i class="icon-files-empty icon-3x text-success-400"></i>
								</div>

								<div class="media-body text-right">
									<?php 
										$m_dept = $_SESSION['manager_dept'];
										$query = mysqli_query($con, "SELECT * FROM subdepartments WHERE parent_dept ='$m_dept'");
										$row = mysqli_fetch_array($query);
										$subdeptn = $row['subdept_name'];
	
										$query2 = mysqli_query($con, "SELECT * FROM files WHERE dept_name = '$subdeptn'");
										$rowss = mysqli_num_rows($query2);
									?>
									<h3 class="font-weight-semibold mb-0"><?php echo $rowss;?></h3>
                                    <span class="text-uppercase font-size-sm text-muted">total files</span>
								</div>
							</div>
						</div>
					</div>

					

					<div class="col-sm-6 col-xl-4">
						<div class="card card-body" style="cursor: pointer;" onclick="window.location.href='manager_employees.php'">
							<div class="media">
								<div class="media-body">
                                    <?php
                                        $q1 = mysqli_query($con, "SELECT * FROM departments");
                                        $getdept = mysqli_fetch_array($q1);
                                        $dept = $getdept['dept_name'];

                                        $manager_dept = $_SESSION['manager_dept'];
                                        $q2 = mysqli_query($con, "SELECT * FROM users WHERE user_role = 'Employee' AND user_dept = '$manager_dept' " );
                                        $row = mysqli_num_rows($q2);
                                    ?>
									<h3 class="font-weight-semibold mb-0"><?php echo $row; ?></h3>
									<span class="text-uppercase font-size-sm text-muted">total employees</span>
								</div>

								<div class="ml-3 align-self-center">
									<i class="icon-users icon-3x text-blue-400"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-xl-4">
						<div class="card card-body" style="cursor: pointer;" onclick="window.location.href='manager_subdepartments.php'">
							<div class="media">
								<div class="media-body">
                                <?php
                                        $q3 = mysqli_query($con, "SELECT * FROM departments");
                                        $getdept = mysqli_fetch_array($q3);
                                        $dept = $getdept['dept_name'];

                                        $manager_dept = $_SESSION['manager_dept'];
                                        $q4 = mysqli_query($con, "SELECT * FROM subdepartments WHERE parent_dept = '$manager_dept' " );
                                        $row = mysqli_num_rows($q4);
                                    ?>
									<h3 class="font-weight-semibold mb-0"><?php echo $row; ?></h3>
									<a href="manager_subdepartments.php"><span class="text-uppercase font-size-sm text-muted">sub departments</span></a>
								</div>

								<div class="ml-3 align-self-center">
									<i class="icon-drawer icon-3x text-danger-400"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- / statistics -->

                

                <div class="row">
                    <div class="col-md-8">
                        <h2 class="text-center"><strong>Recent Files</strong></h2>
                        <hr>
                        <!-- Table for uploaded Files -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>File Title</th>
                                        <th>Uploaded By</th>
                                        <th>Sub department</th>
                                        <th>Date</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>

                                <tbody>
								<?php
									$m_dept = $_SESSION['manager_dept'];
									$query = mysqli_query($con, "SELECT * FROM subdepartments WHERE parent_dept ='$m_dept'");
									$row = mysqli_fetch_array($query);
									$subdeptn = $row['subdept_name'];

									$query2 = mysqli_query($con, "SELECT * FROM files WHERE dept_name = '$subdeptn' ORDER BY file_id DESC LIMIT 5");
									$by=1;
									while($getfiles =  mysqli_fetch_array($query2)){
								
								?>
									<tr>
										<td><?php echo $getfiles['file_id'];?></td>
										<td><?php echo $getfiles['file_name'];?></td>
										<td><?php echo $getfiles['added_by'];?></td>
										<td><?php echo $getfiles['dept_name'];?></td>
										<td><?php echo $getfiles['added_date'];?></td>
										<td><a href="downloadfile.php?file_id=<?php echo $getfiles['file_id'];?>"><i class="icon-file-download2 text-info"></i></a></td>
										
									</tr>
								<?php $by++; } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /Table for uploaded Files  -->
                        <br>
                        <br>
                    <a href="manager_files.php" class="btn btn-primary float-right">View All uploaded Files</a>
                </div>
                <div class="col-md-4">
                <h2 class="text-center"><strong>My Employees</strong></h2>
                <hr>
                    <!-- Support tickets -->
						<div class="card">
							<div class="table-responsive">
								<table class="table text-nowrap">
									<thead>
										<tr>
											<th style="width: 50px">Joined Date</th>
											<th style="width: 300px;">Name</th>
										</tr>
									</thead>
									<tbody>
                                        <?php 
                                            $q5 = mysqli_query($con, "SELECT * FROM departments");
                                            $getdept = mysqli_fetch_array($q5);
                                            $dept = $getdept['dept_name'];

                                            $q6 = mysqli_query($con,"SELECT * FROM users WHERE user_role = 'Employee' AND user_dept = '$dept' ");
                                            $by=1;
                                            while($getemployee = mysqli_fetch_array($q6)){

                                        ?>

										<tr>
											<td class="text-center">
												<h6 class="mb-0">2020-02-20</h6>
											</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="mr-3">
														<a href="#" class="btn bg-teal-400 rounded-round btn-icon btn-sm">
															<span class="letter-icon"></span>
														</a>
													</div>
													<div>
														<a href="viewfiles.php?emp_name=<?php echo $getemployee['username'];  ?>" class="text-default font-weight-semibold letter-icon-title"><?php echo $getemployee['username']; ?></a>
													</div>
												</div>
											</td>
										</tr>
                                            <?php $by++; }?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- /support tickets -->
                </div>
            </div>

            <!-- There is the ending of main content -->

			</div>
			<!-- /content area -->


		<?php include 'includes/footer.php' ?>

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
