<?php
include"top.php";
include"header.php";
include "../../classes/admin_class.php";

$admin = new admin_class();
?>

<?php
if($_REQUEST['action']=='view'){
   
        
        $id = $_REQUEST[id];
//print_r($details);
?>
<script src="../../jquery-ui-1.11.3/external/jquery/jquery.js"></script>
<script>


function changeUserFlag(inputFlag, id){
    //Call Ajax
    //alert(inputFlag);
    //alert(id);
    
    $("#button_Panel").load("ajax/change_Application_Status.php?flag="+inputFlag+"&id="+id,function(responseTxt,statusTxt,xhr){
		  if(statusTxt=="success"){
                        //alert(responseTxt);
			document.getElementById("button_Panel").innerHTML=responseTxt;
			
			}else if(statusTxt=="error"){
				alert("Error: "+xhr.status+": "+xhr.statusText);
			}
		});

}
</script>
<input type="hidden" name="id" id="id" value="<?=$_REQUEST['id']?>" />
<?php
    $admin = new admin_class();
    $details=$admin->getApplicationDetailsById($id);
?>

 <center>
      
     <table border="1" width="750 px;">

	<tbody>

	<tr >

		<td colspan="4" >

                    <font size="5"><b>Application Number # <?php echo $details->Application_No;?></b>&nbsp;&nbsp;&nbsp;
                    (<?php echo $details->Course_Level_Name. ' - '. $details->Course_Name;?>)
		</font>		</td>
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
    <tr>
        <td id="button_Panel" colspan="4">
                      
                      <?php 
                      //Flag 1 - DRAFT
                      if($details->flag == 1){  ?>
                      
                      <p>Request you to pay the Application Fee of <?php echo $admin->getConstant("APPLICATION_FEE") ?> to <?php echo $admin->getConstant("BANK_NAME") ?> <?php echo $admin->getConstant("BRANCH_ACCOUNT") ?></p>
                      <input type="button" id="submit_button" onclick="changeUserFlag(2,<?=$details->id?>)" value="CONFIRM APPLICATION" />
                      <?php } else if($details->flag == 2){ 
                     
                        echo "Thank you for Submitting your Application for Chandidas College. Kindly wait for the Merit List for result.";
                     } else if($details->flag == 3){ 
                      $admissionFee = $admin->getApplicationFeeByCourseIdAndCourseLevelId($details->course_id, $details->course_level_id); ?>
                      <p>Request you to pay the Admission Fee for Rs. 
                          <?php echo $admissionFee->TOTAL_FEE ?> to <?php echo $admin->getConstant("BANK_NAME") ?> <?php echo $admin->getConstant("BRANCH_ACCOUNT") ?> and then Click on Accept Admission Button below. Note: Once admitted in a suject all other combination stands cancelled</p>
 
                      <input type="button" id="submit_button" onclick="changeUserFlag(4,<?=$details->id?>)" value="ACCEPT ADMISSION" />
                          <?php }
                      ?>
                      
                  </td>
                  
              </tr>
              <tr><td colspan="4" style="text-align: center;">
                      <a href="my_applications.php" >BACK</a>
                      
                  </td></tr>
</tbody>
  </table>

<?php
}
include "footer.php";
?>	