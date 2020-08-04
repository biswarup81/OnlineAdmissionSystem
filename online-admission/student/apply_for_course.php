<?php
include "top.php";
include "header.php";

if(!isset($_SESSION['user_id'])){
	header("Location:logout.php");
}
$user_id= $_SESSION['user_id'];
?>
<table cellpadding="2" cellspacing="2" align="center" width="70%" border="1" style="border-collapse:collapse;" bordercolor="#cacaca" >
    <center><h2>APPLICATION FOR ADMISSION 2020</h2></center>
	<input type="hidden" name="userid" id="userid" value="<?php echo $user_id; ?>" >
	
            <tr bgcolor="#FFFFCC">
			<td>
               <p>Stream :</p>
              </td>
               <td>                    
			   <select name="select" id="select" onChange="return CourseLevel()" required>
                              <option value="">Select Course Level
                              </option>
                              <?php 
                $courseLevel_query=mysql_query("SELECT * FROM `course_level` where Course_Level_Id in ('4','7','11','12','13','14') ORDER BY `Course_Level_Id` ASC");
               while($courseLevel=mysql_fetch_array($courseLevel_query)){
                        ?>
                              <option value="<?=$courseLevel['Course_Level_Id']?>">
                                <?=$courseLevel['Course_Level_Name']?>
                              </option>
                              <?php }?>
                            </select>
             </td>
			 </tr>
       		 <tr>
			  <td>
			  <p>Course:</p>
				  </td>
		         <td>
                    <span id="dOptPut"></span>
                  </td>
		        </tr> 		 
				<tr>
                  <td  colspan="2">
				  <center>
			       <span id="checkmark"></span>
				  </center>
                  </td>
			 </tr>		   
        </table> 
<?php include "footer.php"; ?>