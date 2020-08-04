<?php
error_reporting(0);
include "top.php";
include "header.php";
session_start();
if(!isset($_SESSION['user_id'])){
//	$user_id = $_SESSION['user_id'];
	header("Location:logout.php");
}
$user_id= $_SESSION['user_id'];

if(isset($_REQUEST['submit'])){
	$U_roll3=strtoupper(trim($_REQUEST['U_roll3']));
	$U_roll2=strtoupper(trim($_REQUEST['U_roll2']));
	$U_council=strtoupper(trim($_REQUEST['U_council']));
	$select2=strtoupper(trim($_REQUEST['select2']));
	for($j=0;$j<=6;$j++){
	$subjN[$j]=$_REQUEST['s'.($j+1)];
	$m[$j]=$_REQUEST['m'.($j+1)];
	$full[$j]=$_REQUEST['full'.($j+1)];
	if($full[$j]=="" || $full[$j]==0){
		$full[$j]=100;
	}
	$grade[$j]=$_REQUEST['grade'.($j+1)];
	}
	
	
	for($i=0;$i<6;$i++){	
	$sql_ap_marks="INSERT INTO `academic_details`(`User_id`, `Board`, `Other_Board_Name`, `Exam_Name`, `Roll_Index_No`, `Year_of_Passing`, `Subject`, `Marks_Obtained`, `Full_Marks`, `Pass_Fail_Remarks`,`Hs_No`) 
	               VALUES ('$user_id','$U_council','$Uv_others','','$U_roll2','$select2','$subjN[$i]','$m[$i]','$full[$i]','$grade[$i]','$U_roll3')";
	mysql_query($sql_ap_marks) or die(mysql_error());
    }
	echo "<br><br><center><h3>Your Academic Details has been submitted successfully</h3></center>";
}else{
	echo "<br><br><center><h3>Failed To Submit Your Academic Details</h3></center>";
}

?>
<?php include "footer.php"; ?>