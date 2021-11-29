<?php
include 'includes/database.php';
$val= $_GET['dept_name'];


if(isset($val)){
   if($val=="Admin"){
       $sql2 = "SELECT * FROM departments";
       $sql2 = mysqli_query($con,$sql2);
       if (!$sql2) {
           echo mysqli_error();
       } else {
           if (mysqli_num_rows($sql2) > 0) {
               while ($array2 = mysqli_fetch_array($sql2)) {
                   ?>
                   <option value="<?php echo $array2['dept_name']; ?> "><?php echo $array2['dept_name']; ?></option>

                   <?php

               }
           }
       }
    }

    if($val=="Manager"){
        $sql3 = "SELECT * FROM departments";
        $sql3 = mysqli_query($con,$sql3);
        if (!$sql3) {
            echo mysqli_error();
        } else {
            if (mysqli_num_rows($sql3) > 0) {
                while ($array3 = mysqli_fetch_array($sql3)) {
                    ?>
                    <option value="<?php echo $array3['dept_name']; ?> "><?php echo $array3['dept_name']; ?></option>

                    <?php

                }
            }
        }
    }



    if($val=='Employee') {
       $sql1 = "SELECT * FROM subdepartments";
      $sql1 = mysqli_query($con,$sql1);
        if (!$sql1) {
            echo mysqli_error();
        } else {
            if (mysqli_num_rows($sql1) > 0) {
                while ($array1 = mysqli_fetch_array($sql1)) {
                    ?>
                    <option value="<?php echo $array1['subdept_name']; ?> "><?php echo $array1['subdept_name']; ?></option>

                    <?php

                }
            }
        }
    }
   // $sql = mysqli_query($con,$sql);


}



?>

