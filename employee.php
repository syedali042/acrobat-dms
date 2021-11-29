<?php
	include_once 'includes/database.php';
	session_start();
	if($_SESSION['user_email'] == '' OR $_SESSION['user_role'] != 'Employee' ){
		header('Location:index.php');
	}

  	include_once 'includes/header.php'; 
  
?>


	<!-- Page content -->
	<div class="page-content">

		<?php include 'includes/emp_sidebar.php' ?>

		<!-- Main content -->
		<div class="content-wrapper">

			
			<!-- Content area -->
			<div class="content">

			<!-- All The Content Goes down here -->
                

                <div class="row">
                    <div class="offset-md-1 col-md-10">
                        <h2 class="text-center"><strong>Recent Files</strong></h2>
                        <hr>
                        <!-- Table for uploaded Files -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>File Title</th>
                                        <th>Sub department</th>
                                        <th>Date</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>

                                <tbody>

									<?php
										$emp_name = $_SESSION['user_name'];
										$query = mysqli_query($con, "SELECT * FROM files WHERE added_by = '$emp_name' ORDER BY file_id DESC LIMIT 10");
										$cnt=1;
										while($row= mysqli_fetch_array($query)){
									?>
										<tr>
										<td><?php echo $row['file_id']; ?></td>
										<td><?php echo $row['file_name']; ?></td>
										<td><?php echo $row['dept_name']; ?></td>
										<td><?php echo $row['added_date']; ?></td>
										<td><a href="downloadfile.php?file_id=<?php echo $row['file_id'];?>"><i class="icon-file-download2 text-info"></i></a></td>
											</tr>
									<?php $cnt++; } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /Table for uploaded Files  -->
                        <br>
                        <br>
                    <a href="allfiles.php" class="btn btn-primary float-right">View All uploaded Files</a>
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
