<?php
include("../../../classes/config.php");
include "../../../classes/conn.php";
include ("../../../classes/admin_class.php");

$flag=0;
$id=$_REQUEST['id'];
$app_details_q=mysql_query("select * from application_table where id='".$id."' and `admit`=0");
$num=mysql_num_rows($app_details_q);
if($num>0){
	$app_details=mysql_fetch_array($app_details_q);
	$seats_details_q=mysql_query("SELECT * FROM `course_seat_structure` WHERE `Course_Id`='$app_details[course_id]' and `Course_Level_Id`='$app_details[course_level_id]' and `Session_id`='$app_details[session_id]'");
	$row_count=mysql_num_rows($seats_details_q);
	if($row_count>0){
			$seats_details=mysql_fetch_array($seats_details_q);
			if($app_details['Category']=='SC'){
				if($seats_details['SC']>$seats_details['SC_Filled']){ 
					$flag=1;
					$totFill=$seats_details['SC_Filled']+1;
					mysql_query("UPDATE `course_seat_structure` SET SC_Filled='$totFill' WHERE `Course_Id`='$app_details[course_id]' and `Course_Level_Id`='$app_details[course_level_id]' and `Session_id`='$app_details[session_id]'");
				}
			}else if($app_details['Category']=='ST'){
				if($seats_details['ST']>$seats_details['ST_Filled']){ 
					$flag=1;
					$totFill=$seats_details['ST_Filled']+1;
					mysql_query("UPDATE `course_seat_structure` SET ST_Filled='$totFill' WHERE `Course_Id`='$app_details[course_id]' and `Course_Level_Id`='$app_details[course_level_id]' and `Session_id`='$app_details[session_id]'");
				}
			}else if($app_details['Category']=='OBC_A'){
				if($seats_details['OBC_A']>$seats_details['OBC_A_Filled']){ 
					$flag=1;
					$totFill=$seats_details['OBC_A_Filled']+1;
					mysql_query("UPDATE `course_seat_structure` SET OBC_A_Filled='$totFill' WHERE `Course_Id`='$app_details[course_id]' and `Course_Level_Id`='$app_details[course_level_id]' and `Session_id`='$app_details[session_id]'");
				}
			}else if($app_details['Category']=='OBC_B'){
				if($seats_details['OBC_B']>$seats_details['OBC_B_Filled']){ 
				$flag=1;
				$totFill=$seats_details['OBC_B_Filled']+1;
					mysql_query("UPDATE `course_seat_structure` SET OBC_B_Filled='$totFill' WHERE `Course_Id`='$app_details[course_id]' and `Course_Level_Id`='$app_details[course_level_id]' and `Session_id`='$app_details[session_id]'");
				}
			}else{
				$gen=$seats_details['Total_Seat']-($seats_details['SC']+$seats_details['ST']+$seats_details['OBC_A']+$seats_details['OBC_B']);
				if($gen>$seats_details['Other_Filled']){ 
				$flag=1;
				$totFill=$seats_details['Other_Filled']+1;
					mysql_query("UPDATE `course_seat_structure` SET Other_Filled='$totFill' WHERE `Course_Id`='$app_details[course_id]' and `Course_Level_Id`='$app_details[course_level_id]' and `Session_id`='$app_details[session_id]'");
				}
			}
				
			if($flag==1){
			mysql_query("INSERT INTO `admission`(`application_code`, `course_id`, `course_level`,`category`, `date`) VALUES ('$app_details[Application_No]','$app_details[course_id]','$app_details[course_level_id]','$app_details[Category]',NOW())");
			mysql_query("UPDATE `application_table` SET `admit`=1 where `id`='".$id."'");
			$appNom=$app_details['Application_No'];
			$qRol= "SELECT DISTINCT(Roll_Index_No) as rol FROM `applicaion_marks` WHERE `Application_No`='".$appNom."' limit 1";	
			$appnoTest=mysql_fetch_array(mysql_query($qRol));
			$rollNom=$appnoTest['rol'];
			$qap="SELECT DISTINCT(Application_No) as appno FROM `applicaion_marks` WHERE `Roll_Index_No`='".$rollNom."'";
			$loopToBlock=mysql_query($qap);
			while($loopBlocking=mysql_fetch_array($loopToBlock)){
					$appNumbr=$loopBlocking['appno'];
					mysql_query("UPDATE `application_table` SET `flag`=1 where `Application_No`='".$appNumbr."' and `admit`=0");
				};		
			}
	}
}
?>