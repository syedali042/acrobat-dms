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
                    <h3 class="card-title"><?php echo $_GET['uname']; ?>&nbsp;Detail</h3>
                </div>

                <table class="table datatable-pagination">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Password</th>
                        <th>Created On</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    include 'includes/database.php';
                     $username=$_GET['uname'];
                     $user_role=$_GET['role'];

                    if($user_role=='Admin') {
                        $selected = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND user_role='$user_role'");
                    }
                    if($user_role=='Manager') {
                        $selected = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND user_role='$user_role'");
                    }
                    if($user_role=='Employee') {
                        $selected = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND user_role='$user_role'");
                    }

                    $vnt=1;
                    while($row = mysqli_fetch_array($selected)){

                        ?>
                        <tr>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['user_email']; ?></td>
                            <td><?php echo $row['user_pass']; ?></td>
                            <td><?php echo $row['date_joined']; ?></td>
                            <td><a href=""><i class="icon-trash text-danger"></i></a></td>
                        </tr>
                        <?php $vnt++; }?>
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
                           $('#userCat').children('a').addClass('open');
                        $('#userCat').children('ul').addClass('active');
                        $('#userCat').children('ul').css('display', 'block');
                        $('#adminList').children('ul').addClass('active');
                           $('#adminList').children('ul').css('display', 'block');
                           $('#managersList').children('ul').addClass('active');
                           $('#managersList').children('ul').css('display', 'block');
                           $('#employeesList').children('ul').addClass('active');
                           $('#employeesList').children('ul').css('display', 'block');


            });
        </script>

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->

</body>
</html>

