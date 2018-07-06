<?php 
include "top.php";
include "header.php";
$sort_fieldname='c.id desc';
$table="course_seat_structure as c,course_table as ct,course_level as cl";
$listPage="seat_list.php";
$addPage="seat_add.php";

$search_para="Show All Records";
$action=$_REQUEST['action'];
//print_r($_SESSION);
/*Search Block*/

$where_field.='';

/*Make Where Clause*/

$where_field=" WHERE 1 and c.Course_Level_Id=cl.Course_Level_Id and c.Course_Id=ct.CourseId and cl.Course_Level_Id=4".$where_field;

$query = "SELECT cl.Course_Level_Name, ct.Course_Name, c.Admission_Open, "
        . "(c.Total_Seat-(c.SC+c.ST+c.OBC_A+c.OBC_B)) as Total_Seat, c.Other_Filled, c.SC, c.ST, c.OBC_A, OBC_B, SC_Filled, ST_Filled, OBC_A_Filled, OBC_B_Filled, Other_Filled FROM $table ".$where_field;


?>

<br />
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
                        <td><?php
						
						echo $row['Other_Filled'];?><?php echo $row[''];?></td>
                         <td><?php
						
						echo $row['Total_Seat'];?><?php echo $row[''];?></td>
                        <td><?php
						
						echo $row['SC_Filled'];?><?php echo $row[''];?></td>
                         <td><?php
						
						echo $row['SC'];?><?php echo $row[''];?></td>
                        <td><?php
						
						echo $row['ST_Filled'];?><?php echo $row[''];?></td>
                         <td><?php
						
						echo $row['ST'];?><?php echo $row[''];?></td>
                        <td><?php
						
						echo $row['OBC_A_Filled'];?><?php echo $row[''];?></td>
                         <td><?php
						
						echo $row['OBC_A'];?><?php echo $row[''];?></td>
                        <td><?php
						
						echo $row['OBC_B_Filled'];?><?php echo $row[''];?></td>
                         <td><?php
						
						echo $row['OBC_B'];?><?php echo $row[''];?></td>
                        
                     </tr>
					
                    <?php }?>
                    
                  	
               
			</table>
		</td>
	</tr>
</table>

<? include "footer.php";?>