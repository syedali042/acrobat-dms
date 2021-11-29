<?php
    include 'includes/database.php';
    session_start();
	if($_SESSION['user_email'] == '' OR $_SESSION['user_role'] != 'Admin'){
		header('Location:index.php');
	}
    include 'includes/header.php';


if(isset($_POST['btnadd'])) {
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_pass'];
    $user_phone = $_POST['user_phone'];
    $user_des = $_POST['user_designation'];
    $user_salary = $_POST['user_salary'];
    $user_role = $_POST['user_role'];
    $dated = date('Y-m-d');
    $addded_by=$_SESSION['user_email'];
    foreach ($_POST['user_dept'] as $key => $value) {
        $user_dept = $value;
        $insert = mysqli_query($con, "INSERT INTO users(username, user_email, user_pass, user_phone,
        user_designation, user_salary,user_dept, user_role, date_joined) VALUES('$username','$user_email',
        '$user_pass','$user_phone', '$user_des','$user_salary', '$user_dept', '$user_role', '$dated')");
     /*   $insert = mysqli_query($con, "INSERT INTO departmets(dept_name, date_added,added_by) VALUES('$user_dept','$dated',
        '$addded_by')");
     */
    }
    if ($insert) {
        echo "<script>
                alert('Uploading Successfull');
            </script>";
    } else {
        echo "<script>
            alert('Something Went Wrong');
        </script>";
    }
}





   /*
    if(isset($_POST['btnadd'])){
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_pass = $_POST['user_pass'];
        $user_phone = $_POST['user_phone'];
        $user_des = $_POST['user_designation'];
        $user_salary = $_POST['user_salary'];
        $user_dept = $_POST['user_dept'];
        $user_role = $_POST['user_role'];
        $dated = date('Y-m-d');

        $insert = mysqli_query($con, "INSERT INTO users(username, user_email, user_pass, user_phone,
        user_designation, user_salary,user_dept, user_role, date_joined) VALUES('$username','$user_email',
        '$user_pass','$user_phone', '$user_des','$user_salary', '$user_dept', '$user_role', '$dated')");

        if($insert){
            echo '<script>
                alert("User Added Successfully");
            </script>';
        }
    }
*/
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
                                    <h2 class="text-center">Add New User</h2>
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
                                                <input type="password" name="user_pass" id="passwordInput"  class="form-control" placeholder="Enter Password" required>
                                                <span  id="passwordStrength"></span>
                                            </div>

                                            <div class="col-md-6">
                                                <input type="text" name="user_phone" class="form-control" placeholder="Enter Phone" >
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="user_designation" class="form-control" placeholder="Enter Designation" >
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="user_salary" class="form-control" placeholder="Enter Salary" >
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select name="user_role" onchange="myFunction(this.value)" class="form-control" required>
                                                    <option value="" selected disabled>Select User Role</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="Employee">Employee</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control select-search" id="dept_field"   name="user_dept[]" multiple required  data-fouc>
                                                    <option value="" selected disabled>Select Department</option>
                                                    /
                                                </select>
                                            </div>

                                            <br> <br>
                                        </div>
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
