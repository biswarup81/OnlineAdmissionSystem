<?php 
include "top.php";
include "header.php";
$sort_fieldname='CourseId desc';
$table="course_table";
$listPage="course_list.php";
$addPage="course_add.php";

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
			 $where_field =" and `".$search_for."` like '%".$search_by."%'";	
			}
	
}

/*Make Where Clause*/

$where_field=" WHERE 1 ".$where_field;


#############################################


/*$action=$_REQUEST['action'];

if($action=='active')
{
	$id=$_REQUEST['active_id'];
	mysql_query("UPDATE `user` SET `flag`='0' WHERE `id`='$id'");
	header("location:list_customer.php");
}

######Inactive Record Block#####

if($action=='inactive')
{
	$id=$_REQUEST['inactive_id'];
	mysql_query("UPDATE `user` SET `flag`='1' WHERE `id`='$id'");
	header("location:list_customer.php");
}*/


?>
<table cellpadding="0" cellspacing="0" width="100%" align="center" border="0" >	
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="40%" align="left">
				<td width="90%" class="caption">: Advance Search</td>
				<td class="endcap"></td>
			</table>
		</td>
	</tr>
	<tr>
		<td class="mainarea">		
  			<table cellpadding="0" cellspacing="0" width="70%" align="center">
            <form name="f1" method="post" action="<?=$listPage?>?action=search">
				<tr>
                <td width="25%"><select name="search_for">
                <option value="" <?php if($search_for==''){?> selected="selected"<?php }?>>Search For</option>
                <option value="CourseId" <?php if($search_for=="CourseId"){?> selected="selected"<?php }?>>Course Id</option>
                <option value="Course_Name" <?php if($search_for=="Course_Name"){?> selected="selected"<?php }?>>Course Name</option>
                </select></td>
                <td width="25%"><input type="text" name="search_by" size="30" placeholder="Search By" value="<?php echo $search_by;?>"></td>
                <td width="25%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Search" class="form_button"></td></tr>
            </form>				
			</table>
           </td>
	</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" width="100%" align="center" border="0" >	
	 <?
				//PAGINATION  SCRIPT HERE*********************************
				$page_num=$_GET["page_num"];
				if(!isset($from))
				{
					$from=0;
				}
				$sql=q("SELECT * FROM $table ".$where_field." order by $sort_fieldname");
			
				$rec_count=(int)nr($sql);
	?>			
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%" align="left">
				  <td width="40%" class="caption">:Course List </td>
				    <td class="endcap"></td>
				<td style="padding-left:10px;" align="right"><a href="<?=$addPage?>?edit=2">Add New Course</a></td>
				<td align="left"></td>
			</table>
		</td>
	</tr>    
	<tr>
		<td class="mainarea" align="Left">		
        	<table cellpadding="5" cellspacing="5" align="center" width="98%" border="1" style="border-collapse:collapse;" bordercolor="#cacaca" >
            	
               <?	
				$page_count = 0;
				$show_rec_per_page=$admin_pagelist;//$config["listings_per_page"];
				
				if($show_rec_per_page >= $rec_count)
				{
					$search_query = "SELECT * FROM $table ".$where_field." ORDER BY $sort_fieldname";
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
					$search_query = "SELECT * FROM $table ".$where_field." ORDER BY $sort_fieldname limit $from, $show_rec_per_page";
				
				}	
				//echo $search_query;
				$tot_rec=(int)nr(q($search_query));
				if($tot_rec<>0)
				{
					
				?>
					
                 <tr align="center" class="colhead">
                	<td width="6%">Sl.</td>
                    
                    <td width="24%">Subject Name</td>
                    <td width="26%">Action</td>
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
	                    <td><?php echo $f_arr['Course_Name'];?></td>
                        <td align="center"><!--<a href="item_view?id=<?php echo $f_arr['id'];?>"><image src="images/view.png" width="20" height="20" ></a>&nbsp;&nbsp;<image src="images/pa.jpg" width="3" height="20">-->&nbsp;&nbsp;<a href="<?=$addPage?>?id=<?php echo $f_arr['CourseId'];?>&edit=1"><image src="images/edit.png" width="20" height="20"></a>&nbsp;&nbsp;
                       <?php $itemQuery = mysql_fetch_array(mysql_query("SELECT COUNT(*) as `count` FROM `stock` WHERE `item_id`='".$f_arr['id']."'"));
					   
					   			if($itemQuery['count']>0){}else{
					   ?> 
                        <image src="images/pa.jpg" width="3" height="20">&nbsp;&nbsp;<a href="item_delete?id=<?php echo $f_arr['CourseId'];?>"><image src="images/delete.png" width="20" height="20"></a>
                       <?php }?> 
                        
                        </td>
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