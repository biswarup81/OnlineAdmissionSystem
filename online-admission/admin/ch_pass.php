<? 
include "top.php";
include "header.php";
$action=$_REQUEST['action'];
$curpassword=$_SESSION['password'];

if($action=='save')
{
 	$adminid=$_SESSION['adminid'];
 	$newpassword=trim($_POST['newpassword']);
	$oldpassword=trim($_POST['oldpassword']);
	$valid=1;
	
	if($oldpassword=='')
	{
		$ERmsg="Please Enter Your Current Password !<br>";
		$valid=0;		
	}
	if($newpassword=='' && $valid==1)
	{
		$ERmsg="Please Enter Your New Password !<br>";
		$valid=0;		
	}
	
	if($oldpassword!=$curpassword && $valid==1)
	{
		$ERmsg="Please Enter Correctly Your Current Password !<br>";
		$valid=0;		
	}
	
	if($valid==1)
	{
		q("update dt_admin set admin_pass ='".$newpassword."' where id =$adminid");
		header("location:logout.php");
		exit();
	}
 }
?>

			
<table cellpadding="0" cellspacing="0" width="70%" align="center" border="0" >	
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="40%" align="left">
				<td width="90%" class="caption">: Change Password</td>
				<td class="endcap"></td>
			</table>
		</td>
	</tr>
	<tr>
		<td class="mainarea">		
  			<table cellpadding="0" cellspacing="0" align="center" width="50%" >
				<form action="<?=$_SERVER['PHP_SELF']?>?action=save" style="margin:0px; padding:0px " id="f1" name="f1" method="post" >				
				<tr>
					<td height="25" class="fieldname">Current Password : </td>
					<td class="fieldname"><input type="text" name="oldpassword" value="<?=$oldpassword?>" size="20" maxlength="10"></td>
				</tr>
				<tr>
					<td height="25" class="fieldname">New Password : </td>
					<td  class="fieldname"><input type="text" name="newpassword" value="<?=$newpassword?>" size="20" maxlength="10"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input class="form_button" type="submit" name="submit" value="Update"> </td>					
				</tr>
				</form>
			</table>
		</td>
	</tr>
</table>

<? include "footer.php";?>	