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
						<h3 class="card-title">All Sub Departments</h3>
                        <a href="addsubDepartment.php" class="btn btn-primary float-right">Add New Sub Department</a>
					</div>

					<table class="table datatable-pagination">
						<thead>
							<tr>
								<th>#</th>
								<th>Department Name</th>
								<th>Parent Department Name</th>
								<th>Created On</th>
								<th>Created By</th>
								<th>Edit</th>
                                <th>Delete</th>
							</tr>
						</thead>
						<tbody>
								<?php 
									$sele = mysqli_query($con, "SELECT * FROM subdepartments ORDER BY subdept_id DESC");
									$cnt=1;
									while($row= mysqli_fetch_array($sele)){
								?>
							<tr>
								
								<td><?php echo $row['subdept_id']; ?></td>
								<td><?php echo $row['subdept_name']; ?></td>
								<td><?php echo $row['parent_dept']; ?></td>
								<td><?php echo $row['added_date']; ?></td>
								<td><?php echo $row['added_by']; ?></td>
                                <td><a href=""><i class="icon-pencil5 text-info"></i></a></td>
                                <td><a href=""><i class="icon-trash text-danger"></i></a></td>
							</tr>
							<?php $cnt++;  }?>
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

                    //$('#departCat').children('a').addClass('open');
                    $('#departCat').children('ul').addClass('active');
                    $('#departCat').children('ul').css('display', 'block');
                    // $('#adminList').children('ul').addClass('active');
                    //  $('#adminList').children('ul').css('display', 'block');
                    // $('#managersList').children('ul').addClass('active');
                    //  $('#managersList').children('ul').css('display', 'block');
                    $('#userSubdept').children('a').addClass('open');
                    $('#userSubdept').children('ul').addClass('active');
                    $('#userSubdept').children('ul').css('display', 'block');


                });
            </script>

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
