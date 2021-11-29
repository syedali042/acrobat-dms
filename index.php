<?php
include 'includes/database.php';
session_start();
if(isset($_POST['btnlogin'])){
	$useremail = $_POST['user_email'];
	$user_pass = $_POST['user_password'];

	$select = mysqli_query($con, "SELECT * FROM users WHERE user_email ='$useremail' AND user_pass = '$user_pass'");
	$row = mysqli_fetch_array($select);

	if($row['user_email'] == $useremail && $row['user_pass'] == $user_pass && $row['user_role']== "Admin"){
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['user_name'] = $row['username'];
		$_SESSION['user_email'] = $row['user_email'];
		$_SESSION['user_role'] = $row['user_role'];
        $_SESSION['user_pass'] = $row['user_pass'];

		header("Location:admin.php");
	}else if($row['user_email'] == $useremail && $row['user_pass'] == $user_pass && $row['user_role']== "Manager"){
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['user_name'] = $row['username'];
		$_SESSION['user_email'] = $row['user_email'];
		$_SESSION['manager_dept'] = $row['user_dept'];
		$_SESSION['user_role'] = $row['user_role'];
        $_SESSION['user_pass'] = $row['user_pass'];

		header("Location:manager.php");
	}else if($row['user_email'] == $useremail && $row['user_pass'] == $user_pass && $row['user_role']== "Employee"){
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['user_name'] = $row['username'];
		$_SESSION['user_email'] = $row['user_email'];
		$_SESSION['emp_dept'] = $row['user_dept'];
		$_SESSION['user_role'] = $row['user_role'];
        $_SESSION['user_pass'] = $row['user_pass'];

		header("Location:employee.php");
	}

	else{
		echo '<script>
					alert("Invalid Details");
				</script>';
	}
}

?>

<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Login - Acrobat DMS</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css" />
	<link href="global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/layout.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/components.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/colors.min.css" rel="stylesheet" type="text/css" />
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="global_assets/js/main/jquery.min.js"></script>
	<script src="global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="global_assets/js/plugins/forms/validation/validate.min.js"></script>
	<script src="global_assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script src="assets/js/app.js"></script>
	<script src="global_assets/js/demo_pages/login_validation.js"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login card -->
				<form class="login-form form-validate" method="post" action="index.php">
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
								<h5 class="mb-0">Login to your account</h5>
								<span class="d-block text-muted">Your credentials</span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="email" class="form-control" name="user_email" placeholder="Enter Your Email" required />
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" class="form-control" name="user_password" placeholder="Password" required />
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" name="btnlogin" class="btn btn-primary btn-block">
									Login
									<i class="icon-circle-right2 ml-2"></i>
								</button>
							</div>
						</div>
					</div>
				</form>
				<!-- /login card -->

			</div>
			<!-- /content area -->


			<!-- Footer -->
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="text-center d-lg-none w-100">
					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
						<i class="icon-unfold mr-2"></i>
						Footer
					</button>
				</div>

				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text offset-md-4 col-md-6">
						&copy; 2019 - <?php echo date('Y'); ?>.
						<a href="#">Document Management Solution</a> by
						<a href="" target="_blank">Acrobat Systems</a>
					</span>
				</div>
			</div>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
