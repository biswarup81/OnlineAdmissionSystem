<?php 
include "config.php";

session_start();

if(!isset($_SESSION['application_no_id'])){

	header('Location:application_login.php');
}
/*else {	
	$now = time();

	if ($now > $_SESSION['expire']) {
		session_destroy();
		header('Location: index.html');
	}
}*/

$res_query=mysql_query("SELECT * FROM `application_table` WHERE `Application_No` = '".$_SESSION['application_no_id']."'");
$row_query=mysql_fetch_array($res_query);


//print_r($row_query);die();






/*   anitesh code*/
$id=array();
$subject=array();
$marksObtained=array();
$passFailRemarks=array();
$totalMarkObtained=0;
$rollIndexNo=array();


$marksQuery=mysql_query("SELECT * FROM `applicaion_marks` WHERE `Application_No` = '".$_SESSION['application_no_id']."'");
$i=0;
while($marksQueryArray=mysql_fetch_assoc($marksQuery))
{

    $id[] = $marksQueryArray['id'];
    $subject[] = $marksQueryArray['Subject'];
    $marksObtained[] =$marksQueryArray['Marks_Obtained'];
    $totalMarkObtained=$totalMarkObtained+$marksObtained[$i];
    $i++;

    $passFailRemarks[]=$marksQueryArray['Pass_Fail_Remarks'];
    $rollIndexNo[]=$marksQueryArray['Roll_Index_No'];
    $yearOfPassing=$marksQueryArray['Year_of_Passing'];
}

$totalMarks=0;
$totalMarksQuery=mysql_query("SELECT `Marks_Obtained` FROM `applicaion_marks` WHERE `Application_No`='".$_SESSION['application_no_id']."' ORDER BY `Marks_Obtained` DESC LIMIT 0,5");
while($totalMarkArray=mysql_fetch_assoc($totalMarksQuery))
{
    $totalMarks=$totalMarks+$totalMarkArray['Marks_Obtained'];
}



//echo $totalMarkObtained;die();
//print_r($marksObtained);
//die();





/*   anitesh code*/
?>
<html><head>

<link type="text/css" rel="stylesheet" href="calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
<script type="text/javascript" src="calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<script type="text/javascript" src="lib/jquery-1.3.2.js"></script>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">

<title>Online Application : Apply Online</title>

<style>
.Submit_reset{
	width:65px;
	height:30px;
	cursor:pointer;
	background-color: #FF9933;
	}

td { padding-left:20px; }

