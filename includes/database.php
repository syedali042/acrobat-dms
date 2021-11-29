<?php

// $host = 'localhost';
// $username = 'acrobatdmscom_user';
// $password = 'o@-.Uc?(?JTo';
// $database = 'acrobatdmscom_db';

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'acrobatdmscom_db';
$con = mysqli_connect($host, $username, $password, $database);

if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_error();
}


?>