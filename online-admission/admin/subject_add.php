<?php
include "top.php";
include "header.php";
$action=$_REQUEST['submit'];
$print="&nbsp;";
$user_id=$_SESSION['user_id'];
$branch_id=$_SESSION['branchid'];
$listPage="subject_list.php";
$addPage="subject_add.php";
$table="subject_master";
if($_SERVER['REQUEST_METHOD']=='GET' && $_REQUEST['edit']==0){
	header('location:'.$listPage);
	}
if($action=='Submit'){
	echo $name=strtoupper(trim($_REQUEST['name']));
	$edit=$_REQUEST['edit'];
	$id=$_REQUEST['id'];
	$chkName = mysql_query("SELECT * FROM ".$table." WHERE Subject_Name='".$name."'");
	$chkNumb=mysql_num_rows($chkName);
	$chkid=mysql_fetch_array($chkName);
	if($chkNumb>0 && $chkid['Subject_Id']!=$id ){
		$print="<font color='#FF0000'>Subject already exists</font>";
	}else{
			if($edit==1){
				mysql_query("update ".$table." set `Subject_Name`='$name' where Subject_Id='$id'");
				header('location:'.$listPage);
				$print="<font color='#FF0000'>Value successfully Inserted.</font>";
			}else{
				
					$sql=mysql_query("INSERT INTO ".$table." (`Subject_Name`) VALUES ('$name')");
					header('location:'.$listPage);
					$print="<font color='#FF0000'>Value successfully Inserted.</font>";
				
			}
		}
	}else{
		 if($_REQUEST['edit']==1){
	$id=$_REQUEST['id'];
	$edit=$_REQUEST['edit'];
	$result=mysql_fetch_array(mysql_query("SELECT * FROM ".$table." WHERE Subject_Id='".$id."'"));
	$name=$result['Subject_Name'];
	}else{
		$id="";
		$edit=0;	
	}	
	}
	
?>


<table cellpadding="0" cellspacing="0" width="70%" align="left" border="0" >	
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="40%" align="left">
				<td width="90%" class="caption">: Add New Subject</td>
				<td class="endcap"></td>
			</table>
		</td>
	</tr>
    <tr>
		<td class="mainarea">
        	<table cellpadding="0" cellspacing="0" width="70%" align="left" border="0" style="padding-right:5px;" >
                <tr >
                    <td style="padding-right:5px;"><a href="index" style="padding-right:5px;">Home</a>&nbsp;<img src="images/arrow.png" >&nbsp;<a href="<?=$listPage?>">Subject Management</a>&nbsp;<img src="images/arrow.png" >&nbsp;<?php if($edit==1){?><a href="<?=$addPage?>?id=<?=$id?>&edit=<?=$edit?>">Edit Subject</a><?php }else{?><a href="<?=$addPage?>?edit=2">Add Subject</a><?php }?></td>
                </tr>
            </table>
            <br><br>
			<table cellpadding="0" cellspacing="0" width="40%" align="center">
				<td width="90%" ><?php echo $print;?></td>
				<td ></td>
			</table>
		</td>
	</tr>
    <tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="70%" align="right">
				<tr align="right">
                <td ><font color="#FF0000">*</font> Required Filled</td>
				</tr>
			</table>
		</td>
	</tr>
    <tr>
		<td>
        	<form name="f1" method="post" enctype="multipart/form-data" action="<?=$addPage?>">
            	<input type="hidden" name="id" value="<?=$id?>"/>
				<input type="hidden" name="edit" value="<?=$edit?>"/>		
  			<table cellpadding="0" cellspacing="0" align="center" width="70%" border="0">
                <tr>
                	<td>Subject Name</td>
                    <td>:</td>
                    <td><input type="text" name="name" value="<?=$name?>" required="required" size="30" /></td>
                </tr>
                <tr><td colspan="3">&nbsp;</td></tr>
              
                <tr>
                	<td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="left"><br><input type="submit" name="submit" value="Submit" class="form_button"></td>
                </tr>
			</table>
            </form>
		</td>
	</tr>
</table>


<?php
include "footer.php";
?>
