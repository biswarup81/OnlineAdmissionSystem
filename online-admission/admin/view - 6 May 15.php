<?php
include"top.php";
include"header.php";
?>

<?php
if($_REQUEST['action']=='view'){
    $result = mysql_query("select a.id,a.Application_No,a.password,a.Application_Fee,a.Demand_Draft_No,a.First_Name,a.Middle_Name,a.Last_Name,a.Gurdian_Name,a.Gurdian_Mobile_No,a.Gurdian_Relation,
        a.Other_Relation,a.occu,a.other_occu,a.desi,a.income,a.Gender,a.Date_Of_Birth,a.Category,a.Physically_Challenged,a.Religion,a.other_religion,a.Nationality,
        a.Address,a.ZIP_PIN,a.Address_1,a.pin2,a.Address_2,a.Country,a.Mobile,a.Land_Phone_No,a.email,a.Total_Marks,a.Bank_Payment_Verified,a.admit,a.course_id,
        a.course_level_id,a.session_id,a.submit_date,a.flag,a.state,a.district, b.Course_Level_Name, c.Course_Name 
	from application_table a, course_level b, course_table c
	where a.course_level_id = b.Course_Level_Id and a.course_id = c.courseId and a.id='".$_REQUEST[id]."'")or die(mysql_error());
    
	$details=mysql_fetch_array($result ); 
//print_r($details);
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
function cancel_approve_bt()
{
	if(confirm('cancle Approve Now?'))
	{	
		$("#cancel_approve").load("ajax/bank_approve_cancel.php?id="+$("#id").val(),function(responseTxt,statusTxt,xhr){
		  if(statusTxt=="success"){
			document.getElementById("approve_chk").innerHTML='<input class="form_button" type="submit" name="approve" id="approve" value="Approve" onclick="return approve_bt()" />';
			document.getElementById("cancel_approve").innerHTML='<input class="form_button" type="submit" name="cancel" id="cancel" value="Cancel" style="background-color:#666;border:#333" disabled/>';
			document.getElementById("admit_chk").innerHTML='<input class="form_button" type="submit" name="admit" id="admit" value="Admit" style="background-color:#666;border:#333" disabled/>';
		  }else if(statusTxt=="error")
			alert("Error: "+xhr.status+": "+xhr.statusText);
		});	
	}

}

function approve_bt()
{
	if(confirm('Approve Now?'))
	{	
		$("#approve_chk").load("ajax/bank_approve.php?id="+$("#id").val(),function(responseTxt,statusTxt,xhr){
		  if(statusTxt=="success"){
			document.getElementById("approve_chk").innerHTML='<input class="form_button" type="submit" name="approve" id="approve" value="Approve" style="background-color:#666;border:#333" disabled/>';
			//document.getElementById("admit_chk").innerHTML='<input class="form_button" type="submit" name="admit" id="admit" value="Admit" onclick="return admit_bt();"/>';
			document.getElementById("cancel_approve").innerHTML='<input class="form_button" type="submit" name="cancel" id="cancel" value="Cancel" onclick="return cancel_approve_bt()"/>';
		  }else if(statusTxt=="error")
			alert("Error: "+xhr.status+": "+xhr.statusText);
		});	
	}

}

function admit_bt()
{
	if(confirm('Admit Now?'))
	{	
		$("#admit_chk").load("ajax/admit.php?id="+$("#id").val(),function(responseTxt,statusTxt,xhr){
		  if(statusTxt=="success"){
			document.getElementById("admit_chk").innerHTML='<input class="form_button" type="submit" name="admit" id="admit" value="Admit" style="background-color:#666;border:#333" disabled/>';
			document.getElementById("cancel_approve").innerHTML='<input class="form_button" type="submit" name="cancel" id="cancel" value="Cancel" style="background-color:#666;border:#333" disabled/>';
			}else if(statusTxt=="error"){
				alert("Error: "+xhr.status+": "+xhr.statusText);
			}
		});	
	}

}

function changeFlag(inputFlag, id){
    //Call Ajax
    alert(inputFlag);
    alert(id);
    
    $("#button_Panel").load("ajax/change_Application_Status.php?flag="+inputFlag+"&id="+id,function(responseTxt,statusTxt,xhr){
		  if(statusTxt=="success"){
                        alert(responseTxt);
			document.getElementById("button_Panel").innerHTML=responseTxt;
			
			}else if(statusTxt=="error"){
				alert("Error: "+xhr.status+": "+xhr.statusText);
			}
		});

}
</script>
<input type="hidden" name="id" id="id" value="<?=$_REQUEST['id']?>" />
<table cellpadding="0" cellspacing="0" width="100%" align="center" border="0" >			
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%" align="left">
				  <td width="40%" class="caption">: View Deails of <?=strtoupper($details['First_Name'])." (".$details['Application_No'].")"?></td>
				    <td class="endcap"></td>
				<td style="padding-left:10px;" align="right"></td>
				<td align="left"></td>
			</table>
		</td>
	</tr> 
    <tr>
    	<td class="mainarea">
        	<table width="100%">
                <tr>
                    <td>First Name</td><td>:</td><td><?=$details['First_Name']?></td>
                </tr>
                <tr>
                    <td>Middle Name</td><td>:</td><td><?=$details['Middle_Name']?></td>
                </tr>
                <tr>
                    <td>Last Name</td><td>:</td><td><?=$details['Last_Name']?></td>
                </tr>
                <tr>
                    <td>Guardian's Name</td><td>:</td><td><?=$details['Gurdian_Name']?></td>
                </tr>
                <tr>
                    <td>Gender</td><td>:</td><td><?=$details['Gender']?></td>
                </tr>
                <tr>
                    <td>Date of Birth</td><td>:</td><td><?=$details['Date_Of_Birth']?></td>
                </tr>
                <tr>
                    <td>Category</td><td>:</td><td>
                    <?php
                    /*if(*/echo $details['Category'];/*=='GEN'){
                    echo "General";
                    }*/
                    ?></td>
                </tr>
                
                
                
                
                
                
                
                
                 <tr>
                    <td>Application Fee</td><td>:</td><td><?=$details['Application_Fee']?></td>
                </tr>
                <tr>
                    <td>Demand Draft No</td><td>:</td><td><?=$details['Demand_Draft_No']?></td>
                </tr>

                <tr>
                    <td>Gurdian Mobile No</td><td>:</td><td><?=$details['Gurdian_Mobile_No']?></td>
                </tr>
                <tr>
                    <td>Gurdian Relation</td><td>:</td><td><?=$details['Gurdian_Relation']?></td>
                </tr>
                <tr>
                    <td>Other Relation</td><td>:</td><td><?=$details['Other_Relation']?></td>
                </tr>
                <tr>
                    <td>Occupation</td><td>:</td><td><?=$details['occu']?></td>
                </tr>
                <tr>
                    <td>Other Occupation</td><td>:</td><td><?=$details['other_occu']?></td>
                </tr>
                <tr>
                    <td>Desi</td><td>:</td><td><?=$details['desi']?></td>
                </tr>
                <tr>
                    <td>Income</td><td>:</td><td><?=$details['income']?></td>
                </tr>
                <tr>
                    <td>Physically Challenged</td><td>:</td><td><?=$details['Physically_Challenged']?></td>
                </tr>
                <tr>
                    <td>Religion</td><td>:</td><td><?=$details['Religion']?></td>
                </tr>
                <tr>
                    <td>Other Religion</td><td>:</td><td><?=$details['other_religion']?></td>
                </tr>
                <tr>
                    <td>Nationality</td><td>:</td><td><?=$details['Nationality']?></td>
                </tr>

                <tr>
                    <td>Address</td><td>:</td><td><?=$details['Address']?></td>
                </tr>

                <tr>
                    <td>ZIP PIN</td><td>:</td><td><?=$details['ZIP_PIN']?></td>
                </tr>
                <tr>
                    <td>Address 1</td><td>:</td><td><?=$details['Address_1']?></td>
                </tr>
                <tr>
                    <td>Pin 2</td><td>:</td><td><?=$details['pin2']?></td>
                </tr>

                <tr>
                    <td>Address 2</td><td>:</td><td><?=$details['Address_2']?></td>
                </tr>
                <tr>
                    <td>Country</td><td>:</td><td><?=$details['Country']?></td>
                </tr>

                <tr>
                    <td>Mobile</td><td>:</td><td><?=$details['Mobile']?></td>
                </tr>
                <tr>
                    <td>Land Phone No</td><td>:</td><td><?=$details['Land_Phone_No']?></td>
                </tr>
                <tr>
                    <td>Email</td><td>:</td><td><?=$details['email']?></td>
                </tr>
                <tr>
                    <td>Total Marks</td><td>:</td><td><?=$details['Total_Marks']?></td>
                </tr>
                <tr>
                    <td>Bank Payment Verified</td><td>:</td><td><?=$details['Bank_Payment_Verified']?></td>
                </tr>

                <tr>
                    <td>Admit</td><td>:</td><td><?=$details['admit']?></td>
                </tr>
                <tr>
                    <td>Course Id</td><td>:</td><td><?=$details['Course_Name']?></td>
                </tr>
                <tr>
                    <td>Course Level Id</td><td>:</td><td><?=$details['Course_Level_Name']?></td>
                </tr>
                <tr>
                    <td>Submit Date</td><td>:</td><td><?=$details['submit_date']?></td>
                </tr>
                <tr>
                    <td>Marks</td><td>:</td><td>
			<table width='100%'>
                        <tr align='center'>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        </tr>
                        <tr align='center'>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        </tr>
                        <tr align='center'>
                        <td align='left'><strong>Subject</strong></td><td><strong>Marks Obtain</strong></td><td><strong>Full Marks</strong></td><td><strong>Status</strong></td>
                        </tr>
                       <?php             
                         $appNo=$details['Application_No'];
			 $marksQuery1=mysql_query("SELECT * FROM `applicaion_marks` WHERE `Application_No`='$appNo'");
			 while($marks_details_form=mysql_fetch_array($marksQuery1)){
			echo "<tr align='center'>";
                        $subjtName=$marks_details_form['Subject'];
                        $subjtNameF=mysql_fetch_array(mysql_query("SELECT * FROM `subject_master` WHERE `Subject_Id`='$subjtName'"));	
                        echo "<td align='left'>".$subjtNameF['Subject_Name']."</td>";
                        echo "<td>".$marks_details_form['Marks_Obtained']."</td>";
                        echo "<td>".$marks_details_form['Full_Marks']."</td>";
                        echo "<td>".$marks_details_form['Pass_Fail_Remarks']."</td>";
                        echo "</tr>"; 
			}	
                        ?>
                      <tr align='center'>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        </tr>
                      
                     </table><strong>Total Marks</strong> : <?=$details['Total_Marks']?>
			</td>
                </tr>
                
              </table>


              <div style="width:100%;" align="center">
              <br /><br /><br />
              <table width="50%">
              <tr>
              	<td>
                <span id="admit_chk">
                <?php if($details['Bank_Payment_Verified']=='0' ||$details['admit']!=2){?>
                <input class="form_button" type="submit" name="admit" id="admit" value="Admit" style="background-color:#666;border:#333" disabled/>
                <?php }else{?>
                <input class="form_button" type="submit" name="admit" id="admit" value="Admit" onclick="return admit_bt();" />
                <?php }?>
                </span>
                </td>
                <td>
                <span id="approve_chk">
                <?php if($details['Bank_Payment_Verified']=='1'){?>
                <input class="form_button" type="submit" name="approve" id="approve" value="Approve Application" style="background-color:#666;border:#333" disabled/>
                <?php }else{?>
                <input class="form_button" type="submit" name="approve" id="approve" value="Approve Application" onclick="return approve_bt()"/>
                <?php }?>
                </span>
                </td>
                <td>
                <span id="cancel_approve">
                <?php if($details['admit']!='0' || $details['Bank_Payment_Verified']!='1'){?>
                <input class="form_button" type="submit" name="cancel" id="cancel" value="Cancel" style="background-color:#666;border:#333" disabled/>
                <?php }else{?>
                <input class="form_button" type="submit" name="cancel" id="cancel" value="Cancel" onclick="return cancel_approve_bt()"/>
                <?php }?>
                </span>
                </td>
              </tr>
              </table>
              
              <br/><br/>
              <table width="50%">
              <tr>
                  <td id="button_Panel">
                      
                      <?php 
                      //Flag 1 - DRAFT
                      if($details['flag'] == 1){  ?>
                      
                      <p>Request you to pay the Application Fee of Rs. 100/= to SBI Brach AC:123445671889 and then Click on Submit Button below</p>
                      <input type="button" id="submit_button" onclick="changeFlag(2,<?=$_REQUEST['id']?>)" value="CONFIRM APPLICATION" />
                      <?php } else if($details['flag'] == 2){ ?>
                     
                      <input type="button" id="submit_button" onclick="changeFlag(3,<?=$_REQUEST['id']?>)" value="ACCEPT APPLICATION" />
                          <?php } else if($details['flag'] == 3){ ?>
                      <p>Request you to pay the Admission Fee of 
                          <?php echo "Rs. 1200/="?> to SBI Brach AC:123445671889 and then Click on Accept Admission Button below. Note: Once admitted in a suject all other combination stands cancelled</p>
 
                      <input type="button" id="submit_button" onclick="changeFlag(4,<?=$_REQUEST['id']?>)" value="ACCEPT ADMISSION" />
                          <?php }else if($details['flag'] == 4){ ?>
                      <p>Confirm Student's Admission</p>
                      
                      <input type="button" id="submit_button" onclick="changeFlag(5,<?=$_REQUEST['id']?>)" value="CONIRM ADMISSION" />
                      <?php }
                      ?>
                      
                  </td>
                  <td>
                      <!-- Cancel at any given point in time -->
                      
                  </td>
              </tr>
              </table>
              </div>
        </td>
    </tr>   
    </table>

<?php
}
include "footer.php";
?>	