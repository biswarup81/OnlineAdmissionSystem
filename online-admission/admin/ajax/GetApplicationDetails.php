<?php
include("../../../classes/config.php");
include "../../../classes/conn.php";
include "../../../classes/admin_class.php";

$mobile_number = $_GET['mobile_number'];

$admin = new admin_class();

$result = $admin->getApplicationDetailsByMobileNumber($mobile_number);

echo json_encode($result);

?>