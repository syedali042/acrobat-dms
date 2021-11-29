<?php
include 'includes/database.php';
include_once 'includes/database.php';
session_start();
if($_SESSION['user_email'] == ''){
    header('Location:index.php');
}

if(isset($_POST['btnadd'])) {
    $fileTitle = $_POST['file_title'];
    $added_by = $_SESSION['user_name'];
    $added_date = date('m/d/yy');
    // Working With Files
    $file_name = $_FILES['up_file']['name'];
    $file_temp = $_FILES['up_file']['tmp_name'];
    $file_size = $_FILES['up_file']['size'];

    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));

    $file_new = rand(100, 1000) . '-' . $file_name;
    $store = "files/" . $file_new;

    if ($file_ext == 'pdf' || $file_ext == 'xlsx' || $file_ext == 'docx' || $file_ext == 'doc' || $file_ext == 'png' || $file_ext == 'jpg' || $file_ext == 'jpeg'|| $file_ext == 'ppt' || $file_ext == 'pptx') {
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
           alert('Please upload .pdf, .xls, .docs, .png, .jpeg, .ppt, .pptx or .doc file');
        </script>";
        echo $error;
    }
    foreach ($_POST['sub_dept'] as $key => $value) {
        $dept = $value;
        if (!isset($error)) {
            $inserting = mysqli_query($con, "INSERT INTO files(file_name, file, added_by, added_date, dept_name) VALUES('$fileTitle', '$filee', '$added_by', '$added_date', '$dept')");
            if ($inserting) {
                echo "<script>
                alert('Uploading Successfull');
            </script>";
            } else {
                echo "<script>
            alert('Something Went Wrong');
        </script>";
            }
        }
    }


}
include 'includes/header.php'; ?>


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
                <div class=" offset-md-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-center">Upload Today Report</h2>
                            <hr>
                            <form action="" method="post" enctype="multipart/form-data" role="form">
                                <input type="text" name="file_title" placeholder="Enter File Title" class="form-control">
                                <br>
                                <label for="">Upload File:</label>
                                <input type="file" name="up_file" class="form-input-styled"  data-fouc>
                                <span class="form-text text-muted">Accepted formats: pdf, doc, xls.  Max file size 7Mb</span>
                                <br>
                                <select class="form-control select-search" name="sub_dept[]"  multiple required data-fouc>
                                    <option value=""  disabled>Select Sub Department</option>
                                    <?php
                                   $dd= $_SESSION['manager_dept'];
                                    $selected = mysqli_query($con, "SELECT * FROM departments WHERE dept_name ='$dd'");
                                    while($roww = mysqli_fetch_array($selected)){
                                        $fg = $roww['dept_name'];
                                        $select = mysqli_query($con, "SELECT * FROM subdepartments WHERE parent_dept = '$fg'");
                                        $bnnn = 1;
                                        while($row = mysqli_fetch_array($select)){
                                            ?>
                                            <option value="<?php echo $row['subdept_name'];?>"><?php echo $row['subdept_name'];?></option>
                                            <?php $bnnn++; }} ?>

                                </select>

                                <br><br><br>
                                <button name="btnadd" class="btn btn-primary float-right">Upload</button>
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
