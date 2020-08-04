<?php
include "top.php";
include "header.php";

$uid = $_SESSION['user_id'];

$sql_check_details = "SELECT a.mobile,a.gender,b.Date_Of_Birth,b.Gurdian_Name,b.Address,b.ZIP_PIN,b.Gurdian_Mobile_No,b.Gurdian_Relation,
                       b.occu,b.income,b.Category,b.Physically_Challenged,b.Religion,b.Nationality,b.Country,
                       c.name as state, d.name as district FROM user a, personal_details b, states c, districts d WHERE a.user_id=b.user_id AND b.state = c.id AND b.district = d.id AND a.user_id='$uid' ";
$result = mysql_query($sql_check_details) or die(mysql_error());
if(mysql_num_rows($result) > 0){
	$row = mysql_fetch_array($result);
	?>
	<table cellpadding="2" cellspacing="2" align="center" width="70%" border="1" style="border-collapse:collapse;" bordercolor="#cacaca" >
	 <tr bgcolor="#FFFFCC">
              <td colspan="2" bgcolor="#FF9933" width="50">
                <br>
                <br>
                <font size="5">Personal Information:
                  <br>
                  <br>
                </font>		
              </td>
            </tr>
			<tr>
              <td>
                <label>
                  <span class="style2">
                  </span>Personal Mobile Number
                </label>
              </td>
              <td>
                <p><?php echo $row['mobile']; ?></p>
            </tr>
            <tr>
              <td>
                <label>
                  <span class="style2">
                  </span>Guardian's Name
                </label>
              </td>
              <td>
                <p><?php echo $row['Gurdian_Name']; ?></p>
            </tr>
			<tr>
              <td class="sTD">
                <span class="style">
                </span>
                <label>Guardian Mobile Number
                </label>
              </td>
              <td class="sTD"> 
                <p><?php echo $row['Gurdian_Mobile_No']; ?></p>
              </td>
            </tr>
			<tr>
              <td class="sTD">
                <label>
                  <span class="style2">*
                  </span>Relation
                </label>
              </td>
              <td class="sTD">
               <p><?php echo $row['Gurdian_Relation']; ?></p>
              </td>
            </tr>
            <tr>
              <td>
                <label>
                  <span class="style2">*
                  </span>Occupation
                </label>
              </td>
              <td>
               <p><?php echo $row['occu']; ?></p>
              </td>
            </tr>
            <input type="hidden" name="desi" id="desi" >
            <tr>
              <td style="padding-left:26px;">Monthly Income 
              </td>
              <td>
                <p><?php echo $row['income']; ?></p>
              </td>
            </tr>
            <tr>
              <td>
                <span class="style2">*
                </span>Date of Birth(MM/DD/YYYY)
              </td>
              <td>
                <p><?php echo $row['Date_Of_Birth']; ?></p>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FF0000" class="sTD">
                <span class="style2">*
                </span>Category
              </td>
              <td class="sTD">     
           <p><?php echo $row['Category']; ?></p>
              </td>
            </tr>
			
            <tr>
              <td>
                <span class="style2">*
                </span>Physically Challenged
              </td>
              <td>
			<p><?php echo $row['Physically_Challenged']; ?></p>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FF0000" class="sTD">
                <span class="style2">*
                </span>Religion
              </td>
              <td class="sTD">
                 <p><?php echo $row['Religion']; ?></p>
              </td>
            </tr>
            <tr>
              <td>
                <span class="style2">*
                </span>Nationality
              </td>
              <td>
			  <p><?php echo $row['Nationality']; ?></p>	  
              </td>
            </tr>
            <tr>
              <td bgcolor="#FF0000" class="sTD">
                <label>
                  <span class="style2">*
                  </span>Present Address 
                </label>
              </td>
              <td class="sTD">
                <label for="textfield">
                   <p><?php echo $row['Address']; ?></p>	  
				   <br>
                  <span class="style2">*
                  </span>Pincode
                </label>
                <p><?php echo $row['ZIP_PIN']; ?></p>	  
              </td>
            </tr>
            <tr>
              <td>
                <label>
                  <span class="style2">*
                  </span>Country
                </label>
              </td>
              <td>
               <p><?php echo $row['Country']; ?></p>	  
              </td>
            </tr>
            <tr>
              <td class="sTD">
                <label>
                  <span class="style2">*
                  </span>State
                </label>
              </td>
              <td class="sTD">
            <p><?php echo $row['state']; ?></p>	  
              </td>
            </tr>
            <tr>
              <td>
                <label>
                  <span class="style2">*
                  </span>District
                </label>
              </td>
              <td>
          <p><?php echo $row['district']; ?></p>	  
              </td>
            </tr>

            <tr id="p1" style="display:none">
              <td>
                <label>
                  <span class="style2">*
                  </span>Country
                </label>
              </td>
              <td>
               <p><?php echo $row['Country']; ?></p>	  
              </td>
            </tr>
            
	</table>
	<?php
}else{
?>
<br/>
<table cellpadding="5" cellspacing="5" align="center" width="98%" border="1" style="border-collapse:collapse;" bordercolor="#cacaca" >
<form id="applyform" action="add_profile_details.php" method="post" enctype="multipart/form-data" name="applyform" onSubmit="return validateApply();">
          <tr bgcolor="#FFFFCC">
              <td colspan="2" bgcolor="#FF9933" width="300">
                <br>
                <br>
                <font size="5">Personal Information:
                  <br>
                  <br>
                </font>		
              </td>
            </tr>
            <tr>
              <td>
                <label>
                  <span class="style2">*
                  </span>Guardian's Name
                </label>
              </td>
              <td>
                <input name="U_gname" type="text" id="U_gname" size="40" maxlength="39" style="text-transform:uppercase;" required> 
            </tr>
			<tr>
              <td class="sTD">
                <span class="style">*
                </span>
                <label>Guardian Mobile Number
                </label>
              </td>
              <td class="sTD"> 
                <input type="text" name="gmobnum" id="gmobnum" required="required" pattern="[0-9]{10}">
              </td>
            </tr>
            <tr>
              <td class="sTD">
                <label>
                  <span class="style2">*
                  </span>Relation
                </label>
              </td>
              <td class="sTD">
                <select id="g_relation" name="g_relation" onChange="displayR();" required>
                  <option value="">Choose Relation
                  </option>
                  <option value="Father" >Father
                  </option>
                  <option value="Mother">Mother
                  </option>
                  <option value="Uncle">Uncle
                  </option>
                  <option value="Aunt">Aunt
                  </option>
                  <option value="Husband">Husband
                  </option>
                  <option value="Other">Other
                  </option>
                </select>	
                &nbsp;&nbsp;
                <span id="other_R" style="visibility:hidden">
                  <span class="style2">*
                  </span>Other Relation
                  <input name="R_other" type="text" id="R_other" size="20" maxlength="29" style="text-transform:uppercase;" required>
                </span>	
              </td>
            </tr>
            <tr>
              <td>
                <label>
                  <span class="style2">*
                  </span>Occupation
                </label>
              </td>
              <td>
                <label for="label">
                </label>
                <label for="label">
                </label>
                <select name="occu" id="occu" required="required" onChange="displayO();">
                  <option value="">Choose Occupation
                  </option>
                  <option value="Service">Service
                  </option>
                  <option value="Self Employed">Self Employed
                  </option>
                  <option value="Professional">Professional
                  </option>
                  <option value="House Hold">House Hold
                  </option>
                  <option value="Retaired Person">Retired Person
                  </option>
                  <option value="others">Other
                  </option>
                </select>
                <span id="other_O" style="visibility:hidden">
                  <span class="style2">*
                  </span>
                  Other Occupation  
                  <input type="text" name="othrOccu" id="othrOccu">
                </span>
              </td>
            </tr>
            <input type="hidden" name="desi" id="desi" >
            <tr>
              <td style="padding-left:26px;">Monthly Income 
              </td>
              <td>
                <label for="label3">
                </label>
                <select name="income" id="income">
                  <option value="<5000">&lt;5000
                  </option>
                  <option value="5000-10000">5000-10000
                  </option>
                  <option value="10001-20000">10001-20000
                  </option>
                  <option value=">20000">&gt;20000
                  </option>
                </select>	    
              </td>
            </tr>
            <tr>
              <td>
                <span class="style2">*
                </span>Date of Birth(MM/DD/YYYY)
              </td>
              <td>
                <span class="sTD">
                  <br>
                  <input type="text" value="" required="required" name="theDate" id="theDate" />
                </span>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FF0000" class="sTD">
                <span class="style2">*
                </span>Category
              </td>
              <td class="sTD">     
                <input name="radio3" type="radio" id="radio3" value="GEN" checked="checked">General
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input name="radio3" type="radio" id="radio3" value="SC">SC     &nbsp;&nbsp;
                <input name="radio3" type="radio" id="radio3" value="ST">ST
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input name="radio3" type="radio" id="radio3" value="OBC-A">OBC A &nbsp;&nbsp;
                <input name="radio3" type="radio" id="radio3" value="OBC-B">OBC B &nbsp;&nbsp;
				<br><br><span class="style2">*
                </span>must need a certificate(Other than General)
              </td>
              </td>
            </tr>
            <tr>
              <td>
                <span class="style2">*
                </span>Physically Challenged
              </td>
              <td>
                <input name="ph_radio3" type="radio" id="ph_radio3" value="YES">
                YES     &nbsp;&nbsp;&nbsp;&nbsp;
                <input name="ph_radio3" type="radio" id="ph_radio3" value="NO" checked>
                NO	  
				<br><br><span class="style2">*
                </span>must need a certificate(If YES)
              </td>
            <tr>
              <td bgcolor="#FF0000" class="sTD">
                <span class="style2">*
                </span>Religion
              </td>
              <td class="sTD">
                <label>
                  <select name="religion" id="religion" onChange="displayRelign()" required="">
                    <option value="">Select
                    </option>
                    <option value="Hindu">Hindu
                    </option>
                    <option value="Muslim">Muslim
                    </option>
                    <option value="Christian">Christian
                    </option>
                    <option value="others">Other
                    </option>
                  </select>
                  <span id="other_relig" style="visibility:hidden">
                    <span class="style2">*
                    </span>Other Religion 
                    <input type="text" name="other_religion" value=" " id="other_religion" style="text-transform:uppercase" required="required">
                  </span>
                </label>
              </td>
            </tr>
            <tr>
              <td>
                <span class="style2">*
                </span>Nationality
              </td>
              <td>
                <span class="sTD">
                  <select name="select7" id="select7" onChange="return otherNation();" required="required">
                    <option value="">Choose Nationality
                    </option>
                    <option value="INDIAN" selected>INDIAN
                    </option>
                  </select>
                  <span id="other_Nation" style="visibility:hidden">
                    <span class="style2">*
                    </span>Other Nationality
                    <label for="textfield">
                    </label>
                    <input type="text" name="nationother" id="nationother" style="text-transform:uppercase;" >
                  </span> 
                </span>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FF0000" class="sTD">
                <label>
                  <span class="style2">*
                  </span>Present Address 
                </label>
              </td>
              <td class="sTD">
                <label for="textfield">
                  <textarea name="p_address" id="p_address" rows="5" cols="30" style="text-transform:uppercase;" required="required" maxlength="200">
                  </textarea>
                  <span class="style2">*
                  </span>Pincode
                </label>
                <input type="text"  pattern="[0-9]{6}" name="pin1" id="pin1" required="required">
                <label for="textfield">
                  <br>
                  <font color="Gray">&nbsp;&nbsp;&nbsp;&nbsp;Upto 200 characters only.
                  </font>	    
                </label>
              </td>
            </tr>
            <tr>
              <td>
                <label>
                  <span class="style2">*
                  </span>Country
                </label>
              </td>
              <td>
                <label for="label">
                </label>
                <select name="select4" id="select4" onChange="return countrychange();" >
                  <option value="INDIA" selected>INDIA
                  </option>
                </select>
                &nbsp;&nbsp; 
                <span id="other_C" style="visibility:hidden">
                  <span class="style2">*
                  </span>Country Name
                  <input name="Co_others" type="text" id="Co_others" size="20" maxlength="29" style="text-transform:uppercase;">
                </span> 
              </td>
            </tr>
            <tr>
              <td class="sTD">
                <label>
                  <span class="style2">*
                  </span>State
                </label>
              </td>
              <td class="sTD">
                <span class="sTD" id="india_state" style="width:400px;">
                  <select name="select10" id="select10"  required="required">
                    <option value="">Choose State
                    </option>
                    <?php 
$State_query=mysql_query("select * from states");
while($states=mysql_fetch_array($State_query)){
?>
                    <option value="<?=$states["id"]?>">
                      <?=$states["name"]?>
                    </option>
                    <?php }?>
                  </select>
                </span>
              </td>
            </tr>
            <tr>
              <td>
                <label>
                  <span class="style2">*
                  </span>District
                </label>
              </td>
              <td>
                <span class="sTD" id="districtList" style="width:400px;">
                  <select name="D2" id="D2" required="required">
                    <option value="">Choose District
                    </option>
                  </select>
                </span>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FF0000" class="sTD">
                <span class="style2">*
                </span>Permanent Address
              </td>
              <td class="sTD">Same as Present Address
                <input name="radiopar" type="radio" value="yes" id="radiopar" checked="checked" onClick="show_par_add('yes');">
                Yes
                <input name="radiopar" type="radio" value="no" id="radiopar" onClick="show_par_add('no');">
                <label for="radio">No
                  <br>
                </label>
                <span id="par_add" style="width:10000px;">&nbsp;
                </span>
              </td>
            </tr>
            <!-- ************************************************** -->
            <tr id="p1" style="display:none">
              <td>
                <label>
                  <span class="style2">*
                  </span>Country
                </label>
              </td>
              <td>
                <label for="label">
                </label>
                <label for="label">
                </label>
                <select name="select12" id="select12" onChange="return pcountrychange();">
                  <option value="INDIA" selected="">INDIA
                  </option>
                </select>
                &nbsp;&nbsp;
                <span id="pother_C" style="visibility:hidden">
                  <span class="style2">*
                  </span>Country Name
                  <input name="Co_pothers" type="text" id="Co_pothers" size="20" maxlength="29" style="text-transform:uppercase;">
                </span>        
              </td>
            </tr>
            <tr id="p2" style="display:none">
              <td class="sTD">
                <label>
                  <span class="style2">*
                  </span>State
                </label>
              </td>
              <td class="sTD">
                <span class="sTD" id="pindia_state" style="width:400px;">
                  <select name="select13" id="select13">
                    <option value="">Choose State
                    </option>
                    <?php 
$State_query=mysql_query("select * from states");
while($states=mysql_fetch_array($State_query)){
?>
                    <option value="<?=$states["id"]?>">
                      <?=$states["name"]?>
                    </option>
                    <?php }?>
                  </select>
                </span>
                <label for="label">
                </label>
              </td>
            </tr>
            <tr id="p3" style="display:none">
              <td>
                <label>
                  <span class="style2">*
                  </span>District
                </label>
              </td>
              <td>
                <span class="sTD" id="pdistrictList" style="width:400px;">
                  <select name="D3" id="D3">
                    <option value="">Choose District
                    </option>
                  </select>
                </span>
                <label for="label2">
                </label>
              </td>
            </tr>
            <tr bgcolor="#FFFFFF" id="p4" style="display:none">
              <td class="sTD" style="padding-left:26px;">
                <label>Phone Numbers 
                </label>
              </td>
              <td class="sTD">
                <label for="label4">
                </label>
                <input type="text" name="pphone" id="pphone">
              </td>
            </tr>
            <tr>
              <td>
                <label>
                  <span class="style2">*
                  </span>Local Guardian
                </label>
              </td>
              <td>
                <!--<span class="sTD" id="districtList" style="width:400px;">
</span>-->
                <label for="textfield">
                </label>
                Same as Guardian
                <input name="radiolocal" type="radio" value="yes" id="radiolocal" checked="checked" onClick="show_local('yes');">
                Yes
                <input name="radiolocal" type="radio" value="no" id="radiolocal" onClick="show_local('no');">
                <label for="radio5">
                </label>
                <label for="radio4">
                </label>
                No
                <label for="label2">
                </label>
              </td>
            </tr>
            <tr bgcolor="#FFFFFF" id="g1" style="display:none">
              <td class="sTD">
                <span class="style2">*
                </span>Local Guardian's Name 
              </td>
              <td class="sTD">
                <label for="label3">
                </label>
                <input type="text" name="lgname" id="lgname"  style="text-transform:uppercase;">
              </td>
            </tr>
            <tr id="g2" style="display:none">
              <td>
                <span class="style2">*
                  <span class="style10">Relation with the Candidate
                  </span>
                </span>
              </td>
              <td>
                <label for="label2">
                </label>
                <select name="select14" id="select14" onChange="show_R();" >
                  <option value="Father" selected="selected">Father
                  </option>
                  <option value="Mother">Mother
                  </option>
                  <option value="Uncle">Uncle
                  </option>
                  <option value="Aunt">Aunt
                  </option>
                  <option value="Husband">Husband
                  </option>
                  <option value="Other">Other
                  </option>
                </select>
                <span class="style2">
                  <label for="textfield"> 
                    <span class="style10">
                    </span>
                  </label>
                </span>
                <label for="textfield">
                  <span class="sTD">
                    <span id="grelation" style="visibility:hidden">
                      <span class="style2">*
                      </span>Other Relation
                      <input type="text" name="lgother" id="lgother"  style="text-transform:uppercase;">
                    </span>
                  </span>
                </label>
              </td>
            </tr>
            <tr bgcolor="#FFFFFF" id="g3" style="display:none">
              <td class="sTD">
                <span class="style2">*
                </span>Local Guardian's Address
              </td>
              <td class="sTD">
                <textarea name="localA" cols="30" rows="5" id="localA" style="text-transform:uppercase;" >
                </textarea>
                <span class="style2"> *
                </span>Pincode
                <label for="label">
                </label>
                <input type="text" name="textfield6" id="textfield6" pattern="[0-9]{6}">
              </td>
            </tr>
            <tr id="g4" style="display:none">
              <td style="padding-left:26px;">Phone Numbers
              </td>
              <td>
                <span class="sTD">
                  <input type="text" name="lgphone" id="lgphone">
                </span>Mobile Number 
                <label for="label2">
                </label>
                <input type="text" name="textfield5" id="textfield5" >
              </td>
            </tr>
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
</table>
 
<?php 
 }
include "footer.php";?>
