<?php
  include 'includes/database.php';

  if (isset($_GET['file_id'])) {
    $file_id = $_GET['file_id'];

    $sql = mysqli_query($con, "SELECT * FROM files WHERE file_id = '$file_id' ");

    $row = mysqli_fetch_array($sql);
    $file_path = 'files/' . $row['file'];

    if (file_exists($file_path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_path));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('files/' . $row['file']));
        readfile('files/' . $row['file']);
        header('location: ');
    }else {
      echo "Error";    
    }
  }

?>
