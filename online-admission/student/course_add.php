<?php
include "top.php";
include "header.php";
$action=$_REQUEST['submit'];
$print="&nbsp;";
$user_id=$_SESSION['user_id'];
$branch_id=$_SESSION['branchid'];
$listPage="course_list.php";
$addPage="course_add.php";
$table="course_table";
if($_SERVER['REQUEST_METHOD']=='GET' && $_REQUEST['edit']==0){
	header('location:'.$listPage);
	}
if($action=='Submit'){
	echo $name=strtoupper(trim($_REQUEST['name']));
	$edit=$_REQUEST['edit'];
	$id=$_REQUEST['id'];
	$chkName = mysql_query("SELECT * FROM ".$table." WHERE Course_Name='".$name."'");
	$chkNumb=mysql_num_rows($chkName);
	$chkid=mysql_fetch_array($chkName);
	if($chkNumb>0 && $chkid['CourseId']!=$id ){
		$print="<font color='#FF0000'>Course already exists</font>";
	}else{
			if($edit==1){
				mysql_query("update ".$table." set `Course_Name`='$name' where CourseId='$id'");
				header('location:'.$listPage);
				$print="<font color='#FF0000'>Value successfully Inserted.</font>";
			}else{
				
					$sql=mysql_query("INSERT INTO ".$table." (`Course_Name`) VALUES ('$name')");
					header('location:'.$listPage);
					$print="<font color='#FF0000'>Value successfully Inserted.</font>";
				
			}
		}
	}else{
		 if($_REQUEST['edit']==1){
	$id=$_REQUEST['id'];
	$edit=$_REQUEST['edit'];
	$result=mysql_fetch_array(mysql_query("SELECT * FROM ".$table." WHERE CourseId='".$id."'"));
	$name=$result['Course_Name'];
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
				<td width="90%" class="caption">: Add New Course</td>
				<td class="endcap"></td>
			</table>
		</td>
	</tr>
    <tr>
		<td class="mainarea">
        	<table cellpadding="0" cellspacing="0" width="70%" align="left" border="0" style="padding-right:5px;" >
                <tr >
                    <td style="padding-right:5px;"><a href="index" style="padding-right:5px;">Home</a>&nbsp;<img src="images/arrow.png" >&nbsp;<a href="<?=$listPage?>">Course Management</a>&nbsp;<img src="images/arrow.png" >&nbsp;<?php if($edit==1){?><a href="<?=$addPage?>?id=<?=$id?>&edit=<?=$edit?>">Edit Course</a><?php }else{?><a href="<?=$addPage?>?edit=2">Add Course</a><?php }?></td>
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
                	<td>Course Name</td>
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
