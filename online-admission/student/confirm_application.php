<?php
include "top.php";
include "header.php";
include "../../classes/admin_class.php";
session_start();
if(!isset($_SESSION['user_id'])){
//	$user_id = $_SESSION['user_id'];
	header("Location:logout.php");
}
$userid=$_SESSION['user_id'];
$email= $_SESSION['email'];

if(isset($_REQUEST['submit'])){
 if(isset($_POST["course_lvl"]) && isset($_POST["course_id"])&& isset($_POST["totalmarks"])){	
 
 $course_level_id=$_POST['course_lvl'];
 $course_id=$_POST['course_id'];
 $total_marks=$_POST['totalmarks'];

  //application number generateing--------

  $sql_chk="SELECT * FROM `application_table` order by id desc limit 1";
  $s=mysql_query($sql_chk) or die('error'.mysql_error());
  if(mysql_num_rows($s)>0){
	$chk_table_dtls=mysql_fetch_array($s);
	$chk_date=date("Ymd",strtotime($chk_table_dtls['submit_date']));
	if(date("Ymd")<=$chk_date){
			$sql_app_no="SELECT max(Application_No) FROM `application_table`";
			$ft_app_no=mysql_fetch_array(mysql_query($sql_app_no));
			$application_no=$ft_app_no['max(Application_No)']+1;
	}else{
			$application_no=date("Ymd")."0001";
		}
   }else{
		 $application_no=date("Ymd")."0001";
	}
   //---------
   $sess_id_f=mysql_fetch_array(mysql_query("SELECT * FROM `session_table` WHERE `Admission_open`='1'"));
   $sess_id=$sess_id_f['SessionId'];

  $flag = 1; //Change this accordingly. 
	
  $sql_ap_dtls="INSERT INTO `application_table`(`user_id`, `Application_No`, `Total_Marks`, `course_id`, `course_level_id`, `session_id`, `submit_date`, `flag`)
              VALUES ('$userid','$application_no','$total_marks','$course_id','$course_level_id','$sess_id',NOW(),'$flag')";	

  mysql_query($sql_ap_dtls) or die('connection error'.mysql_error());
    
	echo "<center><h3>Your Application has been submitted successfully</h3>
	      <h4>Application number - $application_no </h4></center>";
                        $update = new admin_class();
                        $result = $update->sendMail(null,1,"", $application_no, "",$email);
 
 }else{
	 echo "<Center><h4>Something Went Wrong</h4></center>";
 }

}else{
	echo "<Center><h4>Something Went Wrong</h4></center>";
}

?>
<?php include "footer.php"; ?>
