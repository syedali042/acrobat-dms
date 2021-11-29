<?php 
    include 'includes/database.php';
    session_start();
	if($_SESSION['user_email'] == '' OR $_SESSION['user_role'] != 'Admin'){
		header('Location:index.php');
	}
    include 'includes/header.php'; 
    
    if(isset($_POST['btnadd'])){
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_pass = $_POST['user_pass'];
        $user_role = $_POST['user_role'];
        $dated = date('Y-m-d');

        $insert = mysqli_query($con, "INSERT INTO users(username, user_email, user_pass, user_role, date_joined) VALUES('$username','$user_email',
        '$user_pass', '$user_role', '$dated')");

        if($insert){
            echo '<script>
                alert("Admin Added Successfully");
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
                        <div class=" offset-md-1 col-md-10">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="text-center">Add New Admin</h2>
                                    <hr>
                                    <form action="" method="post" role="form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="username" class="form-control" placeholder="Enter Name" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" name="user_email" class="form-control" placeholder="Enter Email" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="password" name="user_pass" id="passwordInput" class="form-control" placeholder="Enter Password" required>
                                                <span  id="passwordStrength"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="user_role" value="Admin" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <button name="btnadd" class="btn btn-primary">Add Now</button>
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
