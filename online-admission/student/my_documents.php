<?php
include "top.php";
include "header.php";

//$user_id = $_SESSION['user_id'];
if(!isset($_SESSION['user_id'])){
//	$user_id = $_SESSION['user_id'];
	header("Location:logout.php");
}
$user_id= $_SESSION['user_id'];
?>
<?php
//$count = 0;
//$gallery_id = array();
$flag_p = $flag_dob = $flag_x= $flag_xii =$flag_c = $flag_ph = 0;
$sql_chk1="SELECT `Category`,Physically_Challenged FROM `personal_details` WHERE `user_id` = '$user_id'";
$s1=mysql_query($sql_chk1) or die('connection error'.mysql_error());
    if(mysql_num_rows($s1)>0){
       $ft_user_category=mysql_fetch_array($s1);
		$category=$ft_user_category['Category'];
		$ph_ch=$ft_user_category['Physically_Challenged'];
		if($category == 'GEN')
			$is_general = 1;
		else	
			$is_general = 0;
	$sql_upload_documents = "SELECT `gallery_id` FROM `gallery_image` WHERE `user_id` = '$user_id' AND `is_deleted` = 'N' ";	
	$query_upload_documents = mysql_query($sql_upload_documents) or die('connection error'.mysql_error());
	if(mysql_num_rows($query_upload_documents)>0){
		while($ft_user_upload = mysql_fetch_array($query_upload_documents)){
			$gallery_id =$ft_user_upload['gallery_id'];
			if($gallery_id == 1)
				$flag_dob =1;
			else if($gallery_id == 2)
				$flag_p =1;
			else if($gallery_id == 3)
				$flag_x =1;
			else if($gallery_id == 4)
				$flag_xii =1;
			else if($gallery_id == 5)
				$flag_c =1;
			else if($gallery_id == 8)
				$flag_ph =1;
		}
	}	
?>
<table cellpadding="2" cellspacing="2" align="center" width="70%" border="1" style="border-collapse:collapse;" bordercolor="#cacaca" >
         <form method ="post" action ="upload_documents.php?action=pp_photo" enctype="multipart/form-data">
           <tr id="pp-photo-tr">
              <td bgcolor="#FF0000" class="sTD">
                <span class="style2">*
                </span>Candidate's passport size photograph
              </td>
			  <?php 
				if($flag_p == 1){
				  echo "<td><span class='sTD'><p>Uploaded</p></span></td>";
				  }else{ ?>
               <td>
                <span class="sTD">
                  <br>
                  <input type="file" name="pp-photo" id="pp-photo" required/>
                </span>
              </td>
			  <td>
			   <input type="submit" value="Upload" name="submit" id="submit" class="Submit_reset" >
			  </td>
			  <?php } ?>
               </tr>  
	         </form>
      <form method ="post" action ="upload_documents.php?action=dob" enctype="multipart/form-data">			 
		    <tr id="dob-proof-tr">
              <td>
                <span class="style2">*
                </span>Date of Birth Proof
              </td>
			    <?php 
				if($flag_dob == 1){
				  echo "<td><span class='sTD'><p>Uploaded</p></span></td>";
				  }else{ ?>
              <td>
                <span class="sTD">
                  <br>
                  <input type="file" name="dob-proof" id="dob-proof" required/>
                </span>
              </td>
			  <td>
			   <input type="submit" value="Upload" name="submit" id="submit" class="Submit_reset" >
			  </td>
				  <?php }?>
            </tr>	
		 </form>
         <form method ="post" action ="upload_documents.php?action=x_marksheet" enctype="multipart/form-data">		 
		    <tr>
              <td bgcolor="#FF0000" class="sTD">
                <span class="style2">*
                </span>10th Marksheet
              </td>
			    <?php 
				if($flag_x == 1){
				  echo "<td><span class='sTD'><p>Uploaded</p></span></td>";
				  }else{ ?>
              <td>
                <span class="sTD">
                  <br>
                  <input type="file" name="secondary-marksheet" id="secondary-marksheet" required/>
                </span>
              </td>
			  <td>
			   <input type="submit" value="Upload" name="submit" id="submit" class="Submit_reset" >
			  </td>
				  <?php } ?>
            </tr>
			</form>
			<form method ="post" action ="upload_documents.php?action=xii_marksheet" enctype="multipart/form-data">
          	<tr>
              <td>
                <span class="style2">*
                </span>12th Marksheet
              </td>
			    <?php 
				if($flag_xii == 1){
				  echo "<td><span class='sTD'><p>Uploaded</p></span></td>";
				  }else{ ?>
              <td>
                <span class="sTD">
                  <br>
                  <input type="file" name="hs-marksheet" id="hs-marksheet" required/>
                </span>
              </td>
			  <td>
			   <input type="submit" value="Upload" name="submit" id="submit" class="Submit_reset" >
			  </td>
				  <?php }?>
            </tr>
			</form>
       <?php if($is_general == 0){?>			
	   <form method ="post" action ="upload_documents.php?action=cast_cerificate" enctype="multipart/form-data">
		 <tr  id="caste-cert-tr">
			  <td bgcolor="#FF0000" class="sTD">
                <span class="style2">*
                </span>Caste certificate
              </td>
			    <?php 
				if($flag_c == 1){
				  echo "<td><span class='sTD'><p>Uploaded</p></span></td>";
				  }else{ ?>
              <td>
                <span class="sTD">
                  <br>
                  <input type="file" name="caste-proof" id="caste-proof"/>
                </span>
              </td>
			  <td>
			   <input type="submit" value="Upload" name="submit" id="submit" class="Submit_reset" >
			  </td>
				  <?php }?>
            </tr>	
			</form>
	   <?php } ?>
	  <?php if($ph_ch == 'Y'){?>			 
	  <form method ="post" action ="upload_documents.php?action=disability_cert" enctype="multipart/form-data">
			<tr id="disability-cert-tr">
              <td>
                <span class="style2">*
                </span>Disability Certificate
              </td>
			    <?php 
				if($flag_ph == 1){
				  echo "<td><span class='sTD'><p>Uploaded</p></span></td>";
				  }else{ ?>
              <td>
                <span class="sTD">
                  <br>
                  <input type="file" name="disability-cert" id="disability-cert"/>
                </span>
              </td>
			  <td>
			   <input type="submit" value="Upload" name="submit" id="submit" class="Submit_reset" >
			  </td>
			<?php }?>
            </tr>
			</form>
       <?php } 	   ?>			
   </table>
	<?php 
	 }else{?>
	<br><br>
<center><h3>Please Fill up your personal Information First</h3></center>

<?php
 }
 include "footer.php"; ?>
