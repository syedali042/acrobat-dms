<?php 
    include 'includes/database.php';
    session_start();
	if($_SESSION['user_email'] == '' OR $_SESSION['user_role'] != 'Manager' ){
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
					<div class="card-header header-elements-inline">
						<h3 class="card-title"><?php echo $_SESSION['user_name'] ?>'s Employees</h3>
					</div>

					<table class="table datatable-pagination">
						<thead>
							<tr>
								<th>Name</th>
								<th>E-Mail</th>
								<th>Password</th>
								<th>Date Joined</th>
								<th>Phone</th>
                                <th>Salary</th>
                                <th>Department</th>
							</tr>
						</thead>
						<tbody>
                        <?php 
                            $pp = $_SESSION['manager_dept'];
                            $selective = mysqli_query($con, "SELECT * FROM departments WHERE dept_name = '$pp'");
                            $gd = mysqli_fetch_array($selective);
                            $d = $gd['dept_name'];

							$select = mysqli_query($con,"SELECT * FROM users WHERE user_dept = '$d' AND user_role = 'Employee'");
							$cnt = 1;
							while($row = mysqli_fetch_array($select)){
						?>
							<tr>
								<td><a href="viewfiles.php?emp_name=<?php echo $row['username']; ?>"> <?php echo $row['username']; ?></a></td>
								<td><?php echo $row['user_email']; ?></td>
								<td><?php echo $row['user_pass']; ?></td>
								<td><?php echo $row['date_joined']; ?></td>
                                <td><?php echo $row['user_phone']; ?></td>
                                <td><?php echo $row['user_salary']; ?></td>
                                <td><?php echo $row['user_dept']; ?></td>
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

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
