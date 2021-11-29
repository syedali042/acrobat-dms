<?php 
    include 'includes/database.php';
    session_start();
	if($_SESSION['user_email'] == '' OR $_SESSION['user_role'] != 'Admin'){
		header('Location:index.php');
	}
    include 'includes/header.php'; 
    
    if(isset($_POST['btnadd'])){
        $deptname = $_POST['dept_name'];
        $created_by = $_SESSION['user_name'];
        $dated = date('Y-m-d');

        $insert = mysqli_query($con, "INSERT INTO departments(dept_name, date_added, added_by) VALUES('$deptname','$dated', '$created_by')");

        if($insert){
            echo '<script>
                alert("Deprtment Added Successfully");
            </script>';
        }
    }

?>


	<!-- Page content -->
	<div class="page-content">

		<?php include 'includes/sidebar.php' ?>

		<!-- Main content -->
		<div class="content-wrapper">

			
			<!-- Content area -->
			<div class="content">

			<!-- All The Content Goes down here -->
                    <div class="row">
                        <div class=" offset-md-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="text-center">Add New Department</h2>
                                    <hr>
                                    <form action="" method="post" role="form">
                                        <input type="text" name="dept_name" class="form-control" placeholder="Enter Department Name">
                                        <br>
                                        <button name="btnadd" class="btn btn-primary float-right">Add Now</button>
                                    </form>
                                </div>
                            </div>
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
