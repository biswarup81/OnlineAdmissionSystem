<?php
include '../../classes/config.php';
include '../../classes/conn.php';

if(isset($_GET['courseId'])) { 
   drop_1($_GET['courseId']); 
}

function drop_1($drop_var)
{  
    
	$subId=mysql_fetch_array(mysql_query("SELECT * FROM `course_subject_link` WHERE `Course_Id`='$drop_var'"));
	$val=$subId['Subject_Id'];
	$result = mysql_query("SELECT * FROM `subject_master` WHERE `Subject_Id`='".$val."'") or die(mysql_error());
	$row=mysql_num_rows($result);
	$x= '<option value="" disabled="disabled" selected="selected">Select Subject</option>';
			
		   while($drop_2 = mysql_fetch_array( $result )) 
			{
			  $x.= '<option value="'.$drop_2['Subject_Id'].'">'.$drop_2['Subject_Name'].'</option>';
			}
	
	echo "Success#".$row."#".$x;
   
}

?>