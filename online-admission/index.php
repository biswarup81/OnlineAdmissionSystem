<?php
//include "../classes/config.php";
//include "../classes/conn.php";
//include "../classes/admin_class.php";
include "./inc/datacon.php";
include "../phpmailer/PHPMailerAutoload.php";
include "../sendMail.php";
include '../classes/sendOTP.php';
$otp = new sendOTP(); 
session_start();

$tab_selection = "signup";
$msg = $emailErr = $passErr = $signemailErr = $signotpErr = $otpmsg="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_REQUEST['submit'])){
     if(isset($_POST['fname'])&& isset($_POST['lname']) && isset($_POST['user_email']) && isset($_POST['user_phone']) && isset($_POST['gender']) &&isset($_POST['user_pass'])){	
	 $fname=strtoupper(test_input($_POST['fname']));
	 $mname=strtoupper(test_input($_POST['mname']));
     $lname=strtoupper(test_input($_POST['lname']));
     $email=strtoupper(test_input($_POST['user_email']));
	 $password=test_input($_POST['user_pass']);
	 $mob_no=test_input($_POST['user_phone']);
     $gender=test_input($_POST['gender']);

	 $isValidEmail=filter_var($email, FILTER_VALIDATE_EMAIL);
	 if(strlen($password)>40||strlen($password)<6){
               $passErr = "Password must be less than 40 and more than 6 characters"; 
     }else if($isValidEmail === false){
	    $emailErr =  "The Email is not valid";
     }else{
		 //insert into db
		   $sqlCheckEmail = "SELECT * FROM user WHERE `email` LIKE '$email'";
        $emailQuery=mysqli_query($conn,$sqlCheckEmail) or die('connection Error'.mysqli_error());
       if(mysqli_num_rows($emailQuery)>0){
	   $msg =  "Email Already Registered,Type Another One";
       }
       else{

	       $sql_chk="SELECT `user_id` FROM `user` order by `row_id` desc limit 1";
   	       $s=mysqli_query($conn,$sql_chk);
          if(mysqli_num_rows($s)>0){
		   $ft_user_no=mysqli_fetch_array($s);
		   $user_id=$ft_user_no['user_id']+1;
	       } 
	      else{
		    $user_id=10001; 
	     }
	   
	  $sql_register="INSERT INTO `user` (`user_id`,`fname`,`mname`,`lname`,`email`,`password`,`mobile`,`gender`,`create_date`)

	                   VALUES('$user_id','$fname','$mname','$lname','$email','".md5($password)."','$mob_no','$gender',NOW())";

		if(mysqli_query($conn,$sql_register)){
			$tab_selection = "otpverify";
			$msg =  "<center><b>Successfully Registered<b><br>OTP send to your email/sms for verification</center>";
			$result  = $otp->sendSMSMail($email, "1", $mob_no);
		}
		else{
			$msg = "Failed to Register";
			echo 'error'.mysqli_error($conn);
		}
      }	 
   		 
	 }

    }else
	    $msg =  "Something Went Wrong"; 
  }
 //otp verification---------------------------------- 
  if(isset($_REQUEST['verify'])){
	  $tab_selection = "otpverify";
	  if($_REQUEST['action'] == "verifyotp"){
	  if(isset($_POST['user_email']) && isset($_POST['user_otp'])){
		$email=strtoupper(test_input($_POST['user_email']));
        $otp=test_input($_POST['user_otp']);
			//echo "email ".$email;
  $sqlCheckEmail = "SELECT * FROM user WHERE `email` LIKE '$email' ";
  $emailQuery=mysqli_query($conn,$sqlCheckEmail) or die('connection Error'.mysqli_error());
  if(mysqli_num_rows($emailQuery)>0){
	  //$sql_match="UPDATE `user` SET `is_verified`= 'Y'  WHERE `email` = '$email' AND `last_otp` = '$otp' AND `is_verified` = 'N' ";
	 $sqlfetchOTP ="SELECT `last_otp` FROM `user` WHERE `email` LIKE '$email' AND `is_verified` = 'N'";  
	  $result = mysqli_query($conn,$sqlfetchOTP);
	  if($result){
		  $row = mysqli_fetch_array($result);
          $fetchOTP=$row['last_otp'];
		  //echo "OTP".$fetchOTP;
			if($otp == $fetchOTP){
				$sql_match="UPDATE `user` SET `is_verified`= 'Y'  WHERE `email` = '$email' AND `last_otp` = '$otp' AND `is_verified` = 'N' ";
				 if(mysqli_query($conn,$sql_match)){
					 $otpmsg = "<center>Verified Successfully</center>";
					 //echo "<script>alert('Your account is ready!')</script>";
					 echo "<script>alert('Verified Successfully\\nYour account is ready!\\nLogin Now');
                         window.location.href='student/index.php';</script>";
					 //header( "refresh:5;url=student/index.php" );
					 //header("location:student/index.php");
				 }else{
					 $otpmsg = "Something Went Wrong".mysqli_error();
				 }

			}else{
				$otpmsg =  "Entered A Wrong OTP";
			}
	    }else{
			$otpmsg  = 'Something Went Wrong'.mysqli_error();
		}
       }
     else{
	  $otpmsg =  "Email is not registered";
     }
					
			//sxn
	   }else{
		   $otpmsg = "Please fill email and otp for verification";
	   }
	  }else{
		  $otpmsg = "Something Went Wrong";
	  }
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<html>
  <head>
   <link type="text/css" rel="stylesheet" href="calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
    <script type="text/javascript" src="calendar/dhtmlgoodies_calendar.js?random=20060118">
    </script>
    <script type="text/javascript" src="../jquery-ui-1.11.3/external/jquery/jquery.js">
    </script>
    <link rel="stylesheet" href="../jquery-ui-1.11.3/jquery-ui.css">
    <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
    <link type="text/css" href="jquery-ui-1.11.3/jquery-ui.css" rel="stylesheet"/>
    <script src="../jquery-ui-1.11.3/jquery-ui.js">
    </script>
    <script src="../jquery-validation-1.13.1/dist/jquery.validate.js">
    </script>
    <script src="../jquery-ui-1.10.4/ui/jquery.ui.core.js">
    </script>
    <script src="../jquery-ui-1.10.4/ui/jquery.ui.widget.js">
    </script>
    <script src="../jquery-ui-1.10.4/ui/jquery.ui.tabs.js">
    </script>
	<link type="text/css" rel="stylesheet" href="../css/sign_up_style.css" media="screen">
	<script src="../js/signup_js.js"></script>
    <title>Online Application : Apply Online</title>
	</head>
<body>	
 <center><h3 class="text-gradient" align = "center">Welcome to Kandra Radhakanta Kundu Mahavidyalaya Online Admission Portal</h3></center>
<div class="form-wrap">
		<div class="tabs">
			<h3 class="signup-tab"><a <?php if($tab_selection =='signup')  echo "class='active'"; ?> href="#signup-tab-content">Sign Up</a></h3>
			<h3 class="login-tab"><a <?php if($tab_selection =='otpverify')  echo "class='active'" ;?> href="#login-tab-content">User Verification</a></h3>
		</div><!--.tabs-->

		<div class="tabs-content">
			<div id="signup-tab-content" <?php if($tab_selection =='signup')  echo "class='active'"; ?>>
				<form class="signup-form"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
				    <span class="error"><?php echo $msg;?></span>
				    <input type="text" class="input" name="fname" id="fname" autocomplete="off" placeholder="First Name" style="text-transform: uppercase;" required>
					<input type="text" class="input" name="mname" id="mname" autocomplete="off" placeholder="Middle Name (Optional)" style="text-transform: uppercase;" >
					<input type="text" class="input" name="lname" id="lname" autocomplete="off" placeholder="Last Name" style="text-transform: uppercase;" required >
					<input type="email" class="input" name="user_email" id="user_email" autocomplete="off" placeholder="Email" style="text-transform: uppercase;" required>
					<span class="error"><?php echo $emailErr;?></span>
					<input type="phone" class="input" name="user_phone" id="user_phone" autocomplete="off" placeholder="Mobile No" required pattern="[0-9]{10}" >
					<tr>
                    <td class="sTD">
                    Gender:&nbsp;&nbsp;&nbsp;
                    </td>
                    <td class="sTD">
                     <input name="gender" type="radio" id="gender" value="Male" required="required">&nbsp;&nbsp;Male&nbsp;&nbsp;&nbsp;
                     <input name="gender" type="radio" id="gender" value="Female">&nbsp;&nbsp;Female&nbsp;&nbsp;&nbsp;&nbsp;
                     <input name="gender" type="radio" id="gender" value="Other">&nbsp;&nbsp;Other&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                   </tr>
					<input type="password" class="input" name="user_pass" id="user_pass" autocomplete="off" placeholder="Password" required>
					<span class="error"><?php echo $passErr;?></span>
					<input type="submit" class="button" value="Register" id="submit" name= "submit">
				</form><!--.login-form-->
			</div><!--.signup-tab-content-->

			<div id="login-tab-content" <?php if($tab_selection =='otpverify')  echo "class='active'"; ?> >
				<form class="login-form" action="index.php?action=verifyotp" method="post">
                    <span class="error"><?php echo $otpmsg." ";?></span>
                    <span class="successcolor"><?php echo $msg;?></span>					
					<input type="email" class="input" name ="user_email" id="user_email_otp" autocomplete="off" placeholder="Email" style="text-transform: uppercase;"  required >
					<span class="error"><?php echo $signemailErr;?></span>
					<input type="text" class="input" name= "user_otp" id="user_otp" autocomplete="off" placeholder="OTP" required>
					<span class="error"><?php echo $signotpErr;?></span>
				
					<input type="submit" class="button" name = "verify" value="Verify">
					
				</form><!--.login-form-->
				<div class="help-text">
					<p id="resendOTP"><a>Resend OTP?</a></p>
				</div><!--.help-text-->
				<section id = "resendajax" class="help-text error">
					<p id="demo"></p>
				</section>
			</div><!--.login-tab-content-->
		</div><!--.tabs-content-->
	</div><!--.form-wrap-->
	
<script type="text/javascript">
$(document).ready(function(){
	$("#resendOTP").click(function(){
	 //document.getElementById("resendOTP").innerHTML = "OTP Sent successfully";	
	 //$("#principal_desk").addClass("section clearfix about-principal-voice krk-bg-light box-shadow");
	 //$("#principal_desk").load("./ajax/resendOTP?page_id=14");
     var email = document.getElementById("user_email_otp").value;
	 if (email == null || email == "") {
         //txt = "Please enter your email";
		 $("#user_email_otp").focus();
		 document.getElementById("demo").innerHTML = "Please enter your email";
       } else {
		 document.getElementById("demo").innerHTML = "Sending...";  
		 $("#resendajax").load("./ajax/resendOTP.php?email="+email);  
	     //document.getElementById("demo").innerHTML = "Loading...";
	   }
	 
	 
	});
	
});
</script>	
</body>	
</html>	
