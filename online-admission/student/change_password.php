<?php 
include "top.php";
include "header.php";

$print="&nbsp;";
if($_REQUEST['action']=="submit"){
	$uname = $_SESSION['user_id'];
 	$newpassword=trim($_POST['newpassword']);
	$confirmpassword=trim($_POST['confirmpassword']);
	//$oldpassword=trim($_POST['oldpassword']);
	$valid=1;
	
	/*if($oldpassword==''){
		$print="<font color='red'>Please Enter Your Current Password.</font><br>";
		}*/
	if($newpassword!=$confirmpassword){
		$print="<font color='red'>Please Check Your New Password And Confirm Password.</font><br>";
		}
	
	else{
		//$sql=mysql_query("select * from admin where id='$adminid' and pass='$oldpassword'");
                mysql_query("update application_table a set a.password='$newpassword' where (a.email = '$uname' or a.Gurdian_Mobile_No = '$uname') ") or die(mysql_error());
                $print="Password Sucessfully Changed.";
		/*if(mysql_num_rows($sql)>0){
			mysql_query("update admin set pass='$newpassword' where id='$adminid'");
			
			$print="Password Sucessfully Changed.";
			}
		else{
			$print="<font color='red'>Correctly Enter Your Current password.</font>";
			}
		}*/
	}
}
?>

<br /><h2>Change Password</h2>
 
<table border="0" width="100%" style="border-collapse:collapse">
	<tr align="center">
    	<td><?php echo $print;?><br></td>
    </tr>
</table>    
<table cellpadding="0" cellspacing="0" width="100%" align="left" border="0" >	
	
	<tr>
		<td >		
  			<table cellpadding="0" cellspacing="0" align="center" width="50%" >
				<form name="f1" method="post"  action="change_password.php?action=submit" autocomplete="off">					
					
				
				<tr>
					<td height="25" class="fieldname">New Password  </td><td>&nbsp;:&nbsp;</td>
					<td  class="fieldname" align="right"><input type="password" name="newpassword" style="width:197px" class="formInput pad5left " required="required"></td>
				</tr>
                <tr>
					<td height="25" class="fieldname">Confirm Password  </td><td>&nbsp;:&nbsp;</td>
					<td  class="fieldname" align="right"><input type="password" name="confirmpassword" style="width:197px" class="formInput pad5left " required="required"></td>
				</tr>
				<tr>
                	<td>&nbsp;</td>
                    <td>&nbsp;</td>
					<td align=""><br>
				    <input type="submit" name="submit" value="Submit">				  </td>					
				</tr>
				</form>
			</table>
		</td>
	</tr>
</table>
<br><br><br><br><br><br><br><br><br><br><br><br>

<?php include "footer.php";?>	