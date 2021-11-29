<?php
include 'includes/database.php';
session_start();
if($_SESSION['user_email'] == '' OR $_SESSION['user_role'] != 'Admin'){
    header('Location:index.php');
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

            <!-- Files Table -->

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h3 class="card-title"> <?php echo $_GET['deptname'];?> Detail</h3>
                    <a href="addDepartment.php" class="btn btn-primary float-right">Add New Department</a>
                </div>

                <table class="table datatable-pagination">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Department Name</th>
                        <th>Created On</th>
                        <th>Created By</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $deptname=$_GET['deptname'];
                    $sele = mysqli_query($con, "SELECT * FROM departments where dept_name='$deptname'");
                    $cnt=1;
                    while($row= mysqli_fetch_array($sele)){
                        ?>
                        <tr>

                            <td><?php echo $row['dept_id']; ?></td>
                            <td><?php echo $row['dept_name']; ?></td>
                            <td><?php echo $row['date_added']; ?></td>
                            <td><?php echo $row['added_by']; ?></td>
                            <td><a href=""><i class="icon-pencil5 text-info"></i></a></td>
                            <td><a href=""><i class="icon-trash text-danger"></i></a></td>
                        </tr>
                        <?php $cnt++;  }?>
                    </tbody>
                </table>
            </div>
            <!-- /pagination types -->


            <!-- There is the ending of main content -->

        </div>
        <!-- /content area -->


        <?php include 'includes/footer.php' ?>
        <script type="text/javascript">
            $(document).ready(function() {

                // $('#departCat').children('a').addClass('open');
                $('#departCat').children('ul').addClass('active');
                $('#departCat').children('ul').css('display', 'block');
                // $('#adminList').children('ul').addClass('active');
                //  $('#adminList').children('ul').css('display', 'block');
                // $('#managersList').children('ul').addClass('active');
                //  $('#managersList').children('ul').css('display', 'block');
                $('#userDept').children('a').addClass('open');
                $('#userDept').children('ul').addClass('active');
                $('#userDept').children('ul').css('display', 'block');


            });
        </script>

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->

</body>
</html>
