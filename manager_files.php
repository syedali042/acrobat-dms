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

                <!-- Files Table -->

				<div class="card">
					<div class="card-header header-elements-inline">
						<h3 class="card-title">All updated files</h3>
					</div>

					<table class="table datatable-pagination">
						<thead>
							<tr>
								<th>#</th>
								<th>File Title</th>
								<th>Uploaded By</th>
								<th>Sub Department</th>
								<th>Date</th>
								<th>Download</th>
                                
							</tr>
						</thead>
						<tbody>
						<?php
							$m_dept = $_SESSION['manager_dept'];
                            $m_name=$_SESSION['user_name'];
							$query = mysqli_query($con, "SELECT * FROM subdepartments WHERE parent_dept ='$m_dept'");
							$row = mysqli_fetch_array($query);
							$subdeptn = $row['subdept_name'];

							$query2 = mysqli_query($con, "SELECT * FROM files WHERE dept_name = '$subdeptn' OR added_to='$m_name' ORDER BY file_id DESC");
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
