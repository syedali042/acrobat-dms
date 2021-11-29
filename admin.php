<?php
include_once 'includes/database.php';
session_start();
if($_SESSION['user_email'] == '' OR $_SESSION['user_role'] != 'Admin'){
	header('Location:index.php');
}

include_once 'includes/header.php'; 

?>
	<style type="text/css">
		#notice-board{
			width:100%;
			padding:10px;
			font-family: monospace;
			background-color:#6f8ee8;
			color:white;			
		}
	</style>
	<!-- Page content -->
	<div class="page-content">

		<?php include 'includes/sidebar.php' ?>

		<!-- Main content -->
		<div class="content-wrapper">
			<?php
				$selectNotice = mysqli_query($con, "SELECT * FROM notices");
				$noticeId = mysqli_fetch_assoc($selectNotice);
				if($noticeId['not_text']!==''){
					$notice = $noticeId['not_text'];
					echo '<br>';
					echo '<div id="notice-board">';
					echo '<center><i class="fa fa-bell" aria-hidden="true"></i> '.$notice.'</center>';
					echo '</div>';
				}
			?>
			
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
					<div class="col-sm-6 col-xl-3">

						<div class="card card-body" style="cursor: pointer;" onclick="window.location.href='allfiles.php'">
							<div class="media">
								<div class="mr-3 align-self-center">
									<i class="icon-files-empty icon-3x text-success-400"></i>
								</div>

								<div class="media-body text-right">
								<?php 
								$qu = mysqli_query($con, "SELECT * FROM files");
								$rows = mysqli_num_rows($qu);
								?>
									<h3 class="font-weight-semibold mb-0"><?php echo $rows; ?></h3>
									<span class="text-uppercase font-size-sm text-muted">total files</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-xl-3">
						<div class="card card-body" style="cursor: pointer;" onclick="window.location.href='managers.php'">
							<div class="media">
								<div class="mr-3 align-self-center">
									<i class="icon-user-tie icon-3x text-indigo-400"></i>
								</div>

								<div class="media-body text-right">
									<?php 
									$qu = mysqli_query($con, "SELECT * FROM users WHERE user_role = 'Manager' ");
									$rows = mysqli_num_rows($qu);
									?>
									<h3 class="font-weight-semibold mb-0"><?php echo $rows; ?></h3>
									<span class="text-uppercase font-size-sm text-muted">total managers</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-xl-3">
						<div class="card card-body" style="cursor: pointer;" onclick="window.location.href='employees.php'">
							<div class="media">
								<div class="media-body">
									<?php 
									$qu = mysqli_query($con, "SELECT * FROM users WHERE user_role = 'Employee' ");
									$rows = mysqli_num_rows($qu);
									?>
									<h3 class="font-weight-semibold mb-0"><?php echo $rows; ?></h3>
									<span class="text-uppercase font-size-sm text-muted">total employees</span>
								</div>

								<div class="ml-3 align-self-center">
									<i class="icon-users icon-3x text-blue-400"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-xl-3">
						<div class="card card-body" style="cursor: pointer;" onclick="window.location.href='departments.php'">
							<div class="media">
								<div class="media-body">
									<?php 
									$que = mysqli_query($con, "SELECT * FROM departments");
									$rows = mysqli_num_rows($que);
									?>
									<h3 class="font-weight-semibold mb-0"><?php echo $rows; ?></h3>
									<span class="text-uppercase font-size-sm text-muted">total departments</span>
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
					<div class="col-md-9">
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
								<th>Sub Department</th>
								<th>Date</th>
								<th>Download</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
								<?php 
								$sele = mysqli_query($con, "SELECT * FROM files ORDER BY file_id DESC LIMIT 10");
								$cnt=1;
								while($row= mysqli_fetch_array($sele)){
								?>
							<tr>
								
								<td><?php echo $row['file_id']; ?></td>
								<td><?php echo $row['file_name']; ?></td>
								<td><?php echo $row['added_by']; ?></td>
								<td><?php echo $row['dept_name']; ?></td>
								<td><?php echo $row['added_date']; ?></td>
								<td><a href="downloadfile.php?file_id=<?php echo $row["file_id"]; ?>"><i class="icon-file-download2 text-info"></i></a></td>
								<td><a href=""><i class="icon-trash text-danger"></i></a></td>
							</tr>
							<?php $cnt++;
								}?>
						</tbody>
							</table>
						</div>
						<!-- /Table for uploaded Files  -->
						<br>
						<br>
					<a href="allfiles.php" class="btn btn-primary float-right">View All uploaded Files</a>
					</div>
					<div class="col-md-3">
					<h2 class="text-center"><strong>Search By Date</strong></h2>
					<hr>
						<form action="" method="post" >
						<div class="input-group">
							<span class="input-group-prepend">
								<span class="input-group-text"><i class="icon-calendar22"></i></span>
							</span>
							<input type="text" class="form-control daterange-single" value="<?php echo date("m/d/yy"); ?>">
						</div>
						<br>

						</form>
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
