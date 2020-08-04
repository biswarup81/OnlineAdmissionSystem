<?php
$hostname="localhost";
$username="root";
$password="ot288fO8JypG";
$dbname="online_admission_system_app";

$conn=mysqli_connect($hostname,$username,$password,$dbname);
if(!$conn){
	die('Database Connection Failed'.mysqli_connect_errno());
}
else{
	mysqli_select_db($conn,$dbname);
}

?>
