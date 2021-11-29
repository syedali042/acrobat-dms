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
                    <h1 class="text-center"><?php echo $_SESSION['user_name'] ?>'s Sub Departments</h1>
                    <hr>
                    
					<table class="table datatable-pagination">
						<thead>
							<tr>
								<th>#</th>
								<th>Sub Department Name</th>
								<th>Parent Department Name</th>
								<th>Created By</th>
								<th>Date</th>
                                <th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
                                $d = $_SESSION['manager_dept'];
                                $s1 = mysqli_query($con, "SELECT * FROM departments WHERE dept_name = '$d' ");
                                $r = mysqli_fetch_array($s1);
                                $getde = $r['dept_name'];

								$select = mysqli_query($con, "SELECT * FROM subdepartments WHERE parent_dept = '$getde'");
								$bnt = 1;
								while($rowss = mysqli_fetch_array($select)){
							?>
							<tr>
								<td><?php echo $rowss['subdept_id']; ?></td>
								<td><?php echo $rowss['subdept_name']; ?></td>
								<td><?php echo $rowss['parent_dept']; ?></td>
								<td><?php echo $rowss['added_by']; ?></td>
								<td><?php echo $rowss['added_date']; ?></td>
                                <td>Active</td>
							</tr>
							<?php $bnt++; } ?>
						</tbody>
					</table>
                </form>

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
