<?php 
ob_start();
require "../classes/config.php";
require "../classes/mysql.php";
require "../classes/functions.php";
require "../classes/conn.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Kandra RKK Mahavidyalaya :: Merit List</title>
</head>

<body style="margin:2px;">
<?php

$sort_fieldname='c.id desc';
$table="course_seat_structure as c,course_table as ct,course_level as cl";

$action=$_REQUEST['action'];

$where_field.='';

if($action=='search')
{
		
		if(isset($_REQUEST['submit']))
			{
			$search_by=$_REQUEST['search_by'];
			
			$search_for=$_REQUEST['search_for'];
			}
		if($search_by != '' && $search_for != '')
			{
			 $where_field =" and ".$search_for." like '%".$search_by."%'";	
			}
	
}

/*Make Where Clause*/

$where_field=" WHERE 1 and c.Course_Level_Id=cl.Course_Level_Id and c.Course_Id=ct.CourseId and cl.Course_Level_Id not in (11,12) ".$where_field;




?>

<br />
<table cellpadding="0" cellspacing="0" width="100%" align="center" border="0" >	
	 <?
				
				//echo "SELECT * FROM $table ".$where_field." order by $sort_fieldname";
				$sql=q("SELECT cl.Course_Level_Name, ct.Course_Name, c.Course_Level_Id, c.Course_Id FROM $table ".$where_field." order by $sort_fieldname");
			
				$rec_count=(int)nr($sql);
	?>			
	 
	<tr>
		<td class="mainarea">		
        	<table cellpadding="5" cellspacing="5" align="center" width="98%" border="1" style="border-collapse:collapse;" bordercolor="#cacaca" >
            	
               <?	
				
				
				$search_query = "SELECT cl.Course_Level_Name, ct.Course_Name, c.Course_Level_Id, c.Course_Id FROM $table ".$where_field." ORDER BY $sort_fieldname";
				
				//echo $search_query;
				$tot_rec=(int)nr(q($search_query));
				if($tot_rec<>0)
				{
					
				?>
					
                 <tr align="center" class="colhead">
                	<td width="6%">Sl.</td>
                    <td width="18%">Course Level</td>
                    <td width="12%">Course Name</td>
                    <td width="6%"></td>
                   
                    
                </tr>
                    
                    <?php 
					 $q_arr=q($search_query);
					$slno=0;
                    while($f_arr=f($q_arr))
					{
						$slno++;
						
					?>
                    <tr align="center" bgcolor="<?php echo $bg;?>" onMouseOver=bgColor="#EFF7FF" onMouseOut=bgColor="<?php echo $bg;?>">
						<td><?php echo $slno;?></td>
                        <td><?php
						//$cl=$f_arr['Course_Level_Id'];
						//$fcl=mysql_fetch_array(mysql_query("select * from course_level where Course_Level_Id='$cl'"));
						echo $f_arr['Course_Level_Name'];?></td>
                        <td>
						<?php
						//$cl=$f_arr['Course_Id'];
						//$fcl=mysql_fetch_array(mysql_query("select * from course_table where CourseId='$cl'"));
						echo $f_arr['Course_Name'];?></td>
						<td width="6%"><a href='merit_List.php?COURSE=<?php echo $f_arr['Course_Id'] ; ?>&COURSE_LEVEL=<?php echo $f_arr['Course_Level_Id']; ?>'>View</a></td>
                       </tr>
					
                    <?php }?>
                    
                  	
                 <? }else{
					 $ERmsg="No record found!";
				 }?>   
			</table>
		</td>
	</tr>
</table>


</body>
</html>
