<?php
session_start();
unset($_SESSION['application_no_id']);
session_destroy();
header("Location:index.php");
?>