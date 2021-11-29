<?php 
	include 'includes/database.php';
	session_start();
	if($_SESSION['user_email'] == '' OR $_SESSION['user_role'] != 'Manager'){
		header('Location:index.php');
    }
    
    if(isset($_POST['btnup'])){
        $id = $_GET['title'];

        $task_com = $_POST['task_comments'];
        $date = date('m/d/yy');
        
        
            $update = mysqli_query($con, "UPDATE tasks SET task_comments = '$task_com',  completed_on = '$date', status = 'Completed' WHERE task_title = '$id' ");
            if($update){
                echo "<script>
                alert('Task Submitted');
                windows.location.href = 'manager_tasks.php';
            </script>";
            }else{
                "<script>
            alert('Something Went Wrong');
        </script>";
            }
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
                <?php 
                    $title = $_GET['title'];
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body"> 
                                <h1 class="text-center"><?php echo $title; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="offset-md-1 col-md-10">
                        <div class="card">
                            <div class="card-body"> 
                                <h3 class="text-center">Task Details</h3>
                                <?php

                                    $sele= mysqli_query($con, "SELECT * FROM tasks WHERE task_title = '$title'");
                                    $row= mysqli_fetch_array($sele);

                                ?>
                                <b>Task Date</b>: <?php echo $row['assigned_on']; ?>
                                <br>
                                <b>Status</b>: <?php echo $row['status']; ?>
                                <br>
                                <b>Deadline</b>: <?php echo $row['completion_date']; ?>
                                <br>
                                

                                <p class="text-center"> <?php echo $row['task_details'];  ?> </p>

                                <br><br>
                                <h3 class="text-center">Your Response</h3>
                                <hr>

                                <form action="" method="post" enctype="multipart/form-data">
                                    <label for="">Comments:</label>
                                    <textarea name="task_comments" class="form-control" cols="10" rows="2"></textarea>
                                   
                                        <br>
                                        <button name="btnup" class="btn btn-primary">Submit Task</button>
                                        <hr>
                                </form>
                                <br>
                                <a href="tasks.php" class="btn btn-primary float-right">Back to all task</a>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                

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
