<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

<!-- Sidebar mobile toggler -->
<div class="sidebar-mobile-toggler text-center">
    <a href="#" class="sidebar-mobile-main-toggle">
        <i class="icon-arrow-left8"></i>
    </a>
    Menu
    <a href="#" class="sidebar-mobile-expand">
        <i class="icon-screen-full"></i>
        <i class="icon-screen-normal"></i>
    </a>
</div>
<!-- /sidebar mobile toggler -->


<!-- Sidebar content -->
<div class="sidebar-content">

    <!-- Main navigation -->

    <div class="card card-sidebar-mobile">


        <div class="treeview-animated  ">

            <ul class="treeview-animated-list mb-3">
                <li  class="treeview-animated-items">
                    <a class="closed">
                        <div class="treeview-animated-element" onclick="window.location.href='admin.php'"><span><i class="icon-home4 ic-w mr-1"></i><span> <text class="hideNav">Dashboard</text></span></div>
                    </a>
                <hr>
                </li>

                <li  class="treeview-animated-items" id="userCat">
                    <a class="closed">
                        <i class="fas fa-angle-right hideNav"></i>
                        <span onclick="window.location.href='allUsers.php'"><i class="far fa fa-info-circle ic-w mx-1" ></i> <text class="hideNav">User Category</text></span>
                    </a>
                    <ul class="nested">

                        <!--Admin list -->
                        <li class="treeview-animated-items"  id="adminList">
                            <a class="indivi_val"><i class="fas fa-angle-right hideNav" ></i>
                                <span onclick="window.location.href='admins.php'"><i class="far fa-user ic-w mx-1"></i>Admins</span></a>
                            <!-- <ul class="nested">
                                <li id="indiv_val">

                                    <?php

                                    $select = mysqli_query($con,"SELECT * FROM users WHERE user_role = 'Admin' ");
                                    $cnt = 1;
                                    while($row = mysqli_fetch_array($select)){
                                        ?>
                                        <div   class="treeview-animated-element" onclick="window.location.href='individual.php?uname=<?php echo $row['username']; ?>& role=<?php  echo $row['user_role']; ?>'"><i class="far fa-user ic-w mr-1"></i>
                                            <span ><?php echo $row['username']; ?></span> </div>


                                        <?php $cnt++; } ?>

                                </li>

                            </ul> -->
                        </li>
                        <!--managers list -->
                        <li class="treeview-animated-items" id="managersList">
                            <a class="indivi_val"><i class="fas fa-angle-right hideNav"></i>
                                <span onclick="window.location.href='managers.php'"><i class="far fa-user ic-w mx-1"></i>Manager</span></a>
                           <!--  <ul class="nested">
                                <li class="indivi_val">

                                        <?php

                                        $select = mysqli_query($con,"SELECT * FROM users WHERE user_role = 'Manager' ");
                                        $cnt = 1;
                                        while($row = mysqli_fetch_array($select)){
                                            ?>
                                        <div class="treeview-animated-element" onclick="window.location.href='individual.php?uname=<?php echo $row['username']; ?>& role=<?php  echo $row['user_role']; ?>'"><i class="far fa-user ic-w mr-1"></i>
                                        <span><?php echo $row['username']; ?></span> </div>


                                            <?php $cnt++; } ?>

                                </li>

                            </ul> -->
                        </li>


                        <!--Employees list -->
                        <li class="treeview-animated-items" id="employeesList">
                            <a class="indivi_val"><i class="fas fa-angle-right hideNav"></i>
                                <span  onclick="window.location.href='employees.php'"><i class="far fa-user ic-w mx-1"></i>Employees</span></a>
                            <!-- <ul class="nested">
                                <li class="indivi_val">

                                    <?php

                                    $select = mysqli_query($con,"SELECT * FROM users WHERE user_role = 'Employee' ");
                                    $cnt = 1;
                                    while($row = mysqli_fetch_array($select)){
                                        ?>
                                        <div class="treeview-animated-element" onclick="window.location.href='individual.php?uname=<?php echo $row['username']; ?>&role=<?php  echo $row['user_role']; ?>'"><i class="far fa-user ic-w mr-1"></i>
                                            <span><?php echo $row['username']; ?></span> </div>


                                        <?php $cnt++; } ?>

                                </li>

                            </ul> -->
                        </li>
                    </ul>
                </li>













            <!-- departments -->

                <li class="treeview-animated-items" id="departCat">
                    <a class="closed">
                        <i class="fas fa-angle-right hideNav"></i>
                        <span><i class="icon-drawer mx-1"></i> <text class="hideNav">Departments</text></span>
                    </a>
                    <ul class="nested">

                        <li class="treeview-animated-items" id="userDept">
                            <a class="closed"><i class="fas fa-angle-right hideNav"></i>
                                <span  onclick="window.location.href='departments.php'"><i class="far icon-drawer ic-w mx-1"></i>Departments</span></a>
                            <ul class="nested">
                                <li>
                                    <?php

                                    $select = mysqli_query($con,"SELECT DISTINCT * FROM departments ");
                                    $cnt = 1;
                                    while($row = mysqli_fetch_array($select)){
                                        ?>
                                        <div class="treeview-animated-element" onclick="window.location.href='individual_dept.php?deptname=<?php echo $row['dept_name']; ?>'"><i class="far icon-drawer ic-w mr-1"></i>
                                            <span><?php echo $row['dept_name']; ?></span> </div>
                                        <?php $cnt++; } ?>
                                </li>

                            </ul>
                        </li>


                        <li class="treeview-animated-items" id="userSubdept">
                            <a class="closed"><i class="fas fa-angle-right hideNav"></i>
                                <span  onclick="window.location.href='subdepartments.php'"><i class="far icon-office ic-w mx-1"></i>Sub Departments</span></a>
                            <ul class="nested">
                                <li>
                                    <?php

                                    $select = mysqli_query($con,"SELECT DISTINCT * FROM subdepartments ");
                                    $cnt = 1;
                                    while($row = mysqli_fetch_array($select)){
                                        ?>
                                        <div class="treeview-animated-element" onclick="window.location.href='individual_subdept.php?subdeptname=<?php echo $row['subdept_name']; ?>'" ><i class="far fa-building-o ic-w mr-1"></i>
                                            <span><?php echo $row['subdept_name']; ?></span> </div>
                                        <?php $cnt++; } ?>
                                </li>

                            </ul>
                        </li>



                    </ul>
                </li>







