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

$where_field=" WHERE 1 and c.Course_Level_Id=cl.Course_Level_Id and c.Course_Id=ct.CourseId ".$where_field;

$query = "select b.session_name, c.course_level_name, d.course_name, a.Total_Seat, (a.Total_Seat - a.SC - a.ST - a.OBC_A - a.OBC_B) as General, a.SC, a.ST, a.OBC_A, a.OBC_B
, SUM(case when e.flag in (4,5) and f.rank_category = 'GEN' then 1 else 0 end) as GEN_Filled
, SUM(case when e.flag in (4,5) and f.rank_category = 'SC' then 1 else 0 end) as SC_Filled
, SUM(case when e.flag in (4,5) and f.rank_category = 'ST' then 1 else 0 end) as ST_Filled
, SUM(case when e.flag in (4,5) and f.rank_category = 'OBC-A' then 1 else 0 end) as 'OBC_A_Filled'
, SUM(case when e.flag in (4,5) and f.rank_category = 'OBC-B' then 1 else 0 end) as 'OBC_B_Filled'
from course_seat_structure a
left join session_table b on a.Session_id = b.sessionid
left join course_level c on a.course_level_id = c.course_level_id
left join course_table d on a.course_id = d.courseid
left outer join application_table e on a.Session_id = e.session_id and a.course_level_id = e.course_level_id and a.course_id = e.course_id
left outer join application_rank_status f on e.application_no = f.application_no
group by b.session_name, c.course_level_name, d.course_name, a.Total_Seat, (a.Total_Seat - a.SC - a.ST - a.OBC_A - a.OBC_B), a.SC, a.ST, a.OBC_A, a.OBC_B";

//echo $query;
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
        <td colspan="2" class="colhead"></td>
        
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
        <!--  <td class="colhead">Action</td> -->
    </tr>
                    
                    <?php 
                    $result = mysql_query($query) or die(mysql_error());
                    while($row = mysql_fetch_array($result)){ ?>
                    
                    <tr align="center" bgcolor="<?php echo $bg; ?>" onMouseOver=bgColor="#EFF7FF" onMouseOut=bgColor="<?php echo $bg; ?>" >
						
                                                <td colspan="2"><?php
						
                                                $coursename = $row['course_name'];
                                                if("GENERAL"==$coursename) {
                                                    echo $row['course_level_name'] ." ";
                                                } else { 
                                                    echo $row['course_level_name'] ." (".$coursename.")";}?></td>
                        <td><?php
						
						echo $row['GEN_Filled'];?><?php echo $row[''];?></td>
                         <td><?php
						
						echo $row['General'];?><?php echo $row[''];?></td>
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
                         <!--  <td><a href="dashB_edit.php?id=<?php echo $row['id'];?>" >EDIT</a></td> -->
                        
                     </tr>
					
                    <?php }?>
                    
                  	
               
			</table>
		</td>
	</tr>
</table>

<? include "footer.php";?>