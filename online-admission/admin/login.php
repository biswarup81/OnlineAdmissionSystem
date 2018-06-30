<?php
include "top.php";
include "../../classes/admin_class.php";

$admin = new admin_class();

$rowObj = $admin->getCollegeDetails();

$action=$_REQUEST['action'];
if($action=='login')
{
	 $uname=stripslashes($_POST['user']);
	 $pass=stripslashes($_POST['pass']);
	$f_sql=f(q("SELECT * FROM admin WHERE user='$uname'"));
	$password=$f_sql['pass'];
	if($f_sql['user']<>"")
	{
		//REGISTERING SESSION VARIABLES FOR ADMIN USER
		//********************************************
		
		if($password==$pass)
		{
			$_SESSION['adminid']=$f_sql['id'];
			
			//$_SESSION['password']=$f_sql['admin_pass'];
			 
			//********************************************************* 
			//session_write_close();  
			header("location:index.php");
			exit(); 
		}else{
			$msg="<b>Invalid username/password given</b>";
		}
	}	  		
	else
	{
		 $msg="<b>Invalid username/password given</b>";
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0039)http://www.whatsred.com/admin/index.php -->
<HTML>
<HEAD>
<TITLE>Welcome to <?php echo $rowObj->name ?> Administration Area </TITLE>

<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<SCRIPT language=JavaScript>
function checkthis()
{

if(document.f1.user.value=="")
{
alert("Enter the Admin Username");
document.f1.user.focus();
return false;
}
if(document.f1.pass.value=="")
{
alert("Enter the Admin Password");
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
                	<TD height=25>Welcome to <STRONG><?php echo $rowObj->name ?> Administration Area </STRONG>!</TD>
                </TR>
                <TR>
	               	<TD vAlign=top>Use a valid <STRONG>username</STRONG> and <STRONG>password</STRONG> to gain access to the administration console.</TD>
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
								<TD align=middle bgColor="#666666" height=30><FONT color=#ffffff size=2><B>Administration Login Panel</B></FONT></TD>
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
                                                        	<?=$msg?>	
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
	                                                    <TD vAlign=center align=right height=25>User Name:</TD>
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
                                                    	<TD vAlign=top width="4%">&nbsp;</TD>
                                                  		<TD vAlign=top height=30><DIV align=center></DIV></TD>
	                                                    <TD align=right>&nbsp;</TD>
    	                                                <TD align=right>
                                                        	<TABLE borderColor=#000000 cellSpacing=0 cellPadding=0 width="100%" border=0>
			                                                    <TR>
																	<TD width=0%>&nbsp;</TD>
                                                                    <TD align=right width="38%">&nbsp;</TD>
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
