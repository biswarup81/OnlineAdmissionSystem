<?php
include "top.php";
include "../../classes/admin_class.php";

$admin = new admin_class();

$rowObj = $admin->getCollegeDetails();

$action=$_REQUEST['action'];
if($action=='update'){
	if(isset($_POST['email'])&&isset($_POST['otp'])&&isset($_POST['newpassword'])){
		  
   $email = stripslashes($_POST['email']);
	$otp = stripslashes($_POST['otp']);
	$newpassw = $_POST['newpassword'];
	
	$sql1 = "SELECT* FROM user WHERE email = '$email'";
	$query1= mysql_query($sql1);
	if(mysql_num_rows($query1) > 0){
		$row = mysql_fetch_array($query1);
		if($row['last_otp']==$otp){
		$sql_update = "UPDATE user SET password ='".md5($newpassw)."' WHERE email = '$email'";
		if(mysql_query($sql_update)){
					echo "<script>alert('Password Update Successfull\\nLogin Now');
                         window.location.href='../student/index.php';</script>";
		}else{
			//echo "<script>alert('Something Went Wrong\\nPlease Try Again!');</script>";
			$msg = "<b>Something Went Wrong<br>Please Try Again!</b>";
		  }
        }else{
			//echo "<script>alert('Entered a wrong OTP\\nPlease Try Again!');</script>";
			$msg = "<b>Entered a wrong OTP<br>Please Try Again!</b>";
   	    }
	}else{	
	    //echo "<script>alert('Email is not Registered');</script>";
		$msg = "<b>Email is not Registered</b>";
	}
		  
  }
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0039)http://www.whatsred.com/admin/index.php -->
<HTML>
    <HEAD>
        <TITLE>Forget Password</TITLE>

        <META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
        
        <LINK href="style.css" type=text/css 
              rel=stylesheet>
        <META content="MSHTML 6.00.5700.6" name=GENERATOR>
		<script type="text/javascript" src="../../jquery-ui-1.11.3/external/jquery/jquery.js"></script>
    <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
		<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
    <link type="text/css" href="../../jquery-ui-1.11.3/jquery-ui.css" rel="stylesheet"/>
    <script src="../../jquery-ui-1.11.3/jquery-ui.js"></script>
    <script src="../../jquery-validation-1.13.1/dist/jquery.validate.js"></script>
    </HEAD>
    <BODY>
        <table height="100%" cellSpacing=0 cellPadding=4 width="70%" align="center"  border="0">    
            <tr><td>&nbsp;</td></tr>
            <TR>
                <TD width="55%" vAlign=center align=middle style=" border:1px solid #3A5A8B; height:150px;" height="200" bgcolor="#ebedeb">
                    <TABLE cellSpacing=0 cellPadding=0 width="90%" border=0 >
                        <TR>
                            <TD align=left height=55 valign="top" >
                                    <!--<img height=64 src="images/security.gif" align="security" width=64>
            <img height=64 src="../images/logo.gif" align="security">-->
                            </TD>
                        </TR>
                        <TR>
                            <TD height=25>Welcome to <STRONG><?php echo $rowObj->name ?> Student Panel </STRONG>!</TD>
                        </TR>
                        <TR>
                            <TD vAlign=top>Use a valid <STRONG>Phone Num / E-Mail</STRONG> and <STRONG>password</STRONG> to gain access to the administration console.</TD>
                        </TR>
                        <TR>
                            <TD>&nbsp;</TD>
                        </TR>
                        <TR>
                            <TD>&nbsp;</TD>
                        </TR>	
                    </TABLE>
                </TD>
                <td style="background: #666666 ;"></td>
                <TD width="45%" style="background: #D7E1EE; border:1px solid #666666" height="150">
                    <TABLE  cellSpacing=0 cellPadding=0 width="100%" bgColor="#D7E1EE" border=0>
                        <TR>
                            <TD>
                                <TABLE borderColor="#666666" cellSpacing=0 cellPadding=0 width=300 align=center border=0>

                                    <TR bgColor="#666666">
                                        <TD align=middle bgColor="#666666" height=30><FONT color=#ffffff size=2><B>Application Login Panel</B></FONT></TD>
                                    </TR>
                                    <TR>
                                        <TD>
                                            <TABLE  cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                                                <TR vAlign=top>
                                                    <TD>
                                                        <div>
                                                            <TABLE borderColor=#000000 cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                                                              <? if($msg<>''){ ?>
                                                                <TR>
                                                                    <TD valign="top" colspan="4" style="font-family:verdana; font-size:11px; color:#FF0000; padding-left:25px;">
                                                                        <?= $msg ?>	
                                                                    </TD>
                                                                </TR>
                                                                <? } ?>
                                                                <TR>
                                                                    <TD vAlign=center align=middle>&nbsp;</TD>
                                                                    <TD vAlign=center align=right height=25>Email ID</TD>
                                                                    <TD vAlign=center align=left>&nbsp;</TD>
                                                                    <TD vAlign=center align=left><INPUT type="email" id="email" size=25 name="email"></TD>
                                                                </TR>
																<TR>
                                                                    <TD vAlign=center align=middle>&nbsp;</TD>
                                                                    <TD vAlign=center align=right height=25></TD>
                                                                    <TD vAlign=center align=left>&nbsp;</TD>
                                                                    <TD vAlign=center align=left><div id="otpmsg"></TD>
                                                                </TR>
                                                                <TR>
                                                                    
                                                                    <TD align=right colspan="4">
                                                                        <TABLE borderColor=#000000 cellSpacing=0 cellPadding=0 width="100%" border=0>
                                                                            <TR>
                                                                                
                                                                                <TD align=right><Button type="submit" id="resendOTP" onclick="sendOTP()" name="Forgot">Send Request</Button></TD>
                                                                                
                                                                            </TR>
                                                                        </TABLE>
                                                                    </TD>
                                                                </TR>
                                                            </TABLE>
                                                        </div>
                                                    </TD>
                                                </TR>
                                            </TABLE>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                    </TABLE>
                </TD>
            </TR>
            <tr><td>&nbsp;</td></tr>
        </TABLE>
		<script type="text/javascript">
		
	function sendOTP(){
	 //document.getElementById("resendOTP").innerHTML = "OTP Sent successfully";	
	 //$("#principal_desk").addClass("section clearfix about-principal-voice krk-bg-light box-shadow");
	 //$("#principal_desk").load("./ajax/resendOTP?page_id=14");
     var email = document.getElementById("email").value;
	 if (email == null || email == "") {
         //txt = "Please enter your email";
		 $("#email").focus();
		 document.getElementById("otpmsg").innerHTML = "Please enter your email";
       } else {
		 document.getElementById("otpmsg").innerHTML = "Sending OTP...";  
		 $("#otpmsg").load("../ajax/forgot_pass_resendOTP.php?email="+email);  
	     //document.getElementById("demo").innerHTML = "Loading...";
	   }
	 
	 
	};
</script>
    </BODY>
</HTML>
