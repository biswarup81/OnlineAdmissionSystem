<?php
include"top.php";
include"header.php";
?>
<table cellpadding="0" cellspacing="0" width="100%" align="center" border="0" >	
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="40%" align="left">
				<td width="90%" class="caption">: Seat Availability </td>
				<td class="endcap"></td>
			</table>
		</td>
	</tr>
	<tr>
		<td class="mainarea">	
        
<table cellpadding="5" cellspacing="5" align="center" width="98%" border="1" style="border-collapse:collapse;" bordercolor="#cacaca" >
    <tr align="center">
    	<td rowspan="2" colspan="2" class="colhead">Course</td>
        <td colspan="2" class="colhead">SC</td>
        <td colspan="2" class="colhead">ST</td>
        <td colspan="2" class="colhead">OBC-A</td>
        <td colspan="2" class="colhead">OBC-B</td>
        <td colspan="2" class="colhead">GEN</td>
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
	for($j=1;$j<=3;$j++){
	$course_q=mysql_query("SELECT * FROM `course_subject_link` where Course_Level_Id='$j' order by Course_Id asc");
	$rowC=mysql_num_rows($course_q);
	$i=1;
	while($course=mysql_fetch_array($course_q)){
		$seat=mysql_fetch_array(mysql_query("SELECT * FROM `course_seat_structure` WHERE `Course_Level_Id`='$course[Course_Level_Id]' and `Course_Id`='$course[Course_Id]'"));
		$total=$seat['Total_Seat']-($seat['SC']+$seat['ST']+$seat['OBC_A']+$seat['OBC_B']);
		$courseName=mysql_fetch_array(mysql_query("SELECT * FROM `course_table` where CourseId='$course[Course_Id]'"));
		$courseLevelName=mysql_fetch_array(mysql_query("SELECT * FROM `course_level` where Course_Level_Id='$course[Course_Level_Id]'"));
	?>
    <tr align="center">
   		<?php if($i==1){?>
        <td rowspan="<?=$rowC?>" <?php if($rowC==1){?> colspan="2" <?php }?> >
        <strong><?=$courseLevelName['Course_Level_Name']?></strong>
        </td>
		<?php }
		if($rowC!=1){
		?>
        <td><?=$courseName['Course_Name']?></td>
        <?php }?>
        <td><?=$seat['SC_Filled']?></td>
        <td><?=$seat['SC']?></td>
        <td><?=$seat['ST_Filled']?></td>
        <td><?=$seat['ST']?></td>
        <td><?=$seat['OBC_A_Filled']?></td>
        <td><?=$seat['OBC_A']?></td>
        <td><?=$seat['OBC_B_Filled']?></td>
        <td><?=$seat['OBC_B']?></td>
        <td><?=$seat['Other_Filled']?></td>
        <td><?=$total?></td>
     </tr>
     <?php 
	 $i++;
	 }}?>
    
</table>


</td>
</tr>
</table>
<? include "footer.php";?>
