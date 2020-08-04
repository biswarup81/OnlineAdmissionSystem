<?php
include '../../classes/config.php';
include '../../classes/conn.php';
$result=array();
	
$user_id = $_GET['user_id'];
$course_lvl_id = $_GET['course_level'];
$course_id=$_GET['courseId'];
$has_a_same_appli  = mysql_query("SELECT*FROM `application_table` WHERE  `User_id` = '$user_id' and course_id = '$course_id' and  	course_level_id ='$course_lvl_id' ") or die('error'.mysql_error());
if(mysql_num_rows($has_a_same_appli) > 0){
	echo "<h3>*Already You have applied for this course*<br>T R Y    O T H E R    C O U R S E S</h3>";
}else{
$has_marks_details_query = mysql_query("SELECT*FROM `academic_details` WHERE  `User_id` = '$user_id' ") or die('error'.mysql_error());
if(mysql_num_rows($has_marks_details_query) > 0){

if(($course_lvl_id == 4)||($course_lvl_id == 13)){
	/* Only For Honours*/
    $subId=mysql_fetch_array(mysql_query("SELECT a.Subject_Id,b.Subject_Name FROM course_subject_link a,subject_master b WHERE a.Course_Id='$course_id' AND a.Course_Level_Id = '$course_lvl_id' AND a.Subject_Id= b.Subject_Id "));
    $val=$subId['Subject_Id'];
	$man_sub_name = $subId['Subject_Name'];
	$man_sub_marks_query = mysql_query("SELECT * FROM `academic_details` WHERE `Subject`='".$val."' AND `User_id` = '$user_id' ");
	if(mysql_num_rows($man_sub_marks_query) > 0){
	$madatory_sub_mark=mysql_fetch_array($man_sub_marks_query);
	$madatory_sub_mark = $madatory_sub_mark['Marks_Obtained'];
	
	$rest_sub_marks_query = mysql_query("SELECT Marks_Obtained FROM `academic_details` WHERE  `User_id` = '$user_id' ");
	
	
	while($marks_details_form = mysql_fetch_array($rest_sub_marks_query)){
		$marksDetails[]=$marks_details_form['Marks_Obtained'];		
	}
	//$result['success']="101";
	rsort($marksDetails);
	$sum = $marksDetails[0]+$marksDetails[1]+$marksDetails[2]+$marksDetails[3]+$marksDetails[4]+$madatory_sub_mark;
	echo "<h4>Total Marks in Top Five Subjects + Honors Subject: (Total 600): <mark>".$sum."</mark></h4><br>";
	//echo "<a href='#?total=$sum&user_id=$user_id&course_lvl=$course_lvl_id&course_id=$course_id'>Make Application</a><br/>";
	echo "<form method='post' action='confirm_application.php' enctype='multipart/form-data'>
	      
		  <input type='hidden' name='course_lvl' id='course_lvl' value=$course_lvl_id>
		  <input type='hidden' name='course_id' id='course_id' value=$course_id>
		  <input type='hidden' name='totalmarks' id='totalmarks' value=$sum>
		  <input type='submit' value='Confirm Application' name='submit' id='submit'>
	      </form><br><br>";
	}else{
	/*not applicable for this application*/	
	 
	 echo "<h3>*Not Applicable for this subject*<br>For this course <mark>$man_sub_name</mark> is mandatory</h3>";
	}
	
	
}else{
	/*Others Application exclude Honours*/
	$sub_marks_query = mysql_query("SELECT Marks_Obtained FROM `academic_details` WHERE  `User_id` = '$user_id' ");
	while($marks_details_form = mysql_fetch_array($sub_marks_query)){
		//$index['Marks_Obtained']
		$marksDetails[] = $marks_details_form['Marks_Obtained'];
		//array_push($marksDetails,$index);		
	}
	//$result['success']="103";
	rsort($marksDetails);
	$sum = $marksDetails[0]+$marksDetails[1]+$marksDetails[2]+$marksDetails[3]+$marksDetails[4];
	echo "<h4>Total Marks in Top Five in Top (Total 500): <mark>".$sum."</mark></h4><br>";
	//echo "<a href='#?total=$sum&user_id=$user_id&course_lvl=$course_lvl_id&course_id=$course_id'>Make Application</a><br/>";
	echo "<form method='post' action='confirm_application.php' enctype='multipart/form-data'>
	      
		  <input type='hidden' name='course_lvl' id='course_lvl' value=$course_lvl_id>
		  <input type='hidden' name='course_id' id='course_id' value=$course_id>
		  <input type='hidden' name='totalmarks' id='totalmarks' value=$sum>
		  <input type='submit' value='Confirm Application' name='submit' id='submit'>
	      </form><br><br>";
 }	

 }else{
	 /*no academic details found*/
	echo "<h3>*Please Fill Up Your Academic details First*</h3>";
 }
}
?>