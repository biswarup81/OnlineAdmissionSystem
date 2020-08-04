<?php 

include "../classes/config.php";
include "../classes/conn.php";
include "../classes/admin_class.php";
$applicaion_num = $_GET['application_num'];

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

		<td width="30%" class="sTD"><?php echo $details->First_Name. ' '.$details->Last_Name; ?></td>
                <td class="sTD">Mobile Number</td>

		<td class="sTD"> <?php echo $details->Gurdian_Mobile_No ; ?></td>

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
 $query2 = "SELECT b.Subject_Name, a.Marks_Obtained, a.Full_Marks, a.Pass_Fail_Remarks, a.Board, a.Roll_Index_No, a.Year_of_Passing"
                . " FROM applicaion_marks a, subject_master b WHERE a.`Application_No`='$appNo' and a.subject = b.subject_Id";
       
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
                
          </tbody></table>      </td>

    </tr> 
	
	<tr><td colspan="4" align="center">PAYMENT DETAILS</td></tr>
	<tr>
            

      <td class="sTD"><label>AC Name : KANDRA RADHAKANTA KUNDU MAHAVIDYALAYA</label></td>
	  
	  <td class="sTD"><label>AC Number:<br/>SBI - 11782685061<br/>ICICI - 271001000058</label></td>
	  <td align='left'>Rs. 200/= (Bank Charges Extra)</td>
	  <td align='left'>Date</td>
	</tr>
    <tr>

        <td height="40" colspan="4" style="text-align: center; ">ONLINE ADMISSION SYSTEM - <?php echo $cdata->name; ?></td>
	  </tr>
</tbody>
  </table>
</div>
    <button onClick="printpage()">PRINT</button>
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
</script>



</body></html>