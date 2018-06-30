<?php
include "top.php";
include "../../classes/admin_class.php";

$admin = new admin_class();

$rowObj = $admin->getCollegeDetails();


$action=$_REQUEST['action'];

$match = false;
$user_name = ""; 
if($action=='login') {
    $uname=stripslashes($_POST['user']);
    $pass=stripslashes($_POST['pass']);
    $query = "SELECT * FROM application_table WHERE email = '$uname' or Gurdian_Mobile_No = '$uname' ";
    $result = mysql_query($query) or die(mysql_error());
    if(mysql_num_rows($result) > 0){
        while($row = mysql_fetch_array($result)){
            $password = $row['password'];

            if($password == $pass){
                $match = true;
                
                $user_name = $row['First_Name']." ".$row['Last_Name'];
            } 
        }
    }
    if($match == true){
        $_SESSION['user_id'] = $uname;
        $_SESSION['user_name']=$user_name;
        $_SESSION['user_type']= "STUDENT";
        header("location:index.php");
        exit();
    } else {
        $msg="<b>Invalid username/password given</b>";
        
    }
    
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0039)http://www.whatsred.com/admin/index.php -->
<HTML>
    <HEAD>
        <TITLE>Welcome to <?php echo $rowObj->name ?> Student Panel </TITLE>

        <META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
        <SCRIPT language=JavaScript>
            function checkthis()
            {

                if (document.f1.user.value == "")
                {
                    alert("Enter the mobile number / E-Mail");
                    document.f1.user.focus();
                    return false;
                }
                if (document.f1.pass.value == "")
                {
                    alert("Enter the password");
                    document.f1.pass.focus();
                    return false;
                }

            }
        </SCRIPT>
        <LINK href="style.css" type=text/css 
              rel=stylesheet>
        <META content="MSHTML 6.00.5700.6" name=GENERATOR>
    </HEAD>
    <BODY onLoad="javascript:document.f1.user.focus();">
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
                                                        <FORM name="f1" onSubmit="return checkthis()" action="login.php?action=login" method="post">
                                                            <TABLE borderColor=#000000 cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                                                                <? if($msg<>''){ ?>
                                                                <TR>
                                                                    <TD valign="top" colspan="4" style="font-family:verdana; font-size:11px; color:#FF0000; padding-left:25px;">
                                                                        <?= $msg ?>	
                                                                    </TD>
                                                                </TR>
                                                                <? } ?>
                                                                <TR>
                                                                    <TD vAlign=top>&nbsp;</TD>
                                                                    <TD vAlign=top width="30%" height=25>&nbsp;</TD>
                                                                    <TD vAlign=top width="2%">&nbsp;</TD>
                                                                    <TD vAlign=top width="61%">&nbsp;</TD>
                                                                </TR>
                                                                <TR>
                                                                    <TD vAlign=center align=middle>&nbsp;</TD>
                                                                    <TD vAlign=center align=right height=25>E-Mail/Phone Number:</TD>
                                                                    <TD vAlign=center align=left>&nbsp;</TD>
                                                                    <TD vAlign=center align=left><INPUT size=25 name="user" autocomplete="off"></TD>
                                                                </TR>
                                                                
                                                                <TR>
                                                                    <TD vAlign=center align=middle>&nbsp;</TD>
                                                                    <TD vAlign=center align=right height=25>Password:</TD>
                                                                    <TD vAlign=center align=left>&nbsp;</TD>
                                                                    <TD vAlign=center align=left><INPUT type=password size=25 name="pass"></TD>
                                                                </TR>
                                                                <TR>
                                                                    
                                                                    <TD align=right colspan="4">
                                                                        <TABLE borderColor=#000000 cellSpacing=0 cellPadding=0 width="100%" border=0>
                                                                            <TR>
                                                                                
                                                                                <TD align=right width="50%"><a href="forgot_password.php">Forget Password</a></TD>
                                                                                <TD align=right width="49%"><INPUT class="form_button" type=submit value=Login name=Submit></TD>
                                                                                <TD width="13%">&nbsp;</TD>
                                                                            </TR>
                                                                        </TABLE>
                                                                    </TD>
                                                                </TR>
                                                            </TABLE>
                                                        </FORM>
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
    </BODY>
</HTML>
