<?php
include "top.php";
include "header.php";

$uname = $_SESSION['user_id'];

$result = mysql_query("select a.id,a.Application_No,a.Application_Fee,a.Admission_Fee,a.Demand_Draft_No,f.fname,f.mname,f.lname,e.Gurdian_Name,e.Gurdian_Mobile_No,e.Gurdian_Relation,
        e.Other_Relation,e.occu,e.other_occu,e.desi,e.income,f.Gender,e.Date_Of_Birth,e.Category,e.Physically_Challenged,e.Religion,e.other_religion,e.Nationality,
        e.Address,e.ZIP_PIN,e.Address_1,e.pin2,e.Address_2,e.Country,e.Mobile,e.Land_Phone_No,f.email,a.Total_Marks,a.Bank_Payment_Verified,a.admit,a.course_id,
        a.course_level_id,a.session_id,a.submit_date,a.flag,e.state,e.district, b.Course_Level_Name, c.Course_Name , d.FLAG_NAME
	from application_table a, course_level b, course_table c, admission_flag d, personal_details e, user f
	where a.course_level_id = b.Course_Level_Id and a.course_id = c.courseId 
        and f.user_id = '$uname' and d.FLAG_ID=a.flag and e.user_id = a.user_id and f.user_id=a.user_id") or die(mysql_error());

//$result = mysql_query($query) or die(mysql_error());
?>

<br />

<table cellpadding="5" cellspacing="5" align="center" width="98%" border="1" style="border-collapse:collapse;" bordercolor="#cacaca" >


    <tr align="center" class="colhead">
        <td width="5%">Sl.</td>
        <td width="10%">Application ID</td>
        <td width="10%">Course Level</td>
        <td width="10%">Course Name</td>
        <td width="15%">ACTION</td>
        <td width="10%">STATUS</td>
		<td width="15%">Application Challan Scan Copy</td>
		<td width="15%">Admisson Challan Scan Copy</td>
    </tr>

    <?php
    $slno = 0;
    while ($f_arr = mysql_fetch_array($result)) {
        $slno++;
        ?>
        <tr align="center" id="<?php echo $f_arr['Application_No']; ?>" bgcolor="<?php echo $bg; ?>" onMouseOver=bgColor = "#EFF7FF" onMouseOut=bgColor = "<?php echo $bg; ?>">
            <td><?php echo $slno; ?></td>
            <td><?php
    //$cl=$f_arr['Course_Level_Id'];
    //$fcl=mysql_fetch_array(mysql_query("select * from course_level where Course_Level_Id='$cl'"));
    echo $f_arr['Application_No'];
    ?></td>
            <td>
                <?php
                //$cl=$f_arr['Course_Id'];
                //$fcl=mysql_fetch_array(mysql_query("select * from course_table where CourseId='$cl'"));
                echo $f_arr['Course_Level_Name'];
                ?></td>
            <td><?php echo $f_arr['Course_Name'];?></td>
            <td style="padding-left:5px;" align="center">
                        <?php if($f_arr['admit']==0){?>
							<a href="view.php?action=view&id=<?php echo $f_arr['id'];?>">View</a>
                            ||
                            <a href="../print_application.php?application_num=<?php echo $f_arr['Application_No']?>" target="_blank">Print Application Form</a>
                            
                                                        
                         <?php }else{?>
				Admitted
                          || 
                          <a href="../print_admission_confirmation.php?application_num=<?php echo $f_arr['Application_No']?>" target="_blank">Print Admission confirmation Form</a>
	     <?php	}?>
            </td>
            <td style="padding-left:5px;" align="center"><?php echo $f_arr[FLAG_NAME] ?></td>
			<?php
			$app_no=$f_arr['Application_No'];
			$appl_fee = $f_arr['Application_Fee'];
			$admission_fee =$f_arr['Admission_Fee'];
			
			//$file_name_val=mysql_fetch_object(mysql_query("select App_challan_File_name,Admisson_challan_File_name from at_uploadfiles where Application_No='$app_no'"));
			if (strlen($appl_fee) == 0 && $f_arr[FLAG_NAME]!='DELETED'){
			?>
			<td style="padding-left:5px;" align="center"><input type="button" value="Upload Application Challan" onclick="openUploadAppCh('<?php echo $f_arr['Application_No']?>')"></td>
			<?php
			}elseif(strlen($appl_fee) == 0 && $f_arr[FLAG_NAME]=='DELETED'){?>
			<td style="padding-left:5px;" align="center">Application challan can not be uploaded for deleted application</td>
			<?php
			}else{
				if($appl_fee == 'paytm'){?>
				<td style="padding-left:5px;" align="center">Online payment done through paytm</td><?php
				}else{?>
				<td style="padding-left:5px;" align="center">Application challan already uploaded</td><?php
				}
			}
			if (strlen($admission_fee) == 0 && $f_arr[FLAG_NAME]!='DELETED' && ($f_arr[flag]==3 || $f_arr[flag]==4)){
			?>
				<td style="padding-left:5px;" align="center"><input type="button" value="Upload Admisson Challan" onclick="openUploadAdmCh('<?php echo $f_arr['Application_No']?>')"></td>
			<?php
			}elseif(strlen($admission_fee) == 0 && $f_arr[FLAG_NAME]=='DELETED'){?>
			<td style="padding-left:5px;" align="center">Admission challan can not be uploaded for deleted application</td>
			<?php
			}elseif(strlen($admission_fee) == 0 && $f_arr[flag]!=3 && $f_arr[flag]!=4){?>
			<td style="padding-left:5px;" align="center">Admission challan can not be uploaded for non ranked application</td>
			<?php
			}else{
				if($admission_fee == 'paytm'){?>
			     <td style="padding-left:5px;" align="center">Online payment done through paytm</td><?php
				}else{?>
			     <td style="padding-left:5px;" align="center">Admission challan already uploaded</td><?php
				}
			}?>
        </tr>

    <?php } ?>



</table>
<?php include "footer.php";?>
<script>
function openUploadAppCh(applicationNo){
	window.open('upload-application-challan.php?application_num='+applicationNo,'mywindow','width=700,height=500');
}
function openUploadAdmCh(applicationNo){
	window.open('upload-admisson-challan.php?application_num='+applicationNo,'mywindow','width=700,height=500');
}
</script>
