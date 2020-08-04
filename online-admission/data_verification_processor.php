<?php
include "../classes/config.php";
include "../classes/conn.php";
$return_data = array();
$app_no=$_POST['app_no'];
if (!empty($app_no) && !empty($_POST['verification_success']) && $_POST['verification_success']=='true') {
	$update_query = "update application_table set Doc_verified=1 where Application_No=$app_no";
	mysql_query($update_query) or die(mysql_error());
	$return_data='Application successfully marked as VERIFIED Correct';
}elseif(!empty($app_no) && !empty($_POST['verification_failed']) && $_POST['verification_failed']=='true') {
	$update_query = "update application_table set Doc_verified=0 where Application_No=$app_no";
	mysql_query($update_query) or die(mysql_error());
	$return_data='Application successfully marked as VERIFIED INCORRECT';
}
echo json_encode($return_data);
?>