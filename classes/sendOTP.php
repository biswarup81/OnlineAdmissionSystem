<?php 
//$admin = new sendOTP();
//$admin->sendSMSMail("krishdu.p@gmail.com","3456","1","8250451027");
class sendOTP{	
  function sendSMSMail($email, $flag, $mobileno){      $send  = new sendMail();
	  $admin = new sendOTP();	  
	  $otp = rand(100000, 999999);
	  $conn = $admin->getConnection();
	  $collObj = $admin->getCollegeDetails();
	  $studentLogin = $admin->getConstant("STUDENT_LOGIN");
	  $from_mail = $admin->getConstant("FROM_MAIL");
	 if($flag == 1){ 
	  $toMail = $email;
	  $subject =  "Online admission - ".$collObj->name ;
	  $body = "Your OTP from Online Admission System is: ".$otp.".For any other clarification, ".$admin ->getConstant('COLLEGE_CONTACT')." ";
	  //$header = $admin->prepareHeader();
	  if($send->MailMe($toMail,$subject,$body)){
		       $admin->storeOTP($email, $otp);				$admin->sendSMS($body, $mobileno);	
                    //$result = "Your Regestration OTP send successfully.";						$result=1;
					//echo $result;
            }else{
                    //$result = "Your message could not be submited.";					$result = 0;
					//echo $result;
            }
	 
	 }
	return $result; 
 }
 
 function getCollegeDetails(){
	 $admin = new sendOTP();
	  $conn = $admin->getConnection();
       $query = "select * from cname";
       //echo $query;
       $result = mysqli_query($conn, $query) or die(mysqli_error($conn));     
       $rowObj = mysqli_fetch_object($result);
       return $rowObj;
   }
   function getConstant($key){
	   $admin = new sendOTP();
	   $conn = $admin->getConnection();
       $query = "SELECT * FROM admission_constant where name = '".$key."'";
       //echo $query;
       $result = mysqli_query($conn, $query)or die(mysqli_error($conn));
       $rowObject = mysqli_fetch_object($result) ;
       
       /*while($rows = mysql_fetch_array($result)){
           $subjectCombination = $rows['Course_Level_Name'] . '('. $rows['Course_Name'] . ')';
       } */
       return $rowObject->DESCRIPTION;
   }
   function prepareHeader(){
	   $admin = new sendOTP();
	   $conn = $admin->getConnection();
       $from_mail = $admin->getConstant("STUDENT_LOGIN_APP");
       $header = 'From: noreply@online-admission.co.in' . "\r\n" ;
       $header.= 'MIME-Version: 1.0' . "\r\n";
       $header.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
       
       return $header;
   }
  function sendSMS($message, $mobile_num){
       $admin = new sendOTP();
	   $conn = $admin->getConnection();
       //Audit Trail SMS
       //$admin->auditTrailSMS($message, $mobile_num);
       //$url="http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?";
       $url = trim($admin->getConstant("SMS_API_URL"));
       $sms_user_name =  trim($admin->getConstant("SMS_USER"));
       $sms_psswd = trim($admin->getConstant("SMS_PASS"));
       $sender_id = trim($admin->getConstant("SMS_SENDER_ID"));
       $mobile_num = trim($mobile_num);
       //echo ($url);
       //echo ($sms_user_name);
       //echo ($sender_id);
       //echo ($mobile_num);
       $message = urlencode($message);
        $ch = curl_init(); 
        if (!$ch){die("Couldn't initialize a cURL handle");}
        $ret = curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);          
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        //curl_setopt ($ch, CURLOPT_POSTFIELDS,"username=kandra&password=1493715534&sendername=KRKKMV&mobileno=".$mobileNo."&message=".$message );
        //curl_setopt ($ch, CURLOPT_POSTFIELDS,"username=".$sms_user_name."&password=".$sms_psswd."&sendername=".$sender_id."&mobileno=91".$mobile_num."&message=".$message );
        curl_setopt ($ch, CURLOPT_POSTFIELDS,"user=".$sms_user_name."&pass=".$sms_psswd."&sender=".$sender_id."&phone=".$mobile_num."&text=".$message."&priority=ndnd&stype=normal" );

        $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $curlresponse = curl_exec($ch);	
       
       //echo $curlresponse;
   }   
   function storeOTP($email, $otp){
	   $admin = new sendOTP();
	   $conn = $admin->getConnection();
	   	$insert_query = "UPDATE `user` SET `last_otp` = '$otp' WHERE `email` = '$email' ";
	   	mysqli_query($conn, $insert_query) or die(mysqli_error($conn));
	   	//echo "Database Updated";
   }
   
   function getConnection(){
    $db_host = 'localhost';	$db_login= 'root';	$db_pswd ='ot288fO8JypG';	$db_name = 'online_admission_system_app';
      $conn = mysqli_connect($db_host,$db_login,$db_pswd);
      if (!$conn)
      {
      die('Could not connect: ' . mysqli_error($conn));
      }
      mysqli_select_db($conn,$db_name);
      return $conn;
   }
   
}
?>
