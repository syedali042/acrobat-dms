<?php 

	require 'database.php';

	if(isset($_POST['action']) && $_POST['action']=='backUp'){

		$departments = array();
		$subdepartments = array();
		$employees = array();
		$selectDepartments = mysqli_query($con, "SELECT * FROM departments");
		$selectsubdepartments = mysqli_query($con, "SELECT * FROM subdepartments");
		$selectEmployees = mysqli_query($con, "SELECT * FROM users WHERE user_role = 'Employee' ");
		while ($row=mysqli_fetch_assoc($selectDepartments)) {
			$departments[] = $row;
		}
		while ($row=mysqli_fetch_assoc($selectsubdepartments)) {
			$subdepartments[] = $row;
		}
		while ($row=mysqli_fetch_assoc($selectEmployees)) {
			$employees[] = $row;
		}
		echo json_encode(array('status'=>true, 'departments'=>$departments, 'subdepartments'=>$subdepartments, 'employees'=>$employees));

	}else if(isset($_POST['action']) && $_POST['action']=='createBackup'){

		$departments = $_POST['departments'];
		$date1 = date_create($_POST['date1']);
		$date1 = date_format($date1, 'm/d/Y');
		$date2 = date_create($_POST['date2']);
		$date2 = date_format($date2, 'm/d/Y');
		$employees = $_POST['employees'];

		date_default_timezone_set('Asia/Karachi');
		$todayDate = date('m/d/Y');

		$files=array();
		if($departments!=='' && $employees!=='' && $date1!=='' && $date2!==''){
			$selectfiles = mysqli_query($con, "SELECT * FROM files WHERE dept_name = '$departments' AND added_to = '$employees' AND added_date BETWEEN '$date1' AND '$date2' ");

			while ($row = mysqli_fetch_assoc($selectfiles)) {
				$files[] = $row['file'];
			}
		}else if($employees=='' && $date1 == $todayDate && $date2 == $todayDate){
			$selectfiles = mysqli_query($con, "SELECT * FROM files WHERE dept_name = '$departments' ");

			while ($row = mysqli_fetch_assoc($selectfiles)) {
				$files[] = $row['file'];
			}
		}else if($departments=='' && $date1 == $todayDate && $date2 == $todayDate){
			$selectfiles = mysqli_query($con, "SELECT * FROM files WHERE added_to = '$employees' ");

			while ($row = mysqli_fetch_assoc($selectfiles)) {
				$files[] = $row['file'];
			}
		}else if($employees!=='' && $date1 !== $todayDate && $date2==$todayDate){

			$selectfiles = mysqli_query($con, "SELECT * FROM files WHERE added_to = '$employees' AND added_date = '$date1' ");
			while ($row = mysqli_fetch_assoc($selectfiles)) {
				$files[] = $row['file'];
			}

		}else if($departments!=='' && $date1 !== $todayDate && $date2==$todayDate){

			$selectfiles = mysqli_query($con, "SELECT * FROM files WHERE dept_name = '$departments' AND added_date = '$date1' ");
			while ($row = mysqli_fetch_assoc($selectfiles)) {
				$files[] = $row['file'];
			}

		}else if($employees!=='' && $date1 !== $todayDate && $date2!==$todayDate){

			$selectfiles = mysqli_query($con, "SELECT * FROM files WHERE added_to = '$employees' AND added_date BETWEEN '$date1' AND '$date2' ");
			
			while ($row = mysqli_fetch_assoc($selectfiles)) {
				$files[] = $row['file'];
			}

		}else if($departments!=='' && $date1 !== $todayDate && $date2!==$todayDate){

			$selectfiles = mysqli_query($con, "SELECT * FROM files WHERE dept_name = '$departments' AND added_date BETWEEN '$date1' AND '$date2' ");
			while ($row = mysqli_fetch_assoc($selectfiles)) {
				$files[] = $row['file'];
			}

		}
		// Checking files are selected  
				$file_folder = '../files/';
                $zip = new ZipArchive(); // Load zip library   
                $zip_name = "Download" .time().".zip";           // Zip name  
                if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE)  
                {   
                     // Opening zip file to load files  
                     $error .= "* Sorry ZIP creation failed at this time";  
                }  
                foreach($files as $file)  
                {   
                     $zip->addFile($file_folder.$file); // Adding files into zip  
                }  
                $zip->close();  
                if(file_exists($zip_name))  
                {  
                    header("Pragma: public");
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("Cache-Control: public");
                    header("Content-Description: File Transfer");
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment; filename=\"".$zip_name."\"");
                    header("Content-Transfer-Encoding: binary");
                    header("Content-Length: ".filesize($file_folder.$file));
                    ob_end_flush();
                    @readfile($file_folder.$file);
                    
                }

		echo json_encode(array('status'=>true, 'departments'=>$departments, 'date1'=>$date1, 'date2'=>$date2, 'employees'=>$employees, 'files'=>$files));
	}else if(isset($_POST['action']) && $_POST['action']=='getNotice'){

		$selectNotice = mysqli_query($con, "SELECT * FROM notices");
		$notice = mysqli_fetch_assoc($selectNotice);
		if($notice==true){
			echo json_encode(array('status'=>true, 'data'=>$notice));
		}

	}else if(isset($_POST['action']) && $_POST['action']=='saveNotice'){

		$updateNotice = mysqli_query($con, "update notices set not_text = '".$_POST['notText']."' ");
		if($updateNotice == true){
			echo json_encode(array('status'=>true, 'data'=>$_POST));
		}

	}

?>