<!-- file section -->
                <li class="treeview-animated-items" id="filesCat">
                    <a class="closed">
                        <i class="fas fa-angle-right hideNav"></i>
                        <span><i class="fa fa-file mx-1"></i> <text class="hideNav">Files</text></span>
                    </a>
                    <ul class="nested">
                        <li id="userFiles">
                            <div class="treeview-animated-element" onclick="window.location.href='allfiles.php'" ><i class="fas fa-file ic-w mr-1"></i><span>All Updated Files</span></div>
                        </li>
                        <li id="addfile">
                            <div class="treeview-animated-element" onclick="window.location.href='admin_uploadfile.php'"><i class="icon-file-upload ic-w mr-1"></i><span>Add New File</span></div>
                        </li>
                    </ul>
                </li>


                <!-- task section -->
                <li class="treeview-animated-items" id="tasksCat">
                    <a class="closed">
                        <i class="fas fa-angle-right hideNav"></i>
                        <span><i class="icon-stack mx-1"></i> <text class="hideNav">Tasks</text></span>
                    </a>
                    <ul class="nested">
                        <li id="alltasks">
                            <div class="treeview-animated-element" onclick="window.location.href='tasks.php'"><i class="icon-stack ic-w mr-1"></i><span>All Tasks</span></div>
                        </li>
                        <li id="addtask">
                            <div class="treeview-animated-element" onclick="window.location.href='addtask.php'"><i class="icon-stack-plus ic-w mr-1"></i><span>Assign Task</span></div>
                        </li>
                    </ul>
                </li>



                <li id="addUser">
                    <div class="treeview-animated-element" onclick="window.location.href='addUser.php'"><span><i class="icon-user-plus ic-w mr-1"></i><span><text class="hideNav">Add New User</text></span></div>
                </li>


                <li id="addUser">
                    <div class="treeview-animated-element">
                        <notice>
                            <span><i class="fa fa-bell"></i> <span><text class="hideNav">Manage Notice</text></span>
                        </notice>
                    </div>
                </li>

            </ul>

        </div>




       <!-- <ul class="nav nav-sidebar" data-nav-type="accordion">

            <!-- Main -->
            <!--
            <li class="nav-item">
                <a href="admin.php" class="nav-link">
                    <i class="icon-home4"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="allfiles.php" class="nav-link">
                    <i class="icon-files-empty2"></i>
                    <span>All Updated Files</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="departments.php" class="nav-link">
                    <i class="icon-drawer"></i>
                    <span>Departments</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="subdepartments.php" class="nav-link">
                    <i class="icon-office"></i>
                    <span>Sub Departments</span>
                </a>
            </li>
           <!-- <li class="nav-item">
                <a href="managers.php" class="nav-link">
                    <i class="icon-user-tie"></i>
                    <span>Managers</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="employees.php" class="nav-link">
                    <i class="icon-user"></i>
                    <span>Employees</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="admins.php" class="nav-link">
                    <i class="icon-user-check"></i>
                    <span>Admins</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="addUser.php" class="nav-link">
                    <i class="icon-user-plus"></i>
                    <span>Add New User</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="tasks.php" class="nav-link">
                    <i class="icon-stack-plus"></i>
                    <span>All Tasks</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="admin_uploadfile.php" class="nav-link">
                    <i class="icon-file-upload"></i>
                    <span>Upload Today's File</span>
                </a>
            </li>
            
        </ul>

    <!-- /main navigation -->


</div>
<!-- /sidebar content -->


</div>


</div>
<!-- /main sidebar -->
<script type="text/javascript">
    $(document).ready(function() {
        $('notice').click(function() {
            $this = $(this);
            var action = 'getNotice';
            $.post('includes/ajax.php', {action:action}, function(resp){
                resp = $.parseJSON(resp);
                if(resp.status==true){
                    $this.parent('div').parent('li').after('<br><div id="noticeCard" class="card" style="margin-right:10px;border-radius:3px;"><div class="card-header"><textarea type="text" id="notText" class="form-control">'+resp.data.not_text+'</textarea></div><div class="card-footer"><a href="javascript://" id="saveNotice">Save & Close</a></div></div>');
                }
            });
        });

        $(document).on('click', '#saveNotice', function(){
            var notText = $('#notText').val();
            var action = 'saveNotice';
            $.post('includes/ajax.php', {notText:notText,action:action}, function(resp){

                resp = $.parseJSON(resp);
                if(resp.status==true){

                    $('#noticeCard').fadeOut('slow', function() {});

                }

            });
        });
    });
</script>