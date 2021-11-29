<?php 
	include 'includes/database.php';
	session_start();
	if($_SESSION['user_email'] == '' OR $_SESSION['user_role'] != 'Manager'){
		header('Location:index.php');
	}
	include 'includes/header.php';
	
?>


	<!-- Page content -->
	<div class="page-content">

		<?php include 'includes/manager_sidebar.php' ?>

		<!-- Main content -->
		<div class="content-wrapper">

			
			<!-- Content area -->
			<div class="content">

			<!-- All The Content Goes down here -->

                <!-- Files Table -->

				<div class="card">
                <div class="card-body">
                <h3 class="text-center">Your Tasks</h3>
                <hr>
					<table class="table datatable-pagination">
						<thead>
							<tr>
								<th>#</th>
								<th>Task Title</th>
								<th>Deadline</th>
								<th>Date Assigned</th>
								<th>Status</th>
								<th>Details</th>
							</tr>
						</thead>
						<tbody>
                                <?php 
                                    $m_name = $_SESSION['user_name'];
									$slct = mysqli_query($con, "SELECT * FROM tasks WHERE assigned_to = '$m_name' AND status = 'Pending' ");
									$cnt=1;
									while($oo = mysqli_fetch_array($slct)){
								?>
							<tr>
								<td><?php echo $oo['task_id']; ?></td>
								<td><?php echo $oo['task_title']; ?></td>
								<td><?php echo $oo['completion_date']; ?></td>
								<td><?php echo $oo['assigned_on']; ?></td>
								<td><?php echo $oo['status']; ?></td>
                                <td><a href="task_detailss.php?title=<?php echo $oo['task_title']; ?>" target=_blank><i class="icon-new-tab text-info"></i></a></td>
							</tr>
								<?php $cnt++; } ?>
						</tbody>
					</table>
				</div>
				<!-- /pagination types -->
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
