<?php
include '../../classes/config.php';
include '../../classes/conn.php';

if(isset($_GET['courseLevelId'])) { 
   drop_1($_GET['courseLevelId']); 
}

function drop_1($drop_var)
{  
	$result = mysql_query("SELECT b.CourseId, b.Course_Name FROM course_seat_structure a, course_table b 
					WHERE a.Course_Level_Id='$drop_var' and b.CourseId = a.Course_Id") or die(mysql_error());
	
        
        
	$x= '<select name="D1" id="D1" onchange="return subMand()" required>
	      <option value="" disabled="disabled" selected="selected">Choose one</option>';
			$row=mysql_num_rows($result);
		   while($drop_2 = mysql_fetch_array( $result )) 
			{
			  $x.= '<option value="'.$drop_2['CourseId'].'">'.$drop_2['Course_Name'].'</option>';
			}
	
	$x.= '</select>';

$result_AllSub = mysql_query("SELECT * FROM `subject_master` WHERE 1") 
	or die(mysql_error());
	//$x='<select name="D1" id="D1" >';
	$y='<option value="" selected="selected">Select Subject</option>';
			
		   while($drop_2 = mysql_fetch_array( $result_AllSub )) 
			{
			  $y.= '<option value="'.$drop_2['Subject_Id'].'">'.$drop_2['Subject_Name'].'</option>';
			}
			
	echo "Success#".$row."#".$x."#".$y;
   
}

?>