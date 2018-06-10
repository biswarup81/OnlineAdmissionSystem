<?php 
include "top.php";
include "header.php";
$sort_fieldname='c.id desc';
$table="course_seat_structure as c,course_table as ct,course_level as cl";


if(isset($_GET['id'])){
    
    $id = $_GET['id'];

    $where_field=" WHERE 1 and c.Course_Level_Id=cl.Course_Level_Id and c.Course_Id=ct.CourseId and c.id = ".$id;

    $query = "SELECT c.id, cl.Course_Level_Name, ct.Course_Name, c.Admission_Open, "
            . "(c.Total_Seat-(c.SC+c.ST+c.OBC_A+c.OBC_B)) as Total_Seat, c.Other_Filled, c.SC, c.ST, c.OBC_A, OBC_B, SC_Filled, ST_Filled, OBC_A_Filled, OBC_B_Filled, Other_Filled FROM $table ".$where_field;

    //echo $query;
}  else if(isset($_POST['SUBMIT']))  { 
    $id = $_POST['id'];
    $Other_Filled = $_POST['Other_Filled'];
    $SC = $_POST['SC_Filled'];
    $ST = $_POST['ST_Filled'];
    $OBC_A = $_POST['OBC_A_Filled'];
    $OBC_B = $_POST['OBC_B_Filled'];
    
    mysql_query("update course_seat_structure set Other_Filled "
            . " = $Other_Filled, SC_Filled = $SC,  ST_Filled = $ST, OBC_A_Filled = $OBC_A, "
            . "OBC_B_Filled = $OBC_B where id = $id") or die(mysql_error());
    
    //echo "User Has submitted the form and entered this name : <b>". $unreserved." </b>,".$SC.",".$ST.",".$OBC_A.",".$OBC_B;
    //echo "<br>You can use the following form again to enter a new name."; 
    echo "<b>Record updated successfully !!</b>";
    
     $where_field=" WHERE 1 and c.Course_Level_Id=cl.Course_Level_Id and c.Course_Id=ct.CourseId and c.id = ".$id;

    $query = "SELECT c.id, cl.Course_Level_Name, ct.Course_Name, c.Admission_Open, "
            . "(c.Total_Seat-(c.SC+c.ST+c.OBC_A+c.OBC_B)) as Total_Seat, c.Other_Filled, c.SC, c.ST, c.OBC_A, OBC_B, SC_Filled, ST_Filled, OBC_A_Filled, OBC_B_Filled, Other_Filled FROM $table ".$where_field;

    //echo $query;
}







?>

<br />
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>" >
<table cellpadding="0" cellspacing="0" width="100%" align="center" border="0" >	
	
		<td>
			<table cellpadding="0" cellspacing="0" width="100%" align="left">
				  <td width="40%" class="caption">Seat Availability </td>
				    <td class="endcap"></td>
				<td style="padding-left:10px;" align="right"></td>
				<td align="left"></td>
			</table>
		</td>
	</tr>    
	<tr>
		<td class="mainarea" align="Left">		
        	<table cellpadding="5" cellspacing="5" align="center" width="98%" border="1" style="border-collapse:collapse;" bordercolor="#cacaca" >
    <tr align="center">
    	
        <td rowspan="2" colspan="2" class="colhead">Course</td>
        <td colspan="2" class="colhead">GEN</td>
        <td colspan="2" class="colhead">SC</td>
        <td colspan="2" class="colhead">ST</td>
        <td colspan="2" class="colhead">OBC-A</td>
        <td colspan="2" class="colhead">OBC-B</td>
        
        
    </tr>
    <tr align="center">
    	<td class="colhead">FILLED</td>
        <td class="colhead">TOTAL</td>
        <td class="colhead">FILLED</td>
        <td class="colhead">TOTAL</td>
        <td class="colhead">FILLED</td>
        <td class="colhead">TOTAL</td>
        <td class="colhead">FILLED</td>
        <td class="colhead">TOTAL</td>
        <td class="colhead">FILLED</td>
        <td class="colhead">TOTAL</td>
        
    </tr>
                    
                    <?php 
                    $result = mysql_query($query) or die(mysql_error());
                    while($row = mysql_fetch_array($result)){
                        ?>
                    <tr align="center" bgcolor="<?php echo $bg;?>" onMouseOver=bgColor="#EFF7FF" onMouseOut=bgColor="<?php echo $bg;?>">
						
                                                <td colspan="2"><?php
						
                                                $coursename = $row['Course_Name'];
                                                if("GENERAL"==$coursename) {
                                                    echo $row['Course_Level_Name'] ." ";
                                                } else { 
                                                    echo $row['Course_Level_Name'] ." (".$coursename.")";}?></td>
                                                <td><input type="text" name="Other_Filled" value="<?php echo $row['Other_Filled'];?>" size="2"></td>
                        <td><?php echo $row['Total_Seat'];?><?php echo $row[''];?></td>
                        <td><input type="text" name="SC_Filled" value="<?php echo $row['SC_Filled'];?>" size="2"></td>
                        <td><?php echo $row['SC'];?><?php echo $row[''];?></td>
                        <td><input type="text" name="ST_Filled" value="<?php echo $row['ST_Filled'];?>" size="2"></td>
                        <td><?php echo $row['ST'];?><?php echo $row[''];?></td>
                        <td><input type="text" name="OBC_A_Filled" value="<?php echo $row['OBC_A_Filled'];?>" size="2"></td>
                         <td><?php echo $row['OBC_A'];?><?php echo $row[''];?></td>
                        <td><input type="text" name="OBC_B_Filled" value="<?php echo $row['OBC_B_Filled'];?>" size="2"></td>
                         <td><?php echo $row['OBC_B'];?><?php echo $row[''];?></td>
                         <td><a href="dashB_edit.php?id="<?php echo $row['id'];?> ></a></td>
                        
                     </tr>
					
                    <?php }?>
                    
                  	<tr align="center">
                            <td class="colhead" colspan="11"><input name="SUBMIT" type="SUBMIT" value="UPDATE"> </td>
                        </tr>
               
			</table>
		</td>
	</tr>
</table>
</form>
<? include "footer.php";?>