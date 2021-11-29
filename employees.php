<?php 
	include 'includes/database.php';
	session_start();
	if($_SESSION['user_email'] == '' OR $_SESSION['user_role'] != 'Admin'){
		header('Location:index.php');
	}
	include 'includes/header.php'; ?>


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
						<h3 class="card-title">All Employees</h3>
					</div>

					<table class="table datatable-pagination">
						<thead>
							<tr>
								<th>Name</th>
								<th style="width:200px;">E-Mail</th>
								<th>Password</th>
								<th>Date Joined</th>
								<th>Phone</th>
                                <th>Salary</th>
                                <th>Department</th>
                                <th style="width:400px;">Actions</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$select = mysqli_query($con,"SELECT * FROM users WHERE user_role = 'Employee'");
							$cnt = 1;
							while($row = mysqli_fetch_array($select)){
						?>
							<tr>
								<td><a target=_blank><?php echo $row['username']; ?></a></td>
								<td style="width:200px;"><?php echo $row['user_email']; ?></td>
								<td><?php echo $row['user_pass']; ?></td>
								<td><?php echo $row['date_joined']; ?></td>
                                <td><?php echo $row['user_phone']; ?></td>
                                <td><?php echo $row['user_salary']; ?></td>
                                <td><?php echo $row['user_dept']; ?></td>
                                <td style="width:400px;">
                                	<a href="viewfiles.php?emp_name=<?php echo $row['username']; ?>"><i class="icon-eye text-danger"></i> View</a>
                                	<a href=""><i class="icon-trash text-danger"></i> Delete</a> 
                                	<a href=""><i class="icon-pencil5 text-info"></i> Edit</a>
                                </td>
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

                  //  $('#userCat').children('a').addClass('open');
                    $('#userCat').children('ul').addClass('active');
                    $('#userCat').children('ul').css('display', 'block');
                   // $('#adminList').children('ul').addClass('active');
                  //  $('#adminList').children('ul').css('display', 'block');
                      // $('#managersList').children('ul').addClass('active');
                     //  $('#managersList').children('ul').css('display', 'block');
                      $('#employeesList').children('a').addClass('open');
                       $('#employeesList').children('ul').addClass('active');
                      $('#employeesList').children('ul').css('display', 'block');


                });
            </script>

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
