
<?php			
	$message="Application 223344556677 Submitted. Loginto www.kandrarkkmahavidhyalay.org using MobileNo Password 888888";
	$mobileNo="9830875590";
	$url="http://bulksms.pginfoservices.com/api/sendmsg.php?";
	$message = urlencode($message);			$sms_user_name =  "kandrarkk";	$sms_psswd = "Jun_2107";	$sender_id = "KRKKMV";	
	$ch = curl_init(); 	
	if (!$ch){die("Couldn't initialize a cURL handle");}
	$ret = curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);          
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt ($ch, CURLOPT_POSTFIELDS,"user=".$sms_user_name."&pass=".$sms_psswd."&sender=".$sender_id."&phone=".$mobileNo."&text=".$message."&priority=ndnd&stype=normal"  );
	$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		echo "Return -> ". $ret; 	
	$curlresponse = curl_exec($ch);				echo "curlresponse ->  ". $curlresponse;
?>