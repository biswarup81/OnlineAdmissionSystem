<?php
include "top.php";
include "header.php";
$userid = $_SESSION['user_id'];

$sql_chk="SELECT b.Subject_Name, a.Marks_Obtained, a.Full_Marks, a.Pass_Fail_Remarks, a.Board, a.Roll_Index_No, a.Year_of_Passing , a.Hs_No
                FROM `academic_details` a, subject_master b WHERE  a.subject = b.subject_Id AND a.`User_id`='$userid' order by a.id asc ";
$s=mysql_query($sql_chk) or die('connection error '.mysql_error());
 if(mysql_num_rows($s)>0){
	echo '<table cellpadding="2" cellspacing="2" align="center" width="70%" border="1" style="border-collapse:collapse;" bordercolor="#cacaca" >
	<tr bgcolor="#FFFFCC">
              <td colspan="2" bgcolor="#FF9933">
                <br>
                <br>
                <font size="5">Academic Information:
                  <br>
                  <br>
                </font>		
              </td>
            </tr>
			<tr>
              <td align="center" colspan="2">
                <table border="0" width="90%" style="border:1px solid #aaa;">
                  <tbody>
                    <tr>
                      <td width="50%" height="39" bgcolor="#C0C0C0">
                        <span class="style3">
                          <b>Subjects
                          </b> (as mentioned in your Mark-Sheet)
                        </span>
                      </td>
                      <td class="mTD" width="26%" height="39" bgcolor="#C0C0C0">
                        <span class="style3">
                          <b>Marks Obtained
                          </b>
                        </span>
                      </td>
                      <td class="mTD" width="24%" height="39" bgcolor="#C0C0C0">
                        <span class="style3">
                          <b>Full Marks
                          </b>
                        </span>
                      </td>
                    </tr>';
			$roll = $board = $yop ="";		
	     while($chk_table_dtls = mysql_fetch_array($s)){?> 
	                  <tr>
                      <td width="50%" height="23" bgcolor="#E0E0E0">
                        <p><?php echo $chk_table_dtls['Subject_Name'];  ?></p>
                      </td>
                      <td class="mTD" width="26%" height="23" bgcolor="#E0E0E0">
                        <p><?php echo $chk_table_dtls['Marks_Obtained'];  ?></p>
                      </td>
                      <td class="mTD" width="24%" height="23" bgcolor="#E0E0E0">
                        <p><?php echo $chk_table_dtls['Full_Marks'];  ?></p>
                      </td>
                    </tr>  
					<?php $roll = $chk_table_dtls['Roll_Index_No']."-".$chk_table_dtls['Hs_No'];
					      $board = $chk_table_dtls['Board'];
						  $yop = $chk_table_dtls['Year_of_Passing'];
						 ?>
                
	     <?php
	        }
			echo '<tr>
              <td class="sTD">
                <label>
                  <span class="style2">*
                  </span>Board/Council (10+2)
                </label>
              </td>
              <td class="sTD"><p>'.$board.'</p></td></tr>
			  <tr>
              <td class="sTD">
                <span class="style2">*
                </span>Roll No/Index Number 
              </td>
              <td class="sTD"><p>'.$roll.'</p></td></tr>
			  <tr>
			  <td class="sTD">
                <span class="style2">*
                </span>Year of Passing: 
              </td>
              <td class="sTD"><p>'.$yop.'</p></td></tr>';
         echo "</table><br><br>";
}
else{?>
<?php
$sql_chk3="SELECT `Category`,`Physically_Challenged` FROM `personal_details` WHERE `user_id` = '$userid'";
$s3=mysql_query($sql_chk3) or die('connection error '.mysql_error());
     $is_general="";
    if(mysql_num_rows($s3)>0){
       $ft_user_category=mysql_fetch_array($s3);
		$category=$ft_user_category['Category'];
		$ph_ch=$ft_user_category['Physically_Challenged'];
		if($category == 'GEN')
			$is_general=1;
		else
			$is_general=0;
	}	   
 $sql_chk2 = "SELECT `gallery_id` FROM `gallery_image` WHERE `user_id` = '$userid' AND `is_deleted` = 'N' ";
	$query2=mysql_query($sql_chk2)or die('connection error '.mysql_error());
	$is_upload="";
    if(mysql_num_rows($query2)>0){
		$count_img = 0;
		while($ft_user_upload = mysql_fetch_array($query2)){
		//$index['gallery_id']=$ft_user_upload['gallery_id'];
		$count_img = $count_img+1;
		}
		if($is_general == 1 && $ph_ch == "N" && $count_img == 4){
	      $is_upload=1;
		}
		else if($is_general == 0 && $ph_ch == "Y" && $count_img == 6){
	      $is_upload=1;
		}else if($is_general == 0 && $ph_ch == "N" && $count_img == 5){
	      $is_upload=1;
		}else if($is_general == "1" && $ph_ch == "Y"  && $count_img == "5"){
                    $result['is_upload']="1";
                }
               else{
			$is_upload=10;//partially uploaded
		}
  }
	   
?>
  <table cellpadding="2" cellspacing="2" align="center" width="70%" border="1" style="border-collapse:collapse;" bordercolor="#cacaca" >
  <?php if($is_upload == 1){ ?>
  <form id="applyform" action="add_academic_details.php" method="post" enctype="multipart/form-data" name="applyform" onSubmit="return validateApply();">
    <tr bgcolor="#FFFFCC">
              <td colspan="2" bgcolor="#FF9933">
                <br>
                <br>
                <font size="5">Academic Information:
                  <br>
                  <br>
                </font>		
              </td>
            </tr>	
            <tr>
              <td class="sTD">
                <label>
                  <span class="style2">*
                  </span>Board/Council (10+2)
                </label>
              </td>
              <td class="sTD">
                <select id="U_council" name="U_council" style="width:110px;">
                  <option value="WBCHSE" selected="">WBCHSE
                  </option>
                  <option value="CBSE">CBSE
                  </option>
                  <option value="ISC">ISC
                  </option>
                  <option value="VISVA BHARATI">VISVA BHARATI
                  </option>
                  <option value="WB Vocational Board of Education">WB Vocational Board of Education
                  </option>
                  <option value="Rabindra Mukto Vidyalaya">Rabindra Mukto Vidyalaya
                  </option>
                  <option value="WB Board of Madrasha Education">WB Board of Madrasha Education
                  </option>
                </select>
                &nbsp;&nbsp;&nbsp;
                <span id="other_B" style="visibility:hidden">
                  <span class="style2">*
                  </span>Board Name
                  <input name="Uv_others" type="text" id="Uv_others" size="30" maxlength="30" style="text-transform:uppercase;" required="required" value=" ">
                </span>		
              </td>
            </tr>
            <tr>
              <td>
                <span class="style2">*
                </span>Roll No/Index Number 
              </td>
              <td>
                <span class="sTD">
                  <input name="U_roll2" type="text" id="U_roll2" size="30" maxlength="6" style="text-transform:uppercase;" required="required">&nbsp;
                  <span id="other_roll" style="visibility:visible">
                    <span class="style2">*
                    </span>Number
                    <input name="U_roll3" type="text" id="U_roll3" size="30" maxlength="5" style="text-transform:uppercase;" required="required">
                  </span>
                  <span class="style9">
                  </span>
                </span>
              </td>
            </tr>
            <tr>
              <!-- YEAR OF PASSING -->
              <?php include "../../fragments/year_of_passing.php"; ?>
              <!-- END -->
            </tr>
            <tr>
              <td height="22" colspan="2" align="left">
                <h3>
                  <span class="style2">*
                  </span>Marks obtained in H.S. or equivalent (10+2) Exams :
                </h3>
                <p class="style8">
                  <strong> Do not enter marks of Compulsory Environment Studies/Education/Science in the marks obtained field 
                  </strong>
                </p>
              </td>
            </tr>
            <tr>
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
                      <td width="50%" height="39" bgcolor="#C0C0C0">
                        <span class="style3">
                          <b>Subjects
                          </b> (as mentioned in your Mark-Sheet)
                        </span>
                      </td>
                      <!--?php
$query=mysql_query("select title from subjects order by title");
$Subjects= Array();
while($result = mysql_fetch_array($query,MYSQL_ASSOC)) $Subjects[] = strtoupper($result['title']);
?-->
                      <td class="mTD" width="26%" height="39" bgcolor="#C0C0C0">
                        <span class="style3">
                          <b>Marks Obtained
                          </b>
                        </span>
                      </td>
                      <td class="mTD" width="24%" height="39" bgcolor="#C0C0C0">
                        <span class="style3">
                          <b>Full Marks
                          </b>
                        </span>
                      </td>
                      <td class="mTD" width="24%" bgcolor="#C0C0C0">
                        <span class="style3">
                          <b>Remarks
                          </b>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="50%" height="23" bgcolor="#E0E0E0">
                        <b>1&nbsp;&nbsp;&nbsp;
                        </b>
                        <span class="sTD" id="subject3" style="width:400px;">&nbsp;
                        </span>
                        <span class="sTD" id="subject31" style="width:400px;">
                        </span>
                        <select name="s1" id="s1" style="width:200px;" onChange="checkSubjects(1);" required>
                          <option value="">Select Subject
                          </option>
                          <?php for($i=0;$i<sizeof($subid);$i++)echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';?>
                        </select>             
                      </td>
                      <td class="mTD" width="26%" height="23" bgcolor="#E0E0E0">
                        <input type="text" name="m1" id="m1" size="6" maxlength="3" onBlur="checkMarks(1);" disabled="" required>
                      </td>
                      <td class="mTD" width="24%" height="23" bgcolor="#E0E0E0">
                        <input type="text" name="full1" id="full1" size="6" maxlength="3" value="100" disabled="" required>
                      </td>
                      <td class="mTD" width="24%" bgcolor="#E0E0E0">
                        <input type="hidden" name="grade1" id="grade1" value="PASS"/>
                        <!--<option value="" selected="selected">Select</option>
<option value="PASS">PASS</option>
<option value="FAIL">FAIL</option>
<option value="NA">NA</option>
</select>-->PASS
                      </td>
                    </tr>
                    <tr>
                      <td width="50%" height="19" bgcolor="#E0E0E0">
                        <b>2&nbsp;&nbsp;&nbsp;
                        </b>
                        <span class="sTD" id="subject3" style="width:400px;">&nbsp;
                        </span>
                        <span class="sTD" id="subject31" style="width:400px;">
                        </span>
                        <select name="s2" id="s2" style="width:200px;" onChange="checkSubjects(2);" required>
                          <option value="">Select Subject
                          </option>
                          <?php for($i=0;$i<sizeof($subid);$i++)echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';?>
                        </select>
                        <!--input type="text" name="s2" id="s2" size="42" style="text-transform:uppercase;"-->              
                      </td>
                      <td class="mTD" width="26%" height="19" bgcolor="#E0E0E0">
                        <input type="text" name="m2" id="m2" size="6" maxlength="3" onBlur="checkMarks(2);" disabled="" required>
                      </td>
                      <td class="mTD" width="24%" height="19" bgcolor="#E0E0E0">
                        <input type="text" name="full2" id="full2" size="6" maxlength="3" value="100" disabled="" required>
                      </td>
                      <td class="mTD" width="24%" bgcolor="#E0E0E0">
                        <input type="hidden" name="grade2" id="grade2" value="PASS"/>
                        <!--<select name="grade2" id="grade2" required>
<option value="" >Select</option>
<option value="PASS" selected="">PASS</option>
<option value="FAIL">FAIL</option>
<option value="NA">NA</option>
</select>      -->PASS        
                      </td>
                    </tr>
                    <tr>
                      <td width="50%" height="19" bgcolor="#E0E0E0">
                        <b>3&nbsp;&nbsp;&nbsp;
                        </b>
                        <span class="sTD" id="subject3" style="width:400px;">&nbsp;
                        </span>
                        <span class="sTD" id="subject31" style="width:400px;">
                        </span>
                        <select name="s3" id="s3" style="width:200px;" onChange="checkSubjects(3);" required>
                          <option value="">Select Subject
                          </option>
                          <?php for($i=0;$i<sizeof($subid);$i++)echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';?>
                        </select>
                        <!--input type="text" name="s3" id="s3" size="42" style="text-transform:uppercase;"-->              
                      </td>
                      <td class="mTD" width="26%" height="19" bgcolor="#E0E0E0">
                        <input type="text" name="m3" id="m3" size="6" maxlength="3" onBlur="checkMarks(3);" disabled="" required>
                      </td>
                      <td class="mTD" width="24%" height="19" bgcolor="#E0E0E0">
                        <input type="text" name="full3" id="full3" size="6" maxlength="3" value="100" disabled="" required>
                      </td>
                      <td class="mTD" width="24%" bgcolor="#E0E0E0">
                        <input type="hidden" name="grade3" id="grade3" value="PASS"/>
                        <!--<select name="grade3" id="grade3" required>
<option value="" selected="selected">Select</option>
<option value="PASS">PASS</option>
<option value="FAIL">FAIL</option>
<option value="NA">NA</option>
</select>     -->PASS         
                      </td>
                    </tr>
                    <tr>
                      <td width="50%" height="19" bgcolor="#E0E0E0">
                        <b>4&nbsp;&nbsp;&nbsp;
                        </b>
                        <span class="sTD" id="subject4" style="width:400px;">&nbsp;
                        </span>
                        <span class="sTD" id="subject41" style="width:400px;">
                        </span>
                        <select name="s4" id="s4" style="width:200px;" onChange="checkSubjects(4);" required>
                          <option value="">Select Subject
                          </option>
                          <?php for($i=0;$i<sizeof($subid);$i++)echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';?>
                        </select>              
                      </td>
                      <td class="mTD" width="26%" height="19" bgcolor="#E0E0E0">
                        <input type="text" name="m4" id="m4" size="6" maxlength="3" onBlur="checkMarks(4);" disabled="" required>
                      </td>
                      <td class="mTD" width="24%" height="19" bgcolor="#E0E0E0">
                        <input type="text" name="full4" id="full4" size="6" maxlength="3" value="100" disabled="" required>
                      </td>
                      <td class="mTD" width="24%" bgcolor="#E0E0E0">
                        <input type="hidden" name="grade4" id="grade4" value="PASS"/>
                        <!--<select name="grade4" id="grade4" required>
<option value="" selected="selected">Select</option>
<option value="PASS">PASS</option>
<option value="FAIL">FAIL</option>
<option value="NA">NA</option>
</select>       -->PASS       
                      </td>
                    </tr>
                    <tr>
                      <td width="50%" height="19" bgcolor="#E0E0E0">
                        <b>5&nbsp;&nbsp;&nbsp;
                        </b>
                        <span class="sTD" id="subject5" style="width:400px;">&nbsp;
                        </span>
                        <span class="sTD" id="subject51" style="width:400px;">
                        </span>
                        <select name="s5" id="s5" style="width:200px;" onChange="checkSubjects(5);" required>
                          <option value="">Select Subject
                          </option>
                          <?php for($i=0;$i<sizeof($subid);$i++)echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';?>
                        </select> 
                      </td>
                      <td class="mTD" width="26%" height="19" bgcolor="#E0E0E0">
                        <input type="text" name="m5" id="m5" size="6" maxlength="3" onBlur="checkMarks(5);" disabled="" required>
                      </td>
                      <td class="mTD" width="24%" height="19" bgcolor="#E0E0E0">
                        <input type="text" name="full5" id="full5" size="6" maxlength="3" value="100" disabled="" required>
                      </td>
                      <td class="mTD" width="24%" bgcolor="#E0E0E0">
                        <input type="hidden" name="grade5" id="grade5" value="PASS"/>
                        <!--<select name="grade5" id="grade5" required>
<option value="" selected="selected">Select</option>
<option value="PASS">PASS</option>
<option value="FAIL">FAIL</option>
<option value="NA">NA</option>
</select>      -->PASS        
                      </td>
                    </tr>
                    <tr>
                      <td width="50%" height="19" bgcolor="#E0E0E0">
                        <b>6&nbsp;&nbsp;&nbsp;
                        </b>
                        <span class="sTD" id="subject6" style="width:400px;">&nbsp;
                        </span>
                        <span class="sTD" id="subject61" style="width:400px;">
                        </span>
                        <select name="s6" id="s6" style="width:200px;" onChange="checkSubjects(6);" required>
                          <option value="">Select Subject
                          </option>
                          <?php for($i=0;$i<sizeof($subid);$i++)echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';?>
                        </select> 
                      </td>
                      <td class="mTD" width="26%" height="19" bgcolor="#E0E0E0">
                        <input type="text" name="m6" id="m6" size="6" maxlength="3" onBlur="checkMarks(6);" disabled="" required>
                      </td>
                      <td class="mTD" width="24%" height="19" bgcolor="#E0E0E0">
                        <input type="text" name="full6" id="full6" size="6" maxlength="3" value="100" disabled="" required>
                      </td>
                      <td class="mTD" width="24%" bgcolor="#E0E0E0">
                        <input type="hidden" name="grade6" id="grade6" value="PASS"/>
                        <!--<select name="grade6" id="grade6" required>
<option value="" selected="selected">Select</option>
<option value="PASS">PASS</option>
<option value="FAIL">FAIL</option>
<option value="NA">NA</option>
</select>        -->PASS      
                      </td>
                    </tr>
                  </tbody>
                </table>      
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <span class="style8">
                  <span class="style6">
                    <span id="chkStatusText">Total Marks in Top Five in Top (Total 500): 
                    </span>
                    <input type="text" name="m12" id="m12" size="6" maxlength="3" readonly="" onBlur="checkMarks(1);">
                    &nbsp;
                    <span id="best4">
                      <b>
                      </b>
                    </span>
                    &nbsp;&nbsp;
                    <span id="best4" style="visibility: hidden;">
                    </span>
                  </span>
                  </td>
            </tr>
          </tbody>
		  <!-- </table> -->
		  <table>	
		<center>
       	<tr>	
          <input type="checkbox" id="iV" name="iV" value="1" onChange="show_submit();" required>
          <label for="iV">
            <font size="4"> I confirm that all the values entered are correct
            </font>
          </label>
          <br>
          <br>
          <span id="showsubmit" style="visibility:visible">
            <input type="submit" value="Submit" name="submit" id="submit" class="Submit_reset" >
            <input name="reset" type="reset" value="Reset" id="reset" class="Submit_reset" onClick="hide_submit()">
          </span>
      </tr>	
	  </center>
     </table>
      </form>
  <?php }else{
	  echo "<br><br><center><h3>Please Upload all the  required documents first</h3></center>";
  }?>
 </table>  
	
<?php
 }
?>

<?php include "footer.php"; ?>
