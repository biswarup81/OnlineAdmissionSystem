
<?php	
	include "classes/config.php";
	include "classes/conn.php";
	include "classes/admin_class.php";
	
	$admin = new admin_class();
	
	$url = trim($admin->getConstant("SMS_API_URL"));
	$sms_user_name =  trim($admin->getConstant("SMS_USER"));
	$sms_psswd = trim($admin->getConstant("SMS_PASS"));
	$sender_id = trim($admin->getConstant("SMS_SENDER_ID"));
	echo $url;	echo $sms_user_name;	echo $sms_psswd;	echo $sender_id;
	
	$message="Application 223344556677 Submitted. Loginto www.kandrarkkmahavidhyalay.org using MobileNo Password 888888";		echo $message;
	$mobileNo="9830875590";		echo $mobileNo;
	//$url="http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?";
	$message = urlencode($message);
	$ch = curl_init(); 
	if (!$ch){die("Couldn't initialize a cURL handle");}
	$ret = curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);          
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	//curl_setopt ($ch, CURLOPT_POSTFIELDS,"username=kandra&password=1493715534&sendername=KRKKMV&mobileno=".$mobileNo."&message=".$message );
	curl_setopt ($ch, CURLOPT_POSTFIELDS,"user=".$sms_user_name."&pass=".$sms_psswd."&sender=".$sender_id."&phone=".$mobileNo."&text=".$message."&priority=ndnd&stype=normal" );
	
	$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$curlresponse = curl_exec($ch);				echo $curlresponse;
?>