<?php
include("../../../classes/config.php");
include "../../../classes/conn.php";
include "../../../classes/admin_class.php";

$iteration = $_GET['iteration'];
$mode = $_GET['MODE'];
$admin = new admin_class();
if($mode == "ALL"){
	$admin->generateMeritList($iteration);
	$admin->updateGenerateMeritListFlag($iteration);
} else if($mode == "SINGLE"){
	$course_id = $_GET['course_id'];
	$course_level_id = $_GET['course_level_id'];
	$admin->generateSubjectWisemeritList($iteration, $course_id, $course_level_id);
} else if($mode == "UPDATE_FLAG"){
	$admin->updateGenerateMeritListFlag($iteration);
	echo "Merit List has been updated";
} else if ($mode == "PUBLISH") {
	$course_id = $_GET['course_id'];
	$course_level_id = $_GET['course_level_id'];
	echo $admin->publishSubjectWisemeritList($iteration, $course_id, $course_level_id);
}



//echo "Here is the result !! ITERATION = ".$iteration;

?>