.sTD { background-color:#eee; }

.mTD { padding-left:0px;text-align:center; }



.style1 {
	color: #FF0000;
	font-weight: bold;
}

.style2 {color: #FF0000}

.style8 {color: #000000;
	font-weight: bold;
}

.style3 {font-size: x-small}

.style6 {color: #000000; font-weight: bold; font-size: 18px; }

.style9 {color: #0000FF}

.style10 {color: #000000}

.style12 {font-size: large}



</style>

<script src="../js/online_admission.js" type="text/javascript"></script>
<script>
function changeUserFlag(inputFlag, id){
    //Call Ajax
    alert(inputFlag);
    alert(id);
    
    $("#button_Panel").load("admin/ajax/change_Application_Status.php?flag="+inputFlag+"&id="+id,function(responseTxt,statusTxt,xhr){
		  if(statusTxt=="success"){
                        alert(responseTxt);
			document.getElementById("button_Panel").innerHTML=responseTxt;
			
			}else if(statusTxt=="error"){
				alert("Error: "+xhr.status+": "+xhr.statusText);
			}
		});

}
</script>
</head>

<body style="font-family: sans-serif;margin: 0px;">

<form id="applyform" action="registration_s.php" method="post" enctype="multipart/form-data" name="applyform" onSubmit="return validateApply();">



 <center>
  <table border="0" width="0%">

	<tbody><tr bgcolor="#FFFFCC">

	  <td height="73" colspan="2">
      <?php
      $cdata=mysql_fetch_array(mysql_query("select * from cname"));
	  ?>
      <div align="center">
<table width="100%">
<TR>
<td width="25%"><img src="<?=$cdata['logo'];?>" width="195" height="50"></td>
<td width="65%" align="center" style="font-family:Georgia, 'Times New Roman', Times, serif" >
<font size="+3"><?php 
echo $cdata['name'];
?></font>
<br>
<?=$cdata['address'];?>
<br>
APPLICATION FOR ADMISSION
<div style="width:400px; padding:10px;">
<div style="float:left;">
<b>Stream : </b>
</div>
<div style="float:left; padding-left:25px;" >
<select name="select" disabled id="select" onChange="return CourseLevel()" required>

<?php 
$courseLevel_query=mysql_query("SELECT * FROM `course_level` ORDER BY `Course_Level_Id` ASC");
$courseLevelOption='<option value="">Select Course Level</option>';
while($courseLevel=mysql_fetch_array($courseLevel_query))
{

    $courseLevelOption .= "<option value=\"" . $courseLevel['Course_Level_Id'] . "\"";
    if($courseLevel['Course_Level_Id'] == $row_query['course_level_id'])
    {
        $courseLevelOption .= " selected ";
    }
    $courseLevelOption .= ">" . $courseLevel['Course_Level_Name'] . "</option>";
?>


    
<?php
}
echo $courseLevelOption;
?>
 </select>
</div>
<div>
<span id="dOptPut">
<?php 
$result = mysql_query("SELECT * FROM `course_subject_link` WHERE `id`='$row_query[course_id]'") 
	or die(mysql_error());
	
	$x= '<select name="D1" id="D1" onchange="return subMand()" required disabled>';
			$row=mysql_num_rows($result);
		   while($drop_2 = mysql_fetch_array( $result )) 
			{
				$chk=$drop_2['Course_Id'];
				$courseName=mysql_fetch_array(mysql_query("SELECT * FROM `course_table` WHERE `CourseId`='".$chk."'"));
				
			  $x.= '<option value="'.$drop_2['Course_Id'].'">'.$courseName['Course_Name'].'</option>';
			}
	
	$x.= '</select>';
	echo $x;
?>
</span>
  </div>
</div>
<br>
<font color="red">* All Fields are Mandatory.</font>
</td>
<td width="10%"></td>
</TR>

</table>

</div>

</td>
	  </tr>

	<tr bgcolor="#FFFFCC">

		<td colspan="2" bgcolor="#FF9933">

			<br>

			<br>

		<font size="5">Personal Information:<br>

		<br></font>		</td>
	</tr><tr bgcolor="#FFFFFF">



		<td width="250" class="sTD"><label><span class="style1">*</span>First Name</label></td>

		<td width="576" class="sTD"><input name="Your_name" type="text" id="Your_name" size="40" maxlength="39" style="text-transform:uppercase;" value="<?=$row_query['First_Name']?>" required readonly></td>

	</tr><tr>

		<td style="padding-left:26px;"><label>Middle Name</label></td>

		<td>



			<input name="U_name" type="text" id="U_name" size="40" maxlength="39" style="text-transform:uppercase;" value="<?=$row_query['Middle_Name']?>" readonly>

		&nbsp;&nbsp;</td>

	</tr><tr>



		<td class="sTD"><span class="style1">*</span><label>Last Name</label></td>

		<td class="sTD"><input name="U_lname" type="text" id="U_lname" size="40" maxlength="39" style="text-transform:uppercase;" required value="<?=$row_query['Last_Name']?>" readonly></td>

	</tr><tr>



		<td><label><span class="style2">*</span>Guardian's Name</label></td>



		<td><input name="U_gname" type="text" id="U_gname" size="40" maxlength="39" style="text-transform:uppercase;" required value="<?=$row_query['Gurdian_Name']?>" readonly> 

		<span class="style2">*</span>Mobile Number

		   <label for="textfield"></label>

	    <input type="text" name="gmobnum" id="gmobnum" required="required" pattern="[0-9]{10}" value="<?=$row_query['Gurdian_Mobile_No']?>" readonly></td>



	</tr><tr>

		<td class="sTD"><label><span class="style2">*</span>Relation</label></td>

		<td class="sTD">

			<select id="g_relation" name="g_relation" onChange="displayR();" disabled>
				<option value="">Choose Relation</option>
				<option value="Father" <?php if($row_query['Gurdian_Relation']=='Father'){?> selected <?php }?>>Father</option>
				<option value="Mother" <?php if($row_query['Gurdian_Relation']=='Mother'){?> selected <?php }?>>Mother</option>
				<option value="Uncle"<?php if($row_query['Gurdian_Relation']=='Uncle'){?> selected <?php }?> >Uncle</option>
				<option value="Aunt" <?php if($row_query['Gurdian_Relation']=='Aunt'){?> selected <?php }?>>Aunt</option>
				<option value="Husband" <?php if($row_query['Gurdian_Relation']=='Husband'){?> selected <?php }?>>Husband</option>
				<option value="Other" <?php if($row_query['Gurdian_Relation']=='Other'){?> selected <?php }?>>Other</option>
			</select>	
            
            &nbsp;&nbsp;<span id="other_R" <?php if($row_query['Gurdian_Relation']!='Other'){?>style="visibility:hidden"<?php }?>><span class="style2">*</span>Other Relation

	      <input name="R_other" type="text" id="R_other" size="20" maxlength="29" style="text-transform:uppercase;" required value="<?=$row_query['Other_Relation']?>" readonly>

	      </span>	</td>

	</tr>

	<tr>

      <td><label><span class="style2">*</span>Occupation</label></td>

	  <td><label for="label"></label>

	    <label for="label"></label>
        <select name="occu" id="occu" disabled onChange="displayO();">
              <option value="">Choose Occupation</option>
              <option value="Service" <?php if($row_query['occu']=='Service'){?> selected <?php }?>>Service</option>
              <option value="Self Employed" <?php if($row_query['occu']=='Self Employed'){?> selected <?php }?>>Self Employed</option>
              <option value="Professional" <?php if($row_query['occu']=='Professional'){?> selected <?php }?>>Professional</option>
              <option value="House Hold" <?php if($row_query['occu']=='House Hold'){?> selected <?php }?>>House Hold</option>
              <option value="Retaired Person" <?php if($row_query['occu']=='Retaired Person'){?> selected <?php }?>>Retired Person</option>
              <option value="others" <?php if($row_query['occu']=='others'){?> selected <?php }?>>Other</option>
        </select>
        <span id="other_O" <?php if($row_query['occu']!='others'){?> style="visibility:hidden" <?php }?>><span class="style2">*</span>
        Other Occupation  <input type="text" name="othrOccu" id="othrOccu" value="<?=$row_query['other_occu']?>" readonly>
        </span>
          </td>
	</tr>

	<tr>

      <td class="sTD" style="padding-left:26px;"><label>Designation</label></td>

	  <td class="sTD"><label for="label2"></label>

	    <input type="text" name="desi" id="desi" style="text-transform:uppercase;" value="<?=$row_query['desi']?>" readonly></td>
	  </tr>

	<tr>

	  <td style="padding-left:26px;">Monthly Income </td>

	  <td><label for="label3"></label>

	    <select name="income" id="income" disabled>

	      <option value="<5000" <?php if($row_query['income']=='<5000'){?> selected <?php }?>>&lt;5000</option>

	      <option value="5000-10000" <?php if($row_query['income']=='5000-10000'){?> selected <?php }?>>5000-10000</option>

	      <option value="10001-20000" <?php if($row_query['income']=='10001-20000'){?> selected <?php }?>>10001-20000</option>

	      <option value=">20000" <?php if($row_query['income']=='>20000'){?> selected <?php }?>>&gt;20000</option>
	      </select>	    </td>
	  </tr>

	<tr>

	  <td class="sTD"><span class="style2">*</span>Gender</td>

	  <td class="sTD">
          <input name="radio2" type="radio" id="radio2" value="M" required="required" <?php if($row_query['Gender']=='M'){?> checked <?php }?> disabled="disabled" > Male

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <input name="radio2" type="radio" id="radio2" value="F" <?php if($row_query['Gender']=='F'){?> checked <?php }?> disabled="disabled">

        Female </td>
	  </tr>

	<tr>

	  <td><span class="style2">*</span>Date of Birth</td>

	  <td><span class="sTD"><br>

	    <input type="text" required="required" name="theDate" id="theDate" placeHolder=" DD/MM/YYYY" pattern="\d{1,2}/\d{1,2}/\d{4}" value="<?=date("d/m/Y",strtotime($row_query['Date_Of_Birth']))?>" readonly>
	  </span></td>
	  </tr>

	<tr>

	  <td bgcolor="#FF0000" class="sTD"><span class="style2">*</span>Category</td>

	  <td class="sTD">
          <input name="radio3" type="radio" id="gen" value="GEN" required="required"
              <?php if($row_query['Category']=='GEN'){?> checked <?php }?> disabled="disabled">General

	    &nbsp;&nbsp;&nbsp;&nbsp;

      
	    <input name="radio3" type="radio" id="sc" value="SC" <?php if($row_query['Category']=='SC'){?> checked <?php }?>
               disabled="disabled">SC     &nbsp;&nbsp;

  <input name="radio3" type="radio" id="st" value="ST" <?php if($row_query['Category']=='ST'){?> checked <?php }?>
         disabled="disabled">ST

	    &nbsp;&nbsp;&nbsp;&nbsp;
		<input name="radio3" type="radio" id="obca" value="OBC-A" <?php if($row_query['Category']=='OBC-A'){?> checked <?php }?>
               disabled="disabled">OBC A &nbsp;&nbsp;

	  <input name="radio3" type="radio" id="obcb" value="OBC-B" <?php if($row_query['Category']=='OBC-B'){?> checked <?php }?>
             disabled="disabled">OBC B &nbsp;&nbsp;
 </td></tr>

	<tr>
	  <td><span class="style2">*</span>Physically Challenged</td>
	  <td>
	  <input name="ph_radio3" type="radio" id="ph_radio3" value="YES" <?php if($row_query['Physically_Challenged']=='Y'){?> checked <?php }?> disabled="disabled">

	    YES     &nbsp;&nbsp;&nbsp;&nbsp;

     <input name="ph_radio3" type="radio" id="ph_radio3" value="NO" <?php if($row_query['Physically_Challenged']=='N'){?> checked <?php }?> disabled="disabled">

	    NO	  </td>
	  </tr>
	<tr>
	  <td bgcolor="#FF0000" class="sTD"><span class="style2">*</span>Religion</td>
	  <td class="sTD"><label>
      <select name="religion" id="religion" onChange="displayRelign()" required="" disabled="disabled">
      	<option value="">Select</option>
        <option value="Hindu" <?php if($row_query['Religion']=='Hindu'){?> selected <?php }?>>Hindu</option>
        <option value="Muslim" <?php if($row_query['Religion']=='Muslim'){?> selected <?php }?>>Muslim</option>
        <option value="Christian" <?php if($row_query['Religion']=='Christian'){?> selected <?php }?>>Christian</option>
        <option value="others" <?php if($row_query['Religion']=='others'){?> selected <?php }?>>Other</option>
      </select>
      <span id="other_relig" <?php if($row_query['Religion']!='others'){?> style="visibility:hidden" <?php }?>><span class="style2">*</span>Other Religion 
	    <input type="text" name="other_religion" id="other_religion" style="text-transform:uppercase" required="required" value="<?=$row_query['other_religion']?>" readonly>
        </span>
	  </label></td>
	  </tr>
	<tr>

      <td><span class="style2">*</span>Nationality</td>

	  <td><span class="sTD">

	    <select name="select7" id="select7" onChange="return otherNation();" required="required" disabled="disabled">
	      <option value="INDIAN" selected>INDIAN</option>
	      <?php /*?><option value="Nepali">Nepali</option>
	      <option value="Bhutiya">Bhutiya</option>
          <option value="Bangladeshi">Bangladeshi</option>
	      <option value="Pakistani">Pakistani</option>
	      <option value="Other">Others</option><?php */?>
        </select>

		<span id="other_Nation" style="visibility:hidden">

	    <span class="style2">*</span>Other Nationality

	  <label for="textfield"></label>

	  <input type="text" name="nationother" id="nationother" style="text-transform:uppercase;" value="<?=$row_query['Last_Name']?>" readonly>
</span> </span></td>
	  </tr>

	<tr>

      <td bgcolor="#FF0000" class="sTD"><label><span class="style2">*</span>Present Address </label></td>

	  <td class="sTD"><label for="textfield">

	    <textarea name="p_address" id="p_address" rows="5" cols="30" style="text-transform:uppercase;" required="required" maxlength="200" readonly><?=$row_query['Address']?></textarea>

	    <span class="style2">*</span>Pincode

	  </label>

	    <input type="text"  pattern="[0-9]{6}" name="pin1" id="pin1" required="required" value="<?=$row_query['ZIP_PIN']?>" readonly>

	    <label for="textfield"><br>

	    <font color="Gray">&nbsp;&nbsp;&nbsp;&nbsp;Upto 200 characters only.</font>	    </label></td>
	</tr>

	<tr>

      <td><label><span class="style2">*</span>Country</label></td>

	  <td><label for="label"></label>

	    <select name="select4" id="select4" onChange="return countrychange();" disabled>
              <option value="INDIA" selected >INDIA</option>
             <!-- <option value="NEPAL">NEPAL</option>
              <option value="BHUTAN">BHUTAN</option>
              <option value="BANGLADESH">BANGLADESH</option>
              <option value="PAKISTAN">PAKISTAN</option>
              <option value="Other">OTHERS</option>-->
        </select>

	    &nbsp;&nbsp; <span id="other_C" style="visibility:hidden"><span class="style2">*</span>Country Name

	      <input name="Co_others" type="text" id="Co_others" size="20" maxlength="29" style="text-transform:uppercase;" value="<?=$row_query['Last_Name']?>">

	      </span> </td>
	  </tr>

	<tr>

      <td class="sTD"><label><span class="style2">*</span>State</label></td>

	  <td class="sTD"><span class="sTD" id="india_state" style="width:400px;">

	  <select name="select10" id="select10"  required="required" disabled>
      	
		<?php 
		$State_query=mysql_query("select * from states");
		while($states=mysql_fetch_array($State_query))
        {
                $state .= "<option value=\"" . $states['id'] . "\"";

                if($row_query['state'] == $states['id'])
                {
                    $state .= " selected ";
                }

                $state .= ">" . $states['name'] . "</option>";

		 }
        echo $state;
        ?>
	  </select>

	  </span></td>
	  </tr>

	<tr>

      <td><label><span class="style2">*</span>District</label></td>

	  <td><span class="sTD" id="districtList" style="width:400px;">

	    <select name="D2" id="D2" required="required" DISABLED>

            <?php
			echo $row_query['district'];
            $districtQuery=mysql_query("select `id`,`name` from `districts` Where `id`=".$row_query['district']);
            while($districtsArray=mysql_fetch_assoc($districtQuery))
            {
                //print_r($districtsArray);
                $districtOption='<option value="'.$districtsArray['id'].'">'.$districtsArray['name'].'</option>';

            }
            echo $districtOption;
            ?>
          <!--<option value="">Choose District</option>-->

        </select>

	  </span></td>
	  </tr>

	<tr>

      <td height="52" bgcolor="#FF0000" class="sTD" style="padding-left:26px;"><label>Phone Number</label></td>

	  <td class="sTD"><label for="textfield"></label>

          <label for="label">
<?php 
$LandP=explode('-',$row_query['Land_Phone_No']);

?>
          <input name="U_phone22" type="text" id="U_phone22" size="6" placeholder="STD Code" value="<?=$LandP[0]?>" onBlur="phnChk()" readonly>

            <input name="U_gname222" type="text" id="U_gname222" size="20" maxlength="39" placeholder="Phone No" pattern="[0-9]{10}" onBlur="phnChk()" value="<?=$LandP[1]?>" readonly>
</label></td>
	  </tr>

	<tr>

      <td><span class="style2">*</span>Email Address </td>

	  <td><label for="textfield"></label>

          <label for="textfield"></label>

          <input name="email" type="email" id="email" size="50" maxlength="50" required="required" value="<?=$row_query['email']?>" readonly></td>
	  </tr>

	<tr>

	  <td bgcolor="#FF0000" class="sTD"><span class="style2">*</span>Permanent Address</td>

	  <td class="sTD">Same as Present Address

	    <input name="radiopar" type="radio" value="yes" id="radiopar" <?php if($row_query['Address_1']==''){?> checked="checked" <?php }?>
               onClick="show_par_add('yes');" disabled>

	    Yes

	      <input name="radiopar" type="radio" value="no" id="radiopar"  <?php if($row_query['Address_1']!=''){?> checked="checked" <?php }?>
              disabled>

	      <label for="radio">No<br>
	      </label>
<?php if($row_query['Address_1']!=''){?>
	      <span  style="width:10000px;">
          <textarea name="u_address" id="u_address" rows="5" cols="30" style="text-transform:uppercase;" readonly><?=$row_query['Address_1']?></textarea><span class="style2"> *</span>Pincode<label for="label"></label><input type="text" name="pin2" id="pin2" pattern="[0-9]{6}" value="<?=$row_query['pin2']?>" readonly><br><font color="Gray"></font>
          </span>
<?php }?>
	     </td>
	  </tr>

	<!-- ************************************************** -->

	<tr id="p1" style="display:none">

      <td><label><span class="style2">*</span>Country</label></td>

	  <td><label for="label"></label>

	    <label for="label"></label>

	     <select name="select12" id="select12" onChange="return pcountrychange();">

	       <option value="INDIA" selected="">INDIA</option>
<?php /*?>
	       <option value="NEPAL">NEPAL</option>

	       <option value="BHUTAN">BHUTAN</option>

            <option value="BANGLADESH">BANGLADESH</option>

	       <option value="PAKISTAN">PAKISTAN</option>

	      <option value="OT">OTHERS</option><?php */?>
	      </select>

	     &nbsp;&nbsp;

		 <span id="pother_C" style="visibility:hidden"><span class="style2">*</span>Country Name

		<input name="Co_pothers" type="text" id="Co_pothers" size="20" maxlength="29" style="text-transform:uppercase;"></span>        </td>
	  </tr>

	<tr id="p2" style="display:none">

      <td class="sTD"><label><span class="style2">*</span>State</label></td>

	  <td class="sTD"><span class="sTD" id="pindia_state" style="width:400px;">

	  <select name="select13" id="select13">
     <option value="">Choose State</option>
		<?php 
		$State_query=mysql_query("select * from states");
		while($states=mysql_fetch_array($State_query)){
		?>
		<option value="<?=$states["id"]?>"><?=$states["name"]?></option>
		<?php }?>
	  </select>

	  </span>

	    <label for="label"></label></td>
	</tr>

	<tr id="p3" style="display:none">

      <td><label><span class="style2">*</span>District</label></td>

	  <td><span class="sTD" id="pdistrictList" style="width:400px;">

	  	<select name="D3" id="D3">
      		<option value="">Choose District</option>
        </select>

      </span>

	    <label for="label2"></label></td>
	</tr>

	<tr bgcolor="#FFFFFF" id="p4" style="display:none">

      <td class="sTD" style="padding-left:26px;"><label>Phone Numbers </label></td>

	  <td class="sTD"><label for="label4"></label>

	    <input type="text" name="pphone" id="pphone" value="<?=$row_query['Last_Name']?>" ></td>
	</tr>

	<tr>

      <td><label><span class="style2">*</span>Local Guardian</label></td>

	  <td><!--<span class="sTD" id="districtList" style="width:400px;">

      </span>-->

          <label for="textfield"></label>

          Same as Guardian

          <input name="radiolocal" type="radio" value="yes" id="radiolocal" checked="checked" onClick="show_local('yes');" disabled>

          Yes

          <input name="radiolocal" type="radio" value="no" id="radiolocal" onClick="show_local('no');" disabled>

          <label for="radio5"></label>

          <label for="radio4"></label>

          No

        <label for="label2"></label></td>
	  </tr>

	<tr bgcolor="#FFFFFF" id="g1" style="display:none">

	  <td class="sTD"><span class="style2">*</span>Local Guardian's Name </td>

	  <td class="sTD"><label for="label3"></label>

	    <input type="text" name="lgname" id="lgname"  style="text-transform:uppercase;" value="<?=$row_query['Last_Name']?>"></td>
	  </tr>

	<tr id="g2" style="display:none">

      <td><span class="style2">*<span class="style10">Relation with the Candidate</span></span></td>

	  <td><label for="label2"></label>

	    <select name="select14" id="select14" onChange="show_R();" disabled>

          <option value="Father" selected="selected">Father</option>

          <option value="Mother">Mother</option>

          <option value="Uncle">Uncle</option>

          <option value="Aunt">Aunt</option>

          <option value="Husband">Husband</option>

          <option value="Other">Other</option>
          </select>

	    <span class="style2">

	      <label for="textfield"> <span class="style10"></span></label>
	      </span>

	      <label for="textfield"><span class="sTD"><span id="grelation" style="visibility:hidden">

          <span class="style2">*</span>Other Relation

		    

	              </span></span></label></td>
	</tr>

	<tr bgcolor="#FFFFFF" id="g3" style="display:none">

	  <td class="sTD"><span class="style2">*</span>Local Guardian's Address</td>

	  <td class="sTD"><textarea name="localA" cols="30" rows="5" id="localA" style="text-transform:uppercase;" readonly ><?=$row_query['Last_Name']?></textarea>

	    <span class="style2"> *</span>Pincode

	      <label for="label"></label>

	      <input type="text" name="textfield6" id="textfield6" pattern="[0-9]{6}" value="<?=$row_query['Last_Name']?>" readonly></td>
	  </tr>

	<tr id="g4" style="display:none">

	  <td style="padding-left:26px;">Phone Numbers</td>

	  <td><span class="sTD">

	    <input type="text" name="lgphone" id="lgphone" value="<?=$row_query['Last_Name']?>" readonly>

	  </span>Mobile Number 

	  <label for="label2"></label>

	  <input type="text" name="textfield5" id="textfield5" value="<?=$row_query['Last_Name']?>" readonly></td>
	</tr>

	<tr bgcolor="#FFFFFF" id="g5" style="display:none">

      <td class="sTD" style="padding-left:26px;"><label>Email Address </label></td>

	  <td class="sTD"><label for="label4"></label>

          <label for="label">

          <input name="textfield3" type="email" id="textfield3" size="30" maxlength="30" value="<?=$row_query['Last_Name']?>" readonly>
        </label></td>
	  </tr>

	<tr bgcolor="#FFFFCC">

		<td colspan="2" bgcolor="#FF9933">

			<br>

			<br>

		<font size="5">Academic Information:<br>

		<br></font>		</td>
	</tr><tr>

		<td class="sTD"><label><span class="style2">*</span>Board/Council (10+2)</label></td>

		<td class="sTD">

			<select id="U_council" name="U_council" onChange="otherBoard();" style="width:110px;" disabled>

				<option value="WBCHSE" selected="">WBCHSE</option>

				<option value="CBSE">CBSE</option>

				<option value="ISC">ISC</option>

				<option value="Other">Other</option>
			</select>

		&nbsp;&nbsp;&nbsp;

		<span id="other_B" style="visibility:hidden"><span class="style2">*</span>Board Name

		<input name="Uv_others" type="text" id="Uv_others" size="30" maxlength="30" style="text-transform:uppercase;" required="required"
               value="<?=$row_query['Last_Name']?>" readonly>
		</span>		</td>

	</tr>

	<tr>

	  <td><span class="style2">*</span>Roll No/Index Number </td>

	  <td><span class="sTD">

	    <input name="U_roll2" type="text" id="U_roll2" size="30" maxlength="6" style="text-transform:uppercase;" required
               value="<?php echo $rollIndexNo[0];?>" readonly>&nbsp;<span id="other_roll" style="visibility:visible">
                  <span class="style2">*</span>Number

		<input name="U_roll3" type="text" id="U_roll3" size="30" maxlength="4" style="text-transform:uppercase;" required="required"
               value="<?php echo $totalMarkObtained;?>" readonly>

		</span><span class="style9">

	    </span></span></td>
	  </tr>

	<tr>

      <td class="sTD"><label><span class="style2">*<span class="style10">Year of passing</span></span></label></td>

	  <td class="sTD">
          <span id="yearList" style="width:400px;">
              <select id="select2" name="select2" required disabled>

                  <?php ?>
                  <!--<option value="" selected="selected">Select Year</option>-->


                  <option value="<?php $yearOfPassing; ?>"><?php echo $yearOfPassing; ?></option>
                 <!-- <option value="2012">2012</option>
                  <option value="2013">2013</option>
                  <option value="2014">2014</option>-->
              </select>
          </span>
      </td>
	  </tr>

	<tr>

	<td height="22" colspan="2" align="left"><h3><span class="style2">*</span>Marks obtained in H.S. or equivalent (10+2) Exams :</h3>

	  <p class="style8"><strong> Do not enter marks of Compulsory Environment Studies/Education/Science in the marks obtained field </strong></p></td>
    </tr><tr>
    
<?php 
	$sub_query=mysql_query("SELECT * FROM `subject_master` WHERE 1");
	while($sub_f=mysql_fetch_array($sub_query)){
		$subid[]=$sub_f["Subject_Id"];
		$subname[]=$sub_f["Subject_Name"];
	}

?>
                   
      <td align="center" colspan="2">

          <table border="0" width="90%" style="border:1px solid #aaa;">

            <tbody>
            <tr>

              <td width="50%" height="39" bgcolor="#C0C0C0"><span class="style3"><b>Subjects</b> (as mentioned in your Mark-Sheet)</span></td>

              <!--?php

              	$query=mysql_query("select title from subjects order by title");

              	$Subjects= Array();

              	while($result = mysql_fetch_array($query,MYSQL_ASSOC)) $Subjects[] = strtoupper($result['title']);

              ?-->

              <td class="mTD" width="26%" height="39" bgcolor="#C0C0C0"><span class="style3"><b>Marks Obtained</b></span></td>

              <td class="mTD" width="24%" height="39" bgcolor="#C0C0C0"><span class="style3"><b>Full Marks</b></span></td>

              <td class="mTD" width="24%" bgcolor="#C0C0C0"><span class="style3"><b>Remarks</b></span></td>
            </tr>

            <tr>

              <td width="50%" height="23" bgcolor="#E0E0E0">
              		<b>1&nbsp;&nbsp;&nbsp;</b>
                    <span class="sTD" id="subject3" style="width:400px;">&nbsp;</span>

                    <span class="sTD" id="subject31" style="width:400px;"></span>
                    
                    <select name="s1" id="s1" style="width:200px;" onChange="checkSubjects(1);" required disabled>
					<option value="">Select Subject</option>
					<?php
                    for($i=0;$i<sizeof($subid);$i++)
                    {

                        $subject1 .= "<option value=\"" . $subid[$i] . "\"";

                            if($subject[0] == $subid[$i])
                            {
                                $subject1 .= " selected ";
                            }

                        $subject1 .= ">" . $subname[$i] . "</option>";

                    }
                    echo $subject1;

                    ?>
               		</select>
              </td>

              <td class="mTD" width="26%" height="23" bgcolor="#E0E0E0"><input type="text" name="m1" id="m1" size="6" maxlength="3" onBlur="checkMarks(1);" disabled="" required
                                                                               value="<?php echo $marksObtained[0]?>"></td>

              <td class="mTD" width="24%" height="23" bgcolor="#E0E0E0"><input type="text" name="full1" id="full1" size="6" maxlength="3" value="100" disabled="" required></td>

              <td class="mTD" width="24%" bgcolor="#E0E0E0">
                  <select name="grade1" id="grade1" required disabled>
                      <?php
                      $selecteGrade1='';
                      if($passFailRemarks[0]=='PASS')
                      {
                        $selecteGrade1 .='<option value="PASS" selected>PASS</option>';
                      }
                      elseif($passFailRemarks[0]=='FAIL')
                      {
                          $selecteGrade1 .='<option value="FAIL" selected>FAIL</option>';
                      }
                      elseif($passFailRemarks[0]=='NA')
                      {
                          $selecteGrade1 .='<option value="NA" selected>NA</option>';
                      }
                      else
                      {
                         $selecteGrade1 .='<option value="" selected="selected">Select</option>';
                      }

                      echo $selecteGrade1;
                      ?>

                   <!-- <option value="" selected="selected">Select</option>

                    <option value="PASS">PASS</option>
                    <option value="FAIL">FAIL</option>
                    <option value="NA">NA</option>-->

                  </select>
              </td>
            </tr>

            <tr>

              <td width="50%" height="19" bgcolor="#E0E0E0">

              		<b>2&nbsp;&nbsp;&nbsp;</b>
					<span class="sTD" id="subject3" style="width:400px;">&nbsp;</span>

                    <span class="sTD" id="subject31" style="width:400px;"></span>
					<select name="s2" id="s2" style="width:200px;" onChange="checkSubjects(2);" required disabled>
                    <option value="">Select Subject</option>
					<?php
                    for($i=0;$i<sizeof($subid);$i++)
                    {
                        $subject2 .= "<option value=\"" . $subid[$i] . "\"";
                        if($subject[1] == $subid[$i])
                        {
                            $subject2 .= " selected ";
                        }
                        $subject2 .= ">" . $subname[$i] . "</option>";
                    }
                    echo $subject2;
                       // echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';
                    ?>
               		</select>

       		  <!--input type="text" name="s2" id="s2" size="42" style="text-transform:uppercase;"-->              </td>

              <td class="mTD" width="26%" height="19" bgcolor="#E0E0E0"><input type="text" name="m2" id="m2" size="6" maxlength="3" onBlur="checkMarks(2);" disabled="" required
                                                                               value="<?php echo $marksObtained[1]?>"></td>

              <td class="mTD" width="24%" height="19" bgcolor="#E0E0E0"><input type="text" name="full2" id="full2" size="6" maxlength="3" value="100" disabled="" required></td>

              <td class="mTD" width="24%" bgcolor="#E0E0E0">
                  <select name="grade2" id="grade2" required disabled>

                      <?php
                      $selecteGrade2='';
                      if($passFailRemarks[1]=='PASS')
                      {
                          $selecteGrade2 .='<option value="PASS" selected>PASS</option>';
                      }
                      elseif($passFailRemarks[1]=='FAIL')
                      {
                          $selecteGrade2 .='<option value="FAIL" selected>FAIL</option>';
                      }
                      elseif($passFailRemarks[1]=='NA')
                      {
                          $selecteGrad2 .='<option value="NA" selected>NA</option>';
                      }
                      else
                      {
                          $selecteGrade2 .='<option value="" selected="selected">Select</option>';
                      }

                      echo $selecteGrade2;
                      ?>
                  </select>
              </td>
            </tr>

            <tr>

              <td width="50%" height="19" bgcolor="#E0E0E0">

              		<b>3&nbsp;&nbsp;&nbsp;</b>

					<span class="sTD" id="subject3" style="width:400px;">&nbsp;</span>

                    <span class="sTD" id="subject31" style="width:400px;"></span>

					<select name="s3" id="s3" style="width:200px;" onChange="checkSubjects(3);" required disabled>
                    <option value="">Select Subject</option>
					<?php
                    for($i=0;$i<sizeof($subid);$i++)
                    {
                        $subject3 .= "<option value=\"" . $subid[$i] . "\"";
                        if($subject[2] == $subid[$i])
                        {
                            $subject3 .= " selected ";
                        }
                        $subject3 .= ">" . $subname[$i] . "</option>";
                    }
                    echo $subject3;
                       // echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';
                    ?>
               		</select>

              		<!--input type="text" name="s3" id="s3" size="42" style="text-transform:uppercase;"-->              </td>

              <td class="mTD" width="26%" height="19" bgcolor="#E0E0E0"><input type="text" name="m3" id="m3" size="6" maxlength="3" onBlur="checkMarks(3);" disabled="" required
                                                                               value="<?php echo $marksObtained[2]?>"></td>

              <td class="mTD" width="24%" height="19" bgcolor="#E0E0E0"><input type="text" name="full3" id="full3" size="6" maxlength="3" value="100" disabled="" required></td>

              <td class="mTD" width="24%" bgcolor="#E0E0E0">
                  <select name="grade3" id="grade3" required disabled>
                      <?php
                      $selecteGrade3='';
                      if($passFailRemarks[2]=='PASS')
                      {
                          $selecteGrade3 .='<option value="PASS" selected>PASS</option>';
                      }
                      elseif($passFailRemarks[2]=='FAIL')
                      {
                          $selecteGrade3 .='<option value="FAIL" selected>FAIL</option>';
                      }
                      elseif($passFailRemarks[2]=='NA')
                      {
                          $selecteGrad3 .='<option value="NA" selected>NA</option>';
                      }
                      else
                      {
                          $selecteGrade3 .='<option value="" selected="selected">Select</option>';
                      }

                      echo $selecteGrade3;
                      ?>

                  </select>
              </td>
            </tr>

            <tr>

              <td width="50%" height="19" bgcolor="#E0E0E0">

              		<b>4&nbsp;&nbsp;&nbsp;</b>

					<span class="sTD" id="subject4" style="width:400px;">&nbsp;</span>

                    <span class="sTD" id="subject41" style="width:400px;"></span>

					<select name="s4" id="s4" style="width:200px;" onChange="checkSubjects(4);" required disabled>
                    <option value="">Select Subject</option>
					<?php
                    for($i=0;$i<sizeof($subid);$i++)
                    {
                        $subject4 .= "<option value=\"" . $subid[$i] . "\"";
                        if($subject[3] == $subid[$i])
                        {
                            $subject4 .= " selected ";
                        }
                        $subject4 .= ">" . $subname[$i] . "</option>";
                    }
                    echo $subject4;
                       // echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';
                    ?>
               		</select>              </td>

              <td class="mTD" width="26%" height="19" bgcolor="#E0E0E0"><input type="text" name="m4" id="m4" size="6" maxlength="3" onBlur="checkMarks(4);" disabled="" required
                                                                               value="<?php echo $marksObtained[3]?>"></td>

              <td class="mTD" width="24%" height="19" bgcolor="#E0E0E0"><input type="text" name="full4" id="full4" size="6" maxlength="3" value="100" disabled="" required></td>

              <td class="mTD" width="24%" bgcolor="#E0E0E0">
                  <select name="grade4" id="grade4" required disabled>

                      <?php
                      $selecteGrade4='';
                      if($passFailRemarks[3]=='PASS')
                      {
                          $selecteGrade4 .='<option value="PASS" selected>PASS</option>';
                      }
                      elseif($passFailRemarks[3]=='FAIL')
                      {
                          $selecteGrad4 .='<option value="FAIL" selected>FAIL</option>';
                      }
                      elseif($passFailRemarks[3]=='NA')
                      {
                          $selecteGrad4 .='<option value="NA" selected>NA</option>';
                      }
                      else
                      {
                          $selecteGrade4 .='<option value="" selected="selected">Select</option>';
                      }

                      echo $selecteGrade4;
                      ?>

                      </select>
                  </td>
            </tr>

            <tr>

              <td width="50%" height="19" bgcolor="#E0E0E0">

              		<b>5&nbsp;&nbsp;&nbsp;</b>

					<span class="sTD" id="subject5" style="width:400px;">&nbsp;</span>

                    <span class="sTD" id="subject51" style="width:400px;"></span>
					<select name="s5" id="s5" style="width:200px;" onChange="checkSubjects(5);" required disabled>
                    <option value="">Select Subject</option>
					<?php
                    for($i=0;$i<sizeof($subid);$i++)
                    {
                        $subject5 .= "<option value=\"" . $subid[$i] . "\"";
                        if($subject[4] == $subid[$i])
                        {
                            $subject5 .= " selected ";
                        }
                        $subject5 .= ">" . $subname[$i] . "</option>";
                    }
                    echo $subject5;
                    //echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';?>
               		</select> </td>

              <td class="mTD" width="26%" height="19" bgcolor="#E0E0E0"><input type="text" name="m5" id="m5" size="6" maxlength="3" onBlur="checkMarks(5);" disabled="" required
                                                                               value="<?php echo $marksObtained[4]?>"></td>

              <td class="mTD" width="24%" height="19" bgcolor="#E0E0E0"><input type="text" name="full5" id="full5" size="6" maxlength="3" value="100" disabled="" required></td>

              <td class="mTD" width="24%" bgcolor="#E0E0E0">
                  <select name="grade5" id="grade5" required disabled>

                      <?php
                      $selecteGrade5='';
                      if($passFailRemarks[4]=='PASS')
                      {
                          $selecteGrade5 .='<option value="PASS" selected>PASS</option>';
                      }
                      elseif($passFailRemarks[4]=='FAIL')
                      {
                          $selecteGrad5 .='<option value="FAIL" selected>FAIL</option>';
                      }
                      elseif($passFailRemarks[4]=='NA')
                      {
                          $selecteGrad5 .='<option value="NA" selected>NA</option>';
                      }
                      else
                      {
                          $selecteGrade5 .='<option value="" selected="selected">Select</option>';
                      }

                      echo $selecteGrade5;
                      ?>

                  </select>
              </td>
            </tr>

            <tr>

              <td width="50%" height="19" bgcolor="#E0E0E0">

              		<b>6&nbsp;&nbsp;&nbsp;</b>

					<span class="sTD" id="subject6" style="width:400px;">&nbsp;</span>

                    <span class="sTD" id="subject61" style="width:400px;"></span>

					<select name="s6" id="s6" style="width:200px;" onChange="checkSubjects(6);" required disabled>
                    <option value="">Select Subject</option>
					<?php
                    for($i=0;$i<sizeof($subid);$i++)
                    {
                        $subject6 .= "<option value=\"" . $subid[$i] . "\"";
                        if($subject[5] == $subid[$i])
                        {
                            $subject6 .= " selected ";
                        }
                        $subject6 .= ">" . $subname[$i] . "</option>";
                    }
                    echo $subject6;
                       // echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';
                    ?>
                    </select> </td>

              <td class="mTD" width="26%" height="19" bgcolor="#E0E0E0"><input type="text" name="m6" id="m6" size="6" maxlength="3" onBlur="checkMarks(6);" disabled="" required
                                                                               value="<?php echo $marksObtained[5]?>"></td>

             <td class="mTD" width="24%" height="19" bgcolor="#E0E0E0"><input type="text" name="full6" id="full6" size="6" maxlength="3" value="100" disabled="" required></td>

             <td class="mTD" width="24%" bgcolor="#E0E0E0">
                 <select name="grade6" id="grade6" required disabled>
                     <?php
                     $selecteGrade6='';
                     if($passFailRemarks[5]=='PASS')
                     {
                         $selecteGrade6 .='<option value="PASS" selected>PASS</option>';
                     }
                     elseif($passFailRemarks[5]=='FAIL')
                     {
                         $selecteGrad6 .='<option value="FAIL" selected>FAIL</option>';
                     }
                     elseif($passFailRemarks[5]=='NA')
                     {
                         $selecteGrad6 .='<option value="NA" selected>NA</option>';
                     }
                     else
                     {
                         $selecteGrade6 .='<option value="" selected="selected">Select</option>';
                     }

                     echo $selecteGrade6;
                     ?>
                 </select>
             </td>
            </tr>
          </tbody></table>      </td>

   </tr>
   
   
   

    <tr>

      <td colspan="2"><span class="style8"><span class="style6"><span id="chkStatusText">Total Marks of Top Five Subjects</span>

          <input type="text" name="m12" id="m12" size="6" maxlength="3" readonly="" onBlur="checkMarks(1);" value="<?php echo $totalMarks; ?>">
           
	&nbsp;<span id="best4"><b>out of 500</b></span>
    &nbsp;&nbsp;<span id="best4" style="visibility: hidden;"></span></span></td>
    </tr>
    
        
</tbody></table>
     <div style="width:100%;" align="center">
              <br /><br /><br />
              
              <table width="50%">
              <tr>
                  <td id="button_Panel">
                      
                      <?php 
                      //Flag 1 - DRAFT
                      if($row_query['flag'] == 1){  ?>
                      
                      <p>Request you to pay the Application Fee of Rs. 100/= to SBI Brach AC:123445671889 and then Click on Submit Button below</p>
                      <input type="button" id="submit_button" onclick="changeUserFlag(2,<?=$row_query['id']?>)" value="CONFIRM APPLICATION" />
                      <?php } else if($row_query['flag'] == 2){ 
                     
                        echo "Thank you for Submitting your Application for Chandidas College. Kindly wait for the Merit List for result.";
                     } else if($row_query['flag'] == 3){ ?>
                      <p>Request you to pay the Admission Fee of 
                          <?php echo "Rs. 1200/="?> to SBI Brach AC:123445671889 and then Click on Accept Admission Button below. Note: Once admitted in a suject all other combination stands cancelled</p>
 
                      <input type="button" id="submit_button" onclick="changeUserFlag(4,<?=$row_query['id']?>)" value="ACCEPT ADMISSION" />
                          <?php }else if($row_query['flag'] == 4){ ?>
                      <p>Confirm Student's Admission</p>
                      
                      <input type="button" id="submit_button" onclick="changeUserFlag(5,<?=$row_query['id']?>)" value="CONIRM ADMISSION" />
                      <?php }
                      ?>
                      
                  </td>
                  <td>
                      <!-- Cancel at any given point in time -->
                      
                  </td>
              </tr>
              </table>
              </div>
  <table width="870" border="0">

    <!-- ************************************************** -->



    <tbody><tr id="p1" style="display:none">



      <td width="139">&nbsp;</td>



      <td width="653">&nbsp;</td>



    </tr>



  </tbody></table>

  <br>

<br>

<br><hr><br><center>

<?php /*?><input type="checkbox" id="iV" name="iV" value="1" onChange="show_submit();" required><label for="iV"><font size="4"> I confirm that all the values entered are correct<?php */?></font></label>

<br><br>
<?php /*?><span id="showsubmit" style="visibility:visible">

<input type="submit" value="Submit" name="submit" id="submit" class="Submit_reset" >

<input name="reset" type="reset" value="Reset" id="reset" class="Submit_reset" onClick="hide_submit()"></span>


<?php */?>


</center>

</center>

</form>

</body></html>