<?php 
	include 'includes/database.php';
	session_start();
	if($_SESSION['user_email'] == '' OR $_SESSION['user_role'] != 'Admin'){
		header('Location:index.php');
	}
	include 'includes/header.php';
	
?>


	<!-- Page content -->
	<div class="page-content">

		<?php include 'includes/sidebar.php' ?>

		<!-- Main content -->
		<div class="content-wrapper">

			
			<!-- Content area -->
			<div class="content">

			<!-- All The Content Goes down here -->

                <!-- Files Table -->

				<div class="card">
					<div class="card-header header-elements-inline">
						<h3 class="card-title">All Tasks</h3>
                        <a href="addtask.php" class="btn btn-primary">Add New Task</a>
					</div>

					<table class="table datatable-pagination">
						<thead>
							<tr>
								<th>#</th>
								<th>Task Title</th>
								<th>Assigned To</th>
								<th>Date Assigned</th>
								<th>Status</th>
								<th>Details</th>
                                <th>Delete</th>
							</tr>
						</thead>
						<tbody>
								<?php 
									$slct = mysqli_query($con, "SELECT * FROM tasks");
									$cnt=1;
									while($oo = mysqli_fetch_array($slct)){
								?>
							<tr>
								<td><?php echo $oo['task_id']; ?></td>
								<td><?php echo $oo['task_title']; ?></td>
								<td><?php echo $oo['assigned_to']; ?></td>
								<td><?php echo $oo['assigned_on']; ?></td>
								<td><?php echo $oo['status']; ?></td>
                                <td><a href="taskdetails.php?title=<?php echo $oo['task_title']; ?>" target=_blank><i class="icon-new-tab text-info"></i></a></td>
                                <td><a href=""><i class="icon-trash text-danger"></i></a></td>
							</tr>
								<?php $cnt++; } ?>
						</tbody>
					</table>
				</div>
				<!-- /pagination types -->


            <!-- There is the ending of main content -->

			</div>
			<!-- /content area -->


		<?php include 'includes/footer.php' ?>
            <script type="text/javascript">
                $(document).ready(function() {

                   // $('#tasksCat').children('a').addClass('open');
                    $('#tasksCat').children('ul').addClass('active');
                    $('#tasksCat').children('ul').css('display', 'block');
                    // $('#adminList').children('ul').addClass('active');
                    //  $('#adminList').children('ul').css('display', 'block');
                    // $('#managersList').children('ul').addClass('active');
                    //  $('#managersList').children('ul').css('display', 'block');
                    $('#alltasks').addClass('open');
                    $('#alltasks').addClass('active');
                    $('#alltasks').css('display', 'block');


                });
            </script>

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
