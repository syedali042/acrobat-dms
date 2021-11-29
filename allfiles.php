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
                        <h3 class="card-title">All updated files</h3>
                        <button class="btn btn-primary btn-sm backUp" style="float: right;"><i class="fa fa-download"></i> Back Up</button>
                    </div>

                    <table class="table datatable-pagination">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>File Title</th>
                                <th>Uploaded By</th>
                                <th>Department</th>
                                <th>Date</th>
                                <th>Download</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <div id="inFileSearch">
                            <center>
                                <input style="width:95%;" type="text" class="form-control" id="searchInFile" placeholder="Search Within The File">
                                <!-- <button class="btn btn-danger btn-sm searchWithinFile" style="width: 95%;"><i class="fa fa-search"></i> Search Within Files</button> -->
                            </center>
                        </div>
                        <tbody id="filesTable">
                                <?php 
                                    $sele = mysqli_query($con, "SELECT * FROM files ORDER BY file_id DESC");
                                    $cnt=1;
                                    while($row= mysqli_fetch_array($sele)){
                                ?>
                            <tr>
                                
                                <td><?=$row['file_id']?></td>
                                <td><?=$row['file_name']?></td>
                                <td><?=$row['added_by']?></td>
                                <td><?=$row['dept_name']?></td>
                                <td><?=$row['added_date']?></td>
                                <td><a href="downloadfile.php?file_id=<?php echo $row["file_id"]; ?>"><i class="icon-file-download2 text-info"></i></a></td>
                                <td><a href=""><i class="icon-trash text-danger"></i></a></td>
                            </tr>
                            <?php $cnt++;  }?>
                            <tr colspan="7">
                                    <center>
                                        <div style="margin-top:15px;display:none;margin-bottom:10px;" id="spinner" class="spinner-border text-dark" role="status">
                                          <span class="sr-only">Loading...</span>
                                        </div>
                                    </center>
                                    <small style="padding-left:30px;display:none;">* Note: Search Within Files works auto when text will greater than 30 Characters....</small>
                            </tr>
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
                    $("#searchInFile").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#filesTable tr").filter(function() {
                          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                    });
                    // $('#tasksCat').children('a').addClass('open');
                    $('#filesCat').children('ul').addClass('active');
                    $('#filesCat').children('ul').css('display', 'block');
                    // $('#adminList').children('ul').addClass('active');
                    //  $('#adminList').children('ul').css('display', 'block');
                    // $('#managersList').children('ul').addClass('active');
                    //  $('#managersList').children('ul').css('display', 'block');
                    $('#userFiles').addClass('open');
                    $('#userFiles').addClass('active');
                    $('#userFiles').css('display', 'block');

                    $(document).on('click', '.backUp',function(){
                        $this = $(this);
                        var action = 'backUp';
                        $.post('backUpAjax.php', {action:action}, function(resp) {

                            resp = $.parseJSON(resp);
                            if(resp.status==true){
                                // console.log(resp);

                                var departments = resp.departments;
                                var subdepartments = resp.subdepartments;
                                var employees = resp.employees;

                                $this.parent('div').append('<select id="departments" class="form-control" style="width:15%;"><option value="">Select Department</option></select><select id="employees" class="form-control" style="width:15%;"><option value="">Select Employee</option></select><input type="date" id="date1" class="form-control" style="width:10%;"><input type="date" id="date2" class="form-control" style="width:10%;">');
                                departments.forEach(function(e){
                                    $('#departments').append('<option value="'+e.dept_name+'">'+e.dept_name+'</option>');
                                });
                                employees.forEach(function(e){
                                    $('#employees').append('<option value="'+e.username+'">'+e.username+'</option>');
                                });

                                $this.parent('div').append('<button class="btn btn-primary btn-sm createBackup"><i class="fa fa-download"></i> Create Backup</button>&nbsp;&nbsp;<button class="btn btn-danger btn-sm" id="cancelBackup" style="float: right;"><i class="fa fa-times"></i> Cancel</button>');
                                $this.remove();

                            }
                        });

                    });
                    $(document).on('click', '#cancelBackup', function(){
                        $this = $(this);
                        $('#departments').remove();
                        $('#date1').remove();
                        $('#date2').remove();
                        $('#employees').remove();
                        $('.createBackup').remove();
                        $this.parent('div').append('<button class="btn btn-primary btn-sm backUp" style="float: right;"><i class="fa fa-download"></i> Back Up</button>');
                        $this.remove();
                    });

                    $(document).on('click', '.createBackup', function(){
                        $this = $(this);
                        var departments = $('#departments').val();
                        var date1 = $('#date1').val();
                        var date2 = $('#date2').val();
                        var employees = $('#employees').val();
                        var action = 'createBackup';
                        $.post('backUpAjax.php', {departments:departments, date1:date1, employees:employees, date2:date2, action:action}, function(resp) {
                            
                            resp = $.parseJSON(resp);
                            if(resp.status==true){
                                console.log(resp);
                                $this.parent('div').append('<a id="backUpDwnload" href="'+resp.path+'" class="btn btn-primary btn-sm">Download</a><input type="hidden" id="backUpFileName" value="'+resp.path+'">');
                                $this.remove();
                                $('#cancelBackup').remove();
                            }

                        });
                    });
                    $(document).on('click', '#backUpDwnload', function(){
                        var backUpFileName = $('#backUpFileName').val();
                        var action = 'deleteFiles';
                        setTimeout(function(){
                            $.post('backUpAjax.php', {backUpFileName:backUpFileName, action:action}, function(resp) {
                            
                            resp = $.parseJSON(resp);
                            if(resp.status==true){
                                window.open('allfiles.php', '_self');       
                            }

                        });
                        }, 5000);
                        
                    });
                    
                    $('.searchWithinFile').click(function(){

                        $this = $(this);
                        // $('#inFileSearch').append('<center><input style="width:95%;" type="text" class="form-control" id="searchInFile" placeholder="Search Within The File"><center>');

                        $this.remove();

                    });

                    $(document).on('keyup', '#searchInFile', function(){
                        var searchedStr = $(this).val();
                        var action = 'searchInFile';
                            if(searchedStr.length>=30){
                            $('tbody').empty();
                            $('#spinner').css('display','block');
                            $.post('searchAjax.php', {searchedStr:searchedStr, action:action}, function(resp){
                            

                                resp = $.parseJSON(resp);
                                // resp = JSON.parse(resp);
                                    
                                if(resp.status==true){
                                    fileRows = resp.fileRow;
                                    fileRows.forEach(function(file){
                                        $('tbody').append('<tr><td>'+file.file_id+'</td><td>'+file.file_name+'</td><td>'+file.added_by+'</td><td>'+file.dept_name+'</td><td>'+file.added_date+'</td><td><a href="files/'+file.file+'"><i class="icon-file-download2 text-info"></i></a></td><td><a href=""><i class="icon-trash text-danger"></i></a></td></tr>');
                                    });
                                    console.log(resp);
                                }
                                $('#spinner').css('display','none');
                            });
                            }else{
                                $('#spinner').css('display','none');
                                $('small').css('display','block');
                            }
                           
                    });
                });
            </script>

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</body>
</html>
