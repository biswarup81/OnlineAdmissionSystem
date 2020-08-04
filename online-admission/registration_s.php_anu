<?Php
error_reporting(0);
include '../classes/config.php';
include '../classes/conn.php';
include "../classes/admin_class.php";
session_start();
if(isset($_SESSION['application_no_id'])){
	//header('Location:details_print.php');
}


if(isset($_REQUEST['submit']))
{
$select=strtoupper(trim($_REQUEST['select']));
$D1=strtoupper(trim($_REQUEST['D1']));
$desi=strtoupper(trim($_REQUEST['desi']));
$othrOccu=strtoupper(trim($_REQUEST['othrOccu']));
$appFee=strtoupper(trim($_REQUEST['appFee']));
$ddNo=strtoupper(trim($_REQUEST['ddNo']));
$R_other=strtoupper(trim($_REQUEST['R_other']));
$Your_name=strtoupper(trim($_REQUEST['Your_name']));
$U_name=strtoupper(trim($_REQUEST['U_name']));
$U_lname=strtoupper(trim($_REQUEST['U_lname']));
$U_gname=strtoupper(trim($_REQUEST['U_gname']));
$gmobnum=strtoupper(trim($_REQUEST['gmobnum']));
$g_relation=strtoupper(trim($_REQUEST['g_relation']));
$occu=strtoupper(trim($_REQUEST['occu']));
$income=strtoupper(trim($_REQUEST['income']));
$radio2=$_REQUEST['radio2'];
$theDate=date("Y-m-d",strtotime($_REQUEST['theDate']));
$radio3=strtoupper(trim($_REQUEST['radio3']));
$ph_radio3=strtoupper(trim($_REQUEST['ph_radio3']));
$religion=strtoupper(trim($_REQUEST['religion']));
$other_religion=strtoupper(trim($_REQUEST['other_religion']));
$select7=strtoupper(trim($_REQUEST['select7']));    
$p_address=strtoupper(trim($_REQUEST['p_address']));
$pin1=strtoupper(trim($_REQUEST['pin1']));
$select4=strtoupper(trim($_REQUEST['select4']));
    $district=strtoupper(trim($_REQUEST['D2']));
$select10=strtoupper(trim($_REQUEST['select10']));
    $state=strtoupper(trim($_REQUEST['select10']));
$D2=strtoupper(trim($_REQUEST['D2']));
$U_phone22=strtoupper(trim($_REQUEST['U_phone22']));
$U_gname222=strtoupper(trim($_REQUEST['U_gname222']));
$Land_Phone_No=$U_phone22.'-'.$U_gname222 ;
$email=strtoupper(trim($_REQUEST['email']));
$radiopar=strtoupper(trim($_REQUEST['radiopar']));
$radiolocal=strtoupper(trim($_REQUEST['radiolocal']));
$U_council=strtoupper(trim($_REQUEST['U_council']));
$U_roll2=strtoupper(trim($_REQUEST['U_roll2']));
$U_roll3=strtoupper(trim($_REQUEST['U_roll3']));
$select2=strtoupper(trim($_REQUEST['select2']));
$Payment_date=date("Y-m-d",strtotime($_REQUEST['Payment_date']));
$branch = trim($_REQUEST['branch_name']);
$Password = rand(100000, 999999);
for($j=0;$j<=6;$j++){
	$subjN[$j]=$_REQUEST['s'.($j+1)];
	$m[$j]=$_REQUEST['m'.($j+1)];
	$full[$j]=$_REQUEST['full'.($j+1)];
	if($full[$j]=="" || $full[$j]==0){
		$full[$j]=100;
	}
	$grade[$j]=$_REQUEST['grade'.($j+1)];
}

if($_REQUEST['radiopar']=='yes'){
$u_address="";
$pin2="";
}else{
$u_address=$_REQUEST['u_address'];
$pin2=$_REQUEST['pin2'];
}
$localA=$_REQUEST['localA'];
$textfield5=$_REQUEST['textfield5'];
$select12=$_REQUEST['select12'];
$textfield3=$_REQUEST['textfield3'];
$pphone=$_REQUEST['pphone'];
$m12=$_REQUEST['m12'];
//application number generateing--------

$sql_chk="SELECT * FROM `application_table` order by id desc limit 1";
$s=mysql_query($sql_chk);
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

$flag = 9; //Change this accordingly. 

$sql_ap_dtls="INSERT INTO `application_table`
(`Application_No`, `password`, `Application_Fee`, `Demand_Draft_No`, `First_Name`,
 `Middle_Name`, `Last_Name`, `Gurdian_Name`, `Gurdian_Mobile_No`, `Gurdian_Relation`,
  `Other_Relation`, `Gender`, `Date_Of_Birth`, `Category`, `Physically_Challenged`,
  `Religion`, `Nationality`, `Address`, `ZIP_PIN`, `Address_1`, `pin2`, `Address_2`,
  `Country`,`state`,`district`, `Mobile`, `Land_Phone_No`, `email`, `Total_Marks`,
  `Bank_Payment_Verified`,`course_id`,`course_level_id`,`session_id`,`submit_date`,`occu`,`other_occu`,`desi`,`income`,`other_religion`, flag)
 VALUES   ('$application_no', '$Password', '$appFee', '$ddNo', '$Your_name',
  '$U_name', '$U_lname', '$U_gname', '$gmobnum', '$g_relation',
  '$R_other', '$radio2', '$theDate', '$radio3','$ph_radio3',
  '$religion','$select7','$p_address','$pin1','$u_address','$pin2','$localA',
  '$select12',$state,$district,'$textfield5','$Land_Phone_No','$email','$m12','','$D1','$select','$sess_id',NOW(),'$occu','$othrOccu','$desi','$income','$other_religion',9)";

//echo $sql_ap_dtls;

mysql_query($sql_ap_dtls) or die(mysql_error());

$applicastion_table_id = mysql_insert_id();

for($i=0;$i<6;$i++){	
	$sql_ap_marks="INSERT INTO `applicaion_marks`(`Application_No`, `Board`, `Other_Board_Name`, `Exam_Name`, `Roll_Index_No`, `Year_of_Passing`, `Subject`, `Marks_Obtained`, `Full_Marks`, `Pass_Fail_Remarks`) VALUES ('$application_no','$U_council','$Uv_others','','$U_roll2','$select2','$subjN[$i]','$m[$i]','$full[$i]','$grade[$i]')";
	
	//echo $sql_ap_marks;
	mysql_query($sql_ap_marks);
}
//$sql_ap_rank="INSERT INTO `rank_table`(`Session_Id`, `Application_No`, `SC_Rank`, `ST_Rank`, `OBC_A_Rank`, `OBC_B_Rank`, `General_Rank`, `Round`) VALUES ('','$application_no','','','','','','')";
$Unique_No=$application_no."".$D1."".$select;
mysql_query("INSERT INTO `admission_payments`(`Application_No`, `course_id`, `course_level_id`, `Unique_No`, `Payment_date`, `create_date`, `BRANCH`) VALUES ('$application_no','$D1','$select','$Unique_No','$Payment_date',NOW(), '$branch' )");
//mysql_query($sql_ap_marks);



			//$fromName = $_GET['name'];
			//$fromEmail = "bibhasece@gmail.com";
			//$fromPhone = $_GET['phone'];
			if($select==2){
				$mprnt="PASS";
			}else if($select==3){
				$tC=mysql_fetch_array(mysql_query("SELECT * FROM `course_table` WHERE `CourseId`='".$D1."'"));
				$mprnt=$tC['Course_Name'];
			}
	
                        //Call Admin
                        $update = new admin_class();
                        $result = $update->sendMail(null,1,$mprnt, $application_no, $Password,$email);
                        
                       
                        
                       // $update->sendSMSByApplicationId(1,$applicastion_table_id);
                        //$update->sendSMS(1,$gmobnum,$application_no, $Password);
                        
                        //$_REQUEST['message'] = "Applicaiton has been successfully submited with Application number ".$application_no." Kindly see your Email / Mobile for password to login. ";
			
                        
            /* header('Location:./student/login.php');
			echo "<script>alert('$result')</script>"; */

			//echo "Application No:".$application_no;

?>
<html>
<head>
<title>Application Number :: <?php echo $application_no;?></title>
</head>
<body>
<h3>Your Application has been submitted successfully</h3>
<h4>Application number - <?php echo $application_no;?></h4>
<h5>Login to <a href="./student/login.php">Student Panel</a> with your password which is sent to your mobile : <?php echo $gmobnum; ?> and your EMail : <?php echo $email; ?></h5>
</body>
</html>
		
<?php }else{
	header("Location:index.php");
}

?>