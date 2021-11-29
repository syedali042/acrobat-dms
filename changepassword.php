<?php 
	include 'includes/database.php';
	session_start();
	if($_SESSION['user_email'] == ''){
		header('Location:index.php');
    }
    
    if(isset($_POST['btnupdate'])){
        $old_pass = $_POST['old_pass'];
        $new_pass = $_POST['new_pass'];
        $cnew_pass = $_POST['cnew_pass'];
        $user_id = $_SESSION['user_id'];


        $select = mysqli_query($con, "SELECT * FROM users WHERE user_id = '$user_id' ");
        $row = mysqli_fetch_array($select);
        $pass = $row['user_pass'];
        
        if($old_pass == $pass){
            if($new_pass == $cnew_pass){
                $update = mysqli_query($con, "UPDATE users SET user_pass = '$new_pass' WHERE user_id = '$user_id'");
                if($update){
                    echo "<script>
                        alert('Password Updated');
                    </script>";
                }else{
                    echo "<script>
                        alert('Something Went Wrong');
                    </script>";
                }
            }else{
                echo "<script>
                alert('New Password and Confirm New Password Does Not Match');
            </script>";
            }
        }else{
            echo "<script>
            alert('Old Password Verification Failed');
        </script>";
        }
    }

	include 'includes/header.php'; 
?>


	<!-- Page content -->
	<div class="page-content">

    <?php 
        if($_SESSION['user_role'] =='Admin' ){
            include 'includes/sidebar.php';
        }elseif($_SESSION['user_role'] =='Employee'){
            include 'includes/emp_sidebar.php';   
        }else{
            include 'includes/manager_sidebar.php';
        }
	?>

		<!-- Main content -->
		<div class="content-wrapper">

			
			<!-- Content area -->
			<div class="content">
			<!-- All The Content Goes down here -->
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <h2 class="text-center">Update Password</h2>
                    <hr>
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post">
                                <input type="password" name="old_pass" class="form-control" placeholder="Enter Old Password">
                                <br>
                                <input type="password" name="new_pass" class="form-control" placeholder="Enter New Password">
                                <br>
                                <input type="password" name="cnew_pass" class="form-control" placeholder="Confirm New Password">
                                <br>
                                <button name="btnupdate" class="btn btn-warning float-right">Update</button>
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
