<?php
ob_start();
session_start();
$_SESSION=array();
//session_destroy();
unset($_SESSION['adminid']);
unset($_SESSION['password']);
header("Location:login.php");
exit;

?>