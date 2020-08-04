<?php 

include "../classes/config.php";
include "../classes/conn.php";
include "../classes/admin_class.php";
$applicaion_num = $_GET['application_num'];
if($_SESSION['adminid'] == "1"){
	$admin = new admin_class();
	//$imagelinks=$admin->getAppAttachmentDetails($applicaion_num);
?>
<html><head>

<link type="text/css" rel="stylesheet" href="calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
<script type="text/javascript" src="calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<script type="text/javascript" src="../jquery-ui-1.11.3/external/jquery/jquery.js"></script>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">

<title>Application Form</title>

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
img {
    max-width: 100%;
    max-height: 100%;
}
</style>

</head>

<body style="font-family: sans-serif;margin: 0px;">
<?php
    $admin = new admin_class();
    $details=$admin->getApplicationDetails($applicaion_num);
	$paymentdetails=$admin->getPaymentDetails($applicaion_num);
?>

 <center>
      <div id="print">
     <table border="1" width="750 px;">

	<tbody><tr>

	  <td height="73" colspan="4">
      <?php
      $cdata=$admin->getCollegeDetails();
	  ?>
      <div align="center">
<table width="100%">
<TR>
    <td width="10%"><img src="<?=$cdata->logo;?>" width="112" height="108"></td>
    <td width="90%" align="center" style="font-family:Georgia, 'Times New Roman', Times, serif" >
    <font size="+3">
    <?php 
    echo $cdata->name;
    ?>
    </font>
    <br>
    <?=$cdata->address;?>

    </td>
    <td width="10%"></td>
</TR>

</table>

</div>

</td>
	  </tr>

	<tr ><font size="4">

		<td colspan="2" >

                    <b>Application Number # <?php echo $details->Application_No;?></b>&nbsp;&nbsp;&nbsp;
                    (<?php echo $details->Course_Level_Name. ' - '. $details->Course_Name;?>)
				</td>
		<td>Marks Obtained</td>
		<td> <b><?php echo $details->Total_Marks ; ?></td></font>
	</tr><tr>


		<td width="25%" class="sTD">Name</td>

		<td width="30%" class="sTD"><?php echo $details->fname. ' '.$details->lname; ?></td>
                <td class="sTD">Mobile Number</td>

		<td class="sTD"> <?php echo $details->mobile; ?></td>

	</tr><tr>
            <tr>
                

	</tr><tr>
		<td><label>Guardian's Name</label></td>
                <td><?php echo $details->Gurdian_Name; ?></td>
                <td><label>Relation</label></td>
		<td><?php echo $details->Gurdian_Relation; ?></td>
	</tr>

	<tr>

          <td class="sTD">Occupation</td>

	  <td class="sTD"><?php echo $details->occu; ?> </td>
          <td class="sTD">Monthly Income </td>

	  <td class="sTD"><?php echo $details->income; ?></td>
	</tr>

	<tr>

	  <td>Gender</td>

	  <td><?php echo $details->Gender; ?></td>
          <td>Category</td>

	  <td><?php echo $details->Category; ?></td>
	  </tr>

	<!--<tr>

	  <td><span class="style2">*</span>Date of Birth</td>

	  <td><span class="sTD"><br>

	    <input type="text" value="" required="required" name="theDate" id="theDate" placeHolder=" DD/MM/YYYY" pattern="\d{1,2}/\d{1,2}/\d{4}"><input type="button" value="Calendar" onClick="displayCalendar(document.forms[0].theDate,'dd/mm/yyyy',this)">

	  </span></td>
	  </tr>-->

	<tr>

	  <td class="sTD">Category</td>

	  <td class="sTD"><?php echo $details->Category; ?></td>
          <td class="sTD">Physically Challenged</td>
	  <td class="sTD"><?php echo $details->Physically_Challenged; ?></td>
        </tr>

	<tr>
	  
	  </tr>
	<tr>
	  <td>Religion</td>
	  <td><?php echo $details->Religion; ?></td>
          <td>Nationality</td>

	  <td><?php echo $details->Nationality; ?></td>
	  </tr>
	

	<tr>
            

      <td class="sTD"><label>Present Address </label></td>

      <td class="sTD" colspan="3"><?php echo $details->Address ;?>, <?php echo $details->district_name; ?>, <?php echo  $details->ZIP_PIN ; ?>,
          
	    <?php echo $details->state_name; ?>, <?php echo $details->Country ;?>

	  </td>
	</tr>
        <tr>

      <td>Email Address </td>

      <td colspan="3"><?php echo $details->email; ?></td>
	  </tr>
    
    
    
    <tr>
                 
      <td align="center" colspan="4">

          <table border="0" width="100%" style="border:1px solid #aaa;">

            <tbody><tr>
              <td width="23%" height="39" bgcolor="#C0C0C0"><span class="style3"><b>Board</span></td>      
              <td width="31%" height="39" bgcolor="#C0C0C0"><span class="style3"><b>Subjects</b> (as mentioned in your Mark-Sheet)</span></td>


              <td class="mTD" width="14%" height="39" bgcolor="#C0C0C0"><span class="style3"><b>Marks Obtained</b></span></td>
              <td class="mTD" width="12%" height="39" bgcolor="#C0C0C0"><span class="style3"><b>Full Marks</b></span></td>

             
            </tr>
 <?php $appNo=$details->Application_No;
    $user_id = $details->user_id;
 $query2 = "SELECT b.Subject_Name, a.Marks_Obtained, a.Full_Marks, a.Pass_Fail_Remarks, a.Board, a.Roll_Index_No, a.Year_of_Passing"
                . " FROM academic_details a, subject_master b WHERE a.`user_id`='$user_id' and a.subject = b.subject_Id";
       
         $marksQuery1=mysql_query($query2) or die(mysql_error());

	while($marks_details_form=mysql_fetch_array($marksQuery1)){
            $board = $marks_details_form['Board'];
            $year_of_pass = $marks_details_form['Year_of_Passing'];
            $roll_num = $marks_details_form['Roll_Index_No'];
?>
            <tr>
                <td height="23" bgcolor="#E0E0E0"><?php echo $marks_details_form['Board']; ?></td>
              <td height="23" bgcolor="#E0E0E0">
                  <?php echo $marks_details_form['Subject_Name']; ?>
              		</td>

              <td class="mTD" width="26%" height="23" bgcolor="#E0E0E0">
                  <?php echo $marks_details_form['Marks_Obtained']; ?>
              </td>
              <td class="mTD" width="26%" height="23" bgcolor="#E0E0E0">
                  <?php echo $marks_details_form['Full_Marks']; ?>
              </td>
            </tr>
        <?php } ?>
                
          </tbody></table></td>
	  <tr>
      <td>Passport Size Photograph </td>
      <td colspan="3">&emsp;<a class="thumb" href="#"><img src="images/imgicon.png" alt=""/><span><img src="data:image/png;base64,<?=base64_encode(file_get_contents('./pg/ulasset/'.$admin->getAppAttachmentDetails($user_id, 2))) ?>" alt=""/></span></a></i></td>
	  </tr>
	   <tr>
      <td>Date of birth proof </td>
      <td colspan="3">&emsp;<a class="thumb" href="#"><img src="images/imgicon.png" alt=""/><span><img src="data:image/png;base64,<?=base64_encode(file_get_contents('./pg/ulasset/'.$admin->getAppAttachmentDetails($user_id, 1))) ?>" alt=""/></span></a></i></td>
	  </tr>
	  <?php
	  if(!empty($admin->getAppAttachmentDetails($user_id, 5))){
	  ?>
	   <tr>
      <td>Caste Certificate </td>
      <td colspan="3">&emsp;<a class="thumb" href="#"><img src="images/imgicon.png" alt=""/><span><img src="data:image/png;base64,<?=base64_encode(file_get_contents('./pg/ulasset/'.$admin->getAppAttachmentDetails($user_id, 5))) ?>" alt=""/></span></a></i></td>
	  </tr>
	   <?php
	   }
	   ?>
	   <?php
	  if(!empty($admin->getAppAttachmentDetails($user_id, 8))){
	  ?>
	  <tr>
      <td>Disability Certificate </td>
      <td colspan="3">&emsp;<a class="thumb" href="#"><img src="images/imgicon.png" alt=""/><span><img src="data:image/png;base64,<?=base64_encode(file_get_contents('./pg/ulasset/'.$admin->getAppAttachmentDetails($user_id, 8))) ?>" alt=""/></span></a></i></td>
	  </tr>
	  <?php
	   }
	   ?>
	  <tr>
      <td>10<sup>th</sup> Marksheet </td>
      <td colspan="3">&emsp;<a class="thumb" href="#"><img src="images/imgicon.png" alt=""/><span><img src="data:image/png;base64,<?=base64_encode(file_get_contents('./pg/ulasset/'.$admin->getAppAttachmentDetails($user_id, 3))) ?>" alt=""/></span></a></i></td>
	  </tr>
	  <tr>
      <td>12<sup>th</sup> Marksheet </td>
      <td colspan="3">&emsp;<a class="thumb" href="#"><img src="images/imgicon.png" alt=""/><span><img src="data:image/png;base64,<?=base64_encode(file_get_contents('./pg/ulasset/'.$admin->getAppAttachmentDetails($user_id, 4))) ?>" alt=""/></span></a></i></td>
	  </tr>
     <?php
          $flag_val=$details->flag;
          $apl_challan= $admin->getApplAdmChallanDetails($details->Application_No, 6);
          if(($flag_val==2|| $flag_val==3 || $flag_val==4||$flag_val==5) && strlen($apl_challan->doc_name) != 0){
    //  echo $admin->getApplAdmChallanDetails($details->Application_No, 7);
          ?>
          <tr>
      <td>Application Challan Scan Copy</td>
      <td colspan="3">&emsp;<a class="thumb" href="#"><img src="images/imgicon.png" alt=""/><span><img src="data:image/png;base64,<?=base64_encode(file_get_contents('../pg/ulasset/'.$apl_challan->doc_name)) ?>" alt=""/></span></a></i></td>
          </tr>
       <?php }?>      
       <?php
         // $flag_val=$details->flag;
          $adm_challan= $admin->getApplAdmChallanDetails($details->Application_No, 7);
          if(($flag_val==3 || $flag_val==4||$flag_val==5) && strlen($adm_challan->doc_name) != 0){
    //  echo $admin->getApplAdmChallanDetails($details->Application_No, 7);
          ?>
          <tr>
      <td>Admisson Challan Scan Copy</td>
      <td colspan="3">&emsp;<a class="thumb" href="#"><img src="images/imgicon.png" alt=""/><span><img src="data:image/png;base64,<?=base64_encode(file_get_contents('../pg/ulasset/'.$adm_challan->doc_name)) ?>" alt=""/></span></a></i></td>
          </tr>
          <?php
          }
          ?> 

    </tr> 
</tbody>
  </table>
</div>
<table  border="1" width="750 px;">
  <tbody><tr><tr>
  <?php if($details->Doc_verified=='1'){
	  ?>
  <td width="66%" align="center">Verified Valid Application</td> <?php }elseif($details->Doc_verified=='0'){?>
  <td width="66%" align="center">Verified Invalid Application</td>
  <?php }else{ ?>
	<td width="33%" align="center"><?php if($details->Doc_verified==null){?><button onClick="verifySuccess()" align="center">Mark Valid</button>
	<?php } ?>
	</td>
	<td width="33%" align="center"><?php if($details->Doc_verified==null){?><button onClick="verifyFailed()"  align="center">Mark Invalid</button>
	<?php } ?>
	</td>
	<?php } ?>
    <td width="33%" align="center"><button onClick="printpage()"  align="center">Print</button></td>
	</tr>
  </tr>
</tbody></table>
</center>
    
<script>

function printpage()
{ 
  var disp_setting="toolbar=no,location=no,directories=yes,menubar=no,"; 
      disp_setting+="scrollbars=yes, width=900, height=600, resize=yes"; 
  var content_vlue = document.getElementById("print").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>Application For Admission</title>');
   docprint.document.write('</head><body onLoad="self.print()">');          
   docprint.document.write(content_vlue);          
   docprint.document.write('</body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}
function verifySuccess()
{
$.ajax({
        url: "data_verification_processor.php",
        type: "post",
        data: {verification_success:true,verification_failed:false,app_no:<?php echo $applicaion_num;?>} ,
        success: function (response) {
           alert(response);
		   window.location.reload();

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
}
function verifyFailed()
{
$.ajax({
        url: "data_verification_processor.php",
        type: "post",
        data: {verification_success:false,verification_failed:true,app_no:<?php echo $applicaion_num;?>} ,
        success: function (response) {
           alert(response);        
		   window.location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
}
</script>
</body></html>
<?php 
}else{
	header('Location: /online-admission/admin/login.php');
}
?>
