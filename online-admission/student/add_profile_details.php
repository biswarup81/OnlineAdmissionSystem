<?Php
error_reporting(0);
include "top.php";
include "header.php";
//include "../../phpmailer/PHPMailerAutoload.php";
//include "../../sendMail.php";
session_start();
$user_id="";
if(isset($_SESSION['user_id'])){
	$user_id = $_SESSION['user_id'];
}else{
	header("Location:logout.php");
}


if(isset($_REQUEST['submit']))
{
//$D1=strtoupper(trim($_REQUEST['D1']));
$desi=strtoupper(trim($_REQUEST['desi']));
$othrOccu=strtoupper(trim($_REQUEST['othrOccu']));
//$appFee=strtoupper(trim($_REQUEST['appFee']));
//$ddNo=strtoupper(trim($_REQUEST['ddNo']));
$R_other=strtoupper(trim($_REQUEST['R_other']));
$U_gname=strtoupper(trim($_REQUEST['U_gname']));
$gmobnum=strtoupper(trim($_REQUEST['gmobnum']));
$g_relation=strtoupper(trim($_REQUEST['g_relation']));
$occu=strtoupper(trim($_REQUEST['occu']));
$income=strtoupper(trim($_REQUEST['income']));
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
$radiopar=strtoupper(trim($_REQUEST['radiopar']));
$radiolocal=strtoupper(trim($_REQUEST['radiolocal']));

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
$pphone=$_REQUEST['pphone'];


$sql_ap_dtls="INSERT INTO `personal_details`
(`user_id`,`Gurdian_Name`, `Gurdian_Mobile_No`, `Gurdian_Relation`,
  `Other_Relation`,`Date_Of_Birth`, `Category`, `Physically_Challenged`,
  `Religion`, `Nationality`, `Address`, `ZIP_PIN`, `Address_1`, `pin2`, `Address_2`,
  `Country`,`state`,`district`, `Mobile`,`create_date`,`occu`,`other_occu`,`desi`,`income`,`other_religion`)
 VALUES   ('$user_id', '$U_gname', '$gmobnum', '$g_relation',
  '$R_other','$theDate', '$radio3','$ph_radio3',
  '$religion','$select7','$p_address','$pin1','$u_address','$pin2','$localA',
  '$select12',$state,$district,'$textfield5',NOW(),'$occu','$othrOccu','$desi','$income','$other_religion')";

//echo $sql_ap_dtls;

mysql_query($sql_ap_dtls) or die(mysql_error());

//$applicastion_table_id = mysql_insert_id();

//$secondary_marksheet_file_name=$user_id.'-secondary-marksheet.'.pathinfo($_FILES["secondary-marksheet"]["name"], PATHINFO_EXTENSION);
//$hs_marksheet_file_name=$user_id.'-hs-marksheet.'.pathinfo($_FILES["hs-marksheet"]["name"], PATHINFO_EXTENSION);

//$insert_file_name_query="INSERT INTO at_uploadfiles(Application_No, DOB_File_Name, Caste_Cert_File_Name, Disablility_File_Name, Secondary_Markheet_File_Name, HS_Markheet_File_Name,PP_Photo_File_Name) VALUES ('$application_no','$dob_proof_file_name','$caste_proof_file_name','$disability_cert_file_name','$secondary_marksheet_file_name','$hs_marksheet_file_name','$pp_photo_file_name')";
//mysql_query($insert_file_name_query) or die(mysql_error());

	
                        //Call Admin
                        $update = new sendMail();
                        $result = $update->MailMe($_SESSION['email'],"Online admission- KRKKM","Your Personal Details has been submitted successfully. Continue all the steps to apply for different courses");
                  
?>
<br><br>
<center><h3>Your Personal Details has been submitted successfully</h3></center>
		
<?php
}else{?>
	<center><h3>Failed to submit your details</h3></center>
	<?php
	//header("Location:index.php");
}
include "footer.php";
?>
