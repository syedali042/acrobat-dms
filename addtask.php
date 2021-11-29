<?php 
    include 'includes/database.php';

    session_start();
    if($_SESSION['user_email'] == '' OR $_SESSION['user_role'] != 'Admin'){
        header('Location:index.php');
    }
    
    if(isset($_POST['btnadd'])) {
       
        $error='';
        $filee='';
        $to_mail = '';
        $uname='';
        $from_mail = $_SESSION['user_email'];
        $assigned_to = $_POST['assigned_to'];
        $umail = mysqli_query($con, "SELECT * FROM users WHERE username= '$assigned_to'");
        while ($mails = mysqli_fetch_array($umail)) {
            $to_mail = $mails['user_email'];
            $uname = $mails['username'];
        }
        $task_title = $_POST['task_title'];
        $date_completion = $_POST['date_completion'];
        $task_details = $_POST['task_details'];
        $date_added = date('m/d/yy');
        $added_by = $_SESSION['user_name'];

        // Working With Files
        $file_name = $_FILES['up_file']['name'];
        $file_temp = $_FILES['up_file']['tmp_name'];
        $file_size = $_FILES['up_file']['size'];

        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        $file_new = rand(100, 1000) . '-' . $file_name;
        $store = "files/" . $file_new;

        if ($file_ext == 'pdf' || $file_ext == 'xlsx' || $file_ext == 'docx' || $file_ext == 'doc' || $file_ext == 'png' || $file_ext == 'jpg' || $file_ext == 'jpeg' || $file_ext == 'ppt' || $file_ext == 'pptx' || $file_ext == '') {
            if ($file_size > 500000) {
                $error = "<script>
                alert('File size must be lesser then 5 MB');
            </script>";
                echo $error;
            } else {
                if (move_uploaded_file($file_temp, $store)) {
                    $filee = $file_new;
                }
            }
        } else {
            $error = "<script>
            alert('Please upload .pdf, .xls, .docs, .ppt, .pptx, png, .jpeg or .doc file');
        </script>";
            echo $error;
        }
        if (!$error) {
            $insert1 = mysqli_query($con, "INSERT INTO tasks (task_title, completion_date, task_details, assigned_to, status,assigned_on)VALUES('$task_tite', '$date_completion', '$task_details', '$assigned_to','Pending', '$date_added')");

            $insert2 = mysqli_query($con, "INSERT INTO files(file_name, file, added_by,added_to, added_date) VALUES('$task_tite', '$filee', '$added_by','$assigned_to', '$date_added')");
            
            if ($insert1 && $insert2) {

                $to = $to_mail;
                $subject = 'New Task Assigned';
                $message = $task_details;
                $header = 'From: admin@acrobatdms.com';
                
                if(mail($to, $subject, $message, $header)){
                    echo "Mail Sent To: ".$to_mail;
                }else{
                    echo "Error";
                }
            }    
        
        }
    }
    include 'includes/header.php'; 
    
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
                                    <h2 class="text-center">Add New Task</h2>
                                    <hr>
                                    <form action="" method="post" enctype="multipart/form-data" role="form">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <label for="">Task Name:</label>
                                                <input type="text" name="task_title" placeholder="Enter Task Title" class="form-control">
                                            </div>
                                            <div col-md-6>
                                         <label for="">Completion Date:</label> 
                                         <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                            </span>
                                            <input type="text" name="date_completion" class="form-control daterange-single" value="<?php echo date("m/d/yy"); ?>">
                                        </div>              
                                    </div>
                                        </div>
                                        
                                        <br>
                                        <label for="">Task Details:</label>
                                        <textarea name="task_details" class="form-control" cols="30" rows="10"></textarea>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <label for="">Select:</label>
                                            <select class="form-control select-search" name="assigned_to" required data-fouc>
                                            <option value="" selected disabled>Assign to</option>
                                            <optgroup label="Managers">
                                                <?php 
                                                    $s = mysqli_query($con, "SELECT * FROM users WHERE user_role= 'Manager'");
                                                    $cntdt=1;
                                                    while($m = mysqli_fetch_array($s)){
                                                ?>
                                                <option value="<?php echo $m['username']; ?>"><?php echo $m['username']; ?></option>
                                                <?php $cntdt; } ?>
                                            </optgroup>
                                            <optgroup label="Employees">
                                            <?php 
                                                    $s = mysqli_query($con, "SELECT * FROM users WHERE user_role= 'Employee'");
                                                    $cntdt=1;
                                                    while($m = mysqli_fetch_array($s)){
                                                ?>
                                                <option value="<?php echo $m['username']; ?>"><?php echo $m['username']; ?></option>
                                                <?php $cntdt; } ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                        <div class="col-md-6">
                                        <label for="">Upload File:</label>
                                        <input type="file" name="up_file" class="form-input-styled"  data-fouc>
                                        <span class="form-text text-muted">Accepted formats: pdf, doc, xls.  Max file size 7Mb</span>
                                        </div>
                                    
                                </div>
                                        

                                        <br>
                                        <button name="btnadd" class="btn btn-primary float-right">Assign Task</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            <!-- There is the ending of main content -->

            </div>
            <!-- /content area -->


        <?php include 'includes/footer.php' ?>
            <script type="text/javascript">
                $(document).ready(function() {

                    //$('#tasksCat').children('a').addClass('open');
                    $('#tasksCat').children('ul').addClass('active');
                    $('#tasksCat').children('ul').css('display', 'block');
                    // $('#adminList').children('ul').addClass('active');
                    //  $('#adminList').children('ul').css('display', 'block');
                    // $('#managersList').children('ul').addClass('active');
                    //  $('#managersList').children('ul').css('display', 'block');
                    $('#addtask').addClass('open');
                    $('#addtask').addClass('active');
                    $('#addtask').css('display', 'block');


                });
            </script>

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</body>
</html>
