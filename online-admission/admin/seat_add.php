<?php
include "top.php";
include "header.php";
$action=$_REQUEST['submit'];
$print="&nbsp;";
$user_id=$_SESSION['user_id'];
$branch_id=$_SESSION['branchid'];
$listPage="seat_list.php";
$addPage="seat_add.php";
$table="course_seat_structure";
if($_SERVER['REQUEST_METHOD']=='GET' && $_REQUEST['edit']==0){
	header('location:'.$listPage);
	}
if($action=='Submit'){
	//$Subject_Id=strtoupper(trim($_REQUEST['subject']));
        $Admission_Open = strtoupper(trim($_REQUEST['Admission_Open']));
        $Total_Seat = trim($_REQUEST['Total_Seat']);
        $SC = trim($_REQUEST['SC']);
        $ST = trim($_REQUEST['ST']);
        $OBC_A = trim($_REQUEST['OBC_A']);
        $OBC_B = trim($_REQUEST['OBC_B']);
	$CourseId= $_REQUEST['course'];
	$Course_Level_Id= trim($_REQUEST['course_level']);
        //$total_fee = trim($_REQUEST['total_fee']);
	$edit=$_REQUEST['edit'];
	$id=$_REQUEST['id'];
	$chkName = mysql_query("SELECT * FROM ".$table." WHERE Course_Id='".$CourseId."' and Course_Level_Id='".$Course_Level_Id."'");
	$chkNumb=mysql_num_rows($chkName);
	$chkid=mysql_fetch_array($chkName);
	if($chkNumb>0 && $chkid['id']!=$id ){
		$print="<font color='#FF0000'>Fee already exists</font>";
	}else{
			if($edit==1){
				mysql_query("update ".$table." set `Course_Id`='$CourseId',`Course_Level_Id`='$Course_Level_Id',`TOTAL_FEE`='$total_fee' where id='$id'");
				header('location:'.$listPage);
				$print="<font color='#FF0000'>Value successfully Inserted.</font>";
			}else{
                                    //mysql_query("INSERT INTO ".$table_fee_structure." (Course_Id,Course_Level_Id,TOTAL_FEE) VALUES ('$CourseId','$Course_Level_Id','$total_fee')")or die(mysql_error()) ;
                                     
                            mysql_query("INSERT INTO course_seat_structure (Course_Id,Course_Level_Id,SC,ST,OBC_A,OBC_B, Total_Seat) "
                                    . "VALUES ('$CourseId','$Course_Level_Id','$SC','$ST','$OBC_A','$OBC_B','$Total_Seat') ") or die(mysql_error());
					header('location:'.$listPage);
					$print="<font color='#FF0000'>Value successfully Inserted.</font>";
				
			}
		}
	}else{
		 if($_REQUEST['edit']==1){
	$id=$_REQUEST['id'];
	$edit=$_REQUEST['edit'];
	$result=mysql_fetch_array(mysql_query("SELECT * FROM ".$table." WHERE id='".$id."'"));
	echo $Course_Level_Id=$result['Course_Level_Id'];
	 $Admission_Open = strtoupper(trim($result['Admission_Open']));
        $Total_Seat = trim($result['$Total_Seat']);
        $SC = trim($result['SC']);
        $ST = trim($result['ST']);
        $OBC_A = trim($result['OBC_A']);
        $OBC_B = trim($result['OBC_B']);
	$CourseId= $result['course'];
	$Course_Level_Id= trim($result['course_level']);
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
				<td width="90%" class="caption">: Add New Seat Availability</td>
				<td class="endcap"></td>
			</table>
		</td>
	</tr>
    <tr>
		<td class="mainarea">
        	<table cellpadding="0" cellspacing="0" width="70%" align="left" border="0" style="padding-right:5px;" >
                <tr >
                    <td style="padding-right:5px;"><a href="index" style="padding-right:5px;">Home</a>&nbsp;<img src="images/arrow.png" >&nbsp;<a href="<?=$listPage?>">Seat Structure</a>&nbsp;<img src="images/arrow.png" >&nbsp;<?php if($edit==1){?><a href="<?=$addPage?>?id=<?=$id?>&edit=<?=$edit?>">Edit Seat Structure</a><?php }else{?><a href="<?=$addPage?>?edit=2">Add Seat Structure</a><?php }?></td>
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
                	<td>Course Level</td>
                    <td>:</td>
                    <td>
                    	<Select type="text" name="course_level"  id="course_level" onchange="current_stock(1)" required>
              <option value="">Select</option>
              <?php
				$q_CL=q("select * from course_level where Course_Level_Id!='2' order by Course_Level_Name asc ");
				while($f_CL=f($q_CL))	{
								?>
							<option value="<?php echo $f_CL['Course_Level_Id'];?>" <?php if($f_CL['Course_Level_Id']==$Course_Level_Id){?> selected="selected" <?php }?>><?php echo $f_CL['Course_Level_Name'];?></option>
								<?php  } ?>
              </Select>
                    </td>
                </tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr>
                	<td>Course Name</td>
                    <td>:</td>
                    <td>
                    	<Select type="text" name="course"  id="course" onchange="current_stock(1)" required>
              <option value="">Select</option>
              <?php
				$q_C=q("select * from course_table order by Course_Name asc ");
				while($f_C=f($q_C))	{
								?>
							<option value="<?php echo $f_C['CourseId'];?>" <?php if($f_C['CourseId']==$CourseId){?> selected="selected" <?php }?>><?php echo $f_C['Course_Name'];?></option>
								<?php  } ?>
              </Select>
                    </td>
                </tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr>
                	<td>Total Seat</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="Total_Seat" id="Total_Seat" value="<?php echo $Total_Seat; ?>">
                    </td>
                </tr>
                <tr><td colspan="3">&nbsp;</td></tr>    
                <tr>
                	<td>SC Seat</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="SC" id="SC" value="<?php echo $SC; ?>">
                    </td>
                </tr>
                <tr><td colspan="3">&nbsp;</td></tr>

                <tr>
                	<td>ST Seat</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="ST" id="ST" value="<?php echo $ST; ?>">
                    </td>
                </tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                

                <tr>
                	<td>OBC-A Seat</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="OBC_A" id="OBC_A" value="<?php echo $OBC_A; ?>">
                    </td>
                </tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                 <tr>
                	<td>OBC-B Seat</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="OBC_B" id="OBC_A" value="<?php echo $OBC_B; ?>">
                    </td>
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
