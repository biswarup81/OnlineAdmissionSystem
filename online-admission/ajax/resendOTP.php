<?phpinclude_once '../inc/datacon.php';require '../../phpmailer/PHPMailerAutoload.php';require '../../sendMail.php';include_once '../../classes/sendOTP.php';//$_POST['email'] = "krishdu.p@gmail.com" ;
if(isset($_GET['email'])){$admin = new sendOTP(); 
$email = $_GET['email'];
$sql_mobile_no_fetch = "SELECT mobile FROM user WHERE email = '$email' ";	
 $mobilenoQuery = mysqli_query($conn,$sql_mobile_no_fetch);
 if(mysqli_num_rows($mobilenoQuery) > 0){
 $row =mysqli_fetch_array($mobilenoQuery);
 $mob_no = $row['mobile']; 
 $result  = $admin->sendSMSMail($email, "1", $mob_no);
  if($result ==1){
    ?><div class="help-text">	<p id="demo"><a><?php echo "Send Successfully"; ?></a></p></div>	<?php
    }else{?><div class="help-text">	<p id="demo"><a><?php echo "Unable to send OTP"; ?></a></p></div>	 <?php
   }
 }else{?> <div class="help-text">	<p id="demo"><a><?php echo "Email is Not Registered"; ?></a></p></div>	 <?php
 } 
}else{?><div class="help-text">	<p id="demo"><a><?php echo "Something Went Wrong"; ?></a></p></div>	<?php
}
?>