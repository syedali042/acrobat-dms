<?php 
    include 'includes/database.php';
    session_start();
	if($_SESSION['user_email'] == '' OR $_SESSION['user_role'] != 'Admin'){
		header('Location:index.php');
	}
    include 'includes/header.php'; 
    
    if(isset($_POST['btnadd'])){
        $subdeptname = $_POST['subdept_name'];
        $parent_dept = $_POST['parent_dept'];
        $created_by = $_SESSION['user_name'];
        $dated = date('Y-m-d');

        $insert = mysqli_query($con, "INSERT INTO subdepartments(subdept_name, parent_dept, added_date, added_by) VALUES('$subdeptname','$parent_dept','$dated', '$created_by')");

        if($insert){
            echo '<script>
                alert(" Sub Deprtment Added Successfully");
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
                                    <h2 class="text-center">Add New Sub Department</h2>
                                    <hr>
                                    <form action="" method="post" role="form">
                                        <input type="text" name="subdept_name" class="form-control" placeholder="Enter Sub Department Name">
                                        <br>
                                        <select class="form-control select-search" name="parent_dept" required data-fouc>
									            <option value="" selected disabled>Select Parent Department</option>
                                                <?php 
                                                    $select = mysqli_query($con, "SELECT * FROM departments");
                                                    $cnntt = 1;
                                                    while($rowss = mysqli_fetch_array($select)){
                                                ?>
                                                <option value="<?php echo $rowss['dept_name']; ?>"><?php echo $rowss['dept_name']; ?></option>

                                                <?php $cnntt++; } ?>
								            </select>
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
