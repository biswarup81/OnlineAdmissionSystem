<?php 
include "top.php";
include "header.php";
$sort_fieldname='c.id desc';
$table="fee_structure as c,course_table as ct,course_level as cl";
$listPage="fee_structure_list.php";
$addPage="fee_structure_add.php";

$search_para="Show All Records";
$action=$_REQUEST['action'];
//print_r($_SESSION);
/*Search Block*/

$where_field.='';
/*if($action=='search')
{
	extract($_POST);
	if(isset($_POST['start_dt']) && $_POST['start_dt']<>"")
	{
		$where_field.=" AND create_date>='".changeDate_YMD($_POST['start_dt'])."'";
	
	}
	if(isset($_POST['to_dt']) && $_POST['to_dt'])
	{
		$where_field.=" AND create_date<='".changeDate_YMD($_POST['to_dt'])."'";
	}
	
}*/
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

$where_field=" WHERE 1 and c.Course_Level_Id=cl.Course_Level_Id and c.Course_Id=ct.CourseId ".$where_field;


#


?>

<br />
<table cellpadding="0" cellspacing="0" width="100%" align="center" border="0" >	
	 <?
				//PAGINATION  SCRIPT HERE*********************************
				$page_num=$_GET["page_num"];
				if(!isset($from))
				{
					$from=0;
				}
				//echo "SELECT * FROM $table ".$where_field." order by $sort_fieldname";
				$sql=q("SELECT cl.Course_Level_Name, ct.Course_Name, c.TOTAL_FEE FROM $table ".$where_field." order by $sort_fieldname");
			
				$rec_count=(int)nr($sql);
	?>			
	    
	<tr>
		<td class="mainarea" align="Left">		
        	<table cellpadding="5" cellspacing="5" align="center" width="98%" border="1" style="border-collapse:collapse;" bordercolor="#cacaca" >
            	
               <?	
				$page_count = 0;
				$show_rec_per_page=$admin_pagelist;//$config["listings_per_page"];
				
				if($show_rec_per_page >= $rec_count)
				{
					$search_query = "SELECT cl.Course_Level_Name, ct.Course_Name, c.TOTAL_FEE FROM $table ".$where_field." ORDER BY $sort_fieldname";
				}
				else
				{
					$page_count = $rec_count / $show_rec_per_page;
					$page_count = ceil($page_count);
					settype($page_num, "int");
					if(!$page_num){$page_num++;}					
					if($page_num > $page_count)
					{
						$page_num = $page_count;		
					}	
					$from = ($page_num - 1) * $show_rec_per_page;
					$search_query = "SELECT cl.Course_Level_Name, ct.Course_Name, c.TOTAL_FEE FROM $table ".$where_field." ORDER BY $sort_fieldname limit $from, $show_rec_per_page";
				
				}	
				//echo $search_query;
				$tot_rec=(int)nr(q($search_query));
				if($tot_rec<>0)
				{
					
				?>
					
                 <tr align="center" class="colhead">
                	<td width="6%">Sl.</td>
                    <td width="24%">Course Level</td>
                    <td width="24%">Course Name</td>
                    <td width="24%">Fee Structure</td>
                    
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
                        <td><?php
						//$cl=$f_arr['TOTAL_FEE'];
						//$fcl=mysql_fetch_array(mysql_query("select * from subject_master where Subject_Id='$cl'"));
						echo "Rs. ".$f_arr['TOTAL_FEE'];?><?php echo $f_arr[''];?></td>
                        
                     </tr>
					
                    <?php }?>
                    
                  	<tr>
						<td align="center" colspan="10">
							<table align="center" width="100%" class="page_link_table" >	
								<tr><td align=center> 
								<? 
									$npages = $page_count;
									$p = $page_num;
									if ($npages > 1)
									{
										$params = "";
										$pages = "";
										foreach($_REQUEST as $k => $v)
										{
											if($k == "page_num") continue;
												$params .= "$k=$v&";
										}
											
										$pages .= "Page: ";
										if ($p != 1) $pages .= '<a href="'.$_SERVER['PHP_SELF'].'?'.$params.'page_num='.($p-1).'"><b>Previous</b></a>&nbsp;&nbsp;';
										
										$lend = floor($p/10)*10;
										if ($lend < 1) $lend = 1;
										if ($npages > 19)
										{
											$hend = $lend + 19;
											if ($hend > $npages) $hend = $npages;
										}
										else $hend = $npages;				
										for ($i = $lend; $i <= $hend; $i++)
										{
											if ($i == $p) $pages .= $i."&nbsp;";
											else $pages .= '<a href="'.$_SERVER['PHP_SELF'].'?'.$params.'page_num='.$i.'">'.$i.'</a>&nbsp;';
										}				
										if ($p != $npages) $pages .= '&nbsp;&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?'.$params.'page_num='.($p+1).'"><b>Next</b></a>&nbsp;&nbsp;';
									}
								?>
								</td></tr>
								<? if($pages) 
								{ ?>				 
									<tr>
										<td   align="center" colspan="5"><?= $pages ?></td>
									</tr>
									<tr>
										<td  align="center" colspan="5"></td>
									</tr>
								<? }?>
							</table>		
							<input type="hidden" name="pageno" value="<? echo $p;?>">
                          </td>
					</tr>  
                 <? }else{
					 $ERmsg="No record found!";
				 }?>   
			</table>
		</td>
	</tr>
</table>

<? include "footer.php";?>