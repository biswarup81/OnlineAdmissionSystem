<?php
include"top.php";
include"header.php";
$sort_fieldname='id desc';
$table="application_table";
$admin_pagelist=10;
$search_para="Show All Records";
$action=$_REQUEST['action'];

if($action=="delete")
{
	$id=$_REQUEST['id'];
	//q("DELETE FROM dt_epin_request WHERE id='$id'");
	header("location:".$_SERVER['PHP_SELF']);
	exit();

}

/*Search Block*/

$where_field.=' and 1 ';
if($action=='search')
{
	//print_r(extract($_POST));
	
	if(isset($_POST['start_dt']) && $_POST['start_dt']<>"")
	{
		$start_dt=$_POST['start_dt'];
		$where_field.=" AND submit_date>='".date("Y-m-d",strtotime(($_POST['start_dt'])))."'";
	
	}
	if(isset($_POST['to_dt']) && $_POST['to_dt'])
	{
		$to_dt=$_POST['to_dt'];
		$where_field.=" AND submit_date<='".date("Y-m-d",strtotime(($_POST['to_dt'])))."'";
	}
	
	if(isset($_POST['appNo']) && $_POST['appNo'])
	{
		echo "fg";
		$appNo=$_POST['appNo'];
		$where_field.=" AND Application_No like '%".$_POST['appNo']."%'";
	}
	
}
/*Make Where Clause*/

$where_field=" WHERE 1".$where_field;
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
  			<table cellpadding="0" cellspacing="0" align="left" width="100%" >
				<form action="<?=$_SERVER['PHP_SELF']?>" style="margin:0px; padding:0px " id="f1" name="f1" method="post" >				
				<input type="hidden" name="action" value="search" />
				<tr>
                        
                    <td>
                   <table width="100%">
                   <tr>
                   <td>
                    Application No : <input type="text" name="appNo" id="appNo" value="<?=$appNo?>"/>			
                    </td><td>
                    From Date : <input type="text" name="start_dt" id="start_dt" value="<?=$start_dt?>" size="10" readonly="readonly" /> <img src="images/img.gif" id="date1" alt="Click to pickup date"  border="0"/>
					</td><td>To Date : <input type="text" name="to_dt" id="to_dt" value="<?=$to_dt?>" size="10" readonly="readonly" /> <img src="images/img.gif" id="date2" alt="Click to pickup date"  border="0"/>
					</td><td>
                    <input class="form_button" type="submit" name="submit" value="Search">
                    </td>
                    <tr>
                    </table>
                </tr>
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
				$sql=q(" SELECT * FROM $table order by $sort_fieldname ");
				//$sql=q(" SELECT * FROM dt_epin_request order by user_id desc ");
			    
				$rec_count=(int)nr($sql);
	?>			
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%" align="left">
				  <td width="40%" class="caption">: Admission List </td>
				    <td class="endcap"></td>
				<td style="padding-left:10px;" align="right"></td>
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
					
                    <tr>
						<td width="2%" class="colhead">#</td>
						<td width="10%" class="colhead"> Name </td>
						<td width="5%" class="colhead">Mobile</td>	
						<td width="8%" class="colhead">Application Fee </td>		
                        <td width="8%" class="colhead">Address</td>
                        <td width="8%" class="colhead">Pin</td>
						<td width="8%" class="colhead">Application No</td>	
						<td width="8%" class="colhead">Submit Date</td>
						<td width="8%" align="center"><strong>Action</strong></td>		
                    </tr>
                    
                    <? $q_arr=q($search_query);
					if($page_num==1){
						$slno=1;
					}else{
						$slno=1+($admin_pagelist*($page_num-1));
						}
                    while($f_arr=f($q_arr))
					{
						
						
					?>
                    <tr bgcolor="#ffffff" onMouseOver=bgColor="#EFF7FF" onMouseOut=bgColor="#ffffff">
                        <td style="padding-left:5px;"><? echo $slno;?></td>
						
						<td style="padding-left:5px;"><? echo stripslashes($f_arr['First_Name']);?></td>
						<td style="padding-left:5px;"><? echo stripslashes($f_arr['Gurdian_Mobile_No']);?></td>
						<td style="padding-left:5px;"><? echo stripslashes($f_arr['Application_Fee']);?></td>
                        <td style="padding-left:5px;"><? echo stripslashes($f_arr['Address']);?></td>
                        <td style="padding-left:5px;"><? echo stripslashes($f_arr['ZIP_PIN']);?></td>
						<td style="padding-left:5px;"><? echo stripslashes($f_arr['Application_No']);?></td>
						<td style="padding-left:5px;"><? echo stripslashes(date("d-M-Y",strtotime($f_arr['submit_date'])));?></td>
						<td style="padding-left:5px;" align="center">
                        <?php if($f_arr['admit']==0){?>
							<a href="view.php?action=view&id=<?php echo $f_arr['id'];?>">View</a>
                            ||
							<a href="<?php echo $_SERVER['PHP_SELF']?>?action=delete&id=<?php echo $f_arr['id'];?>" onclick="return confirm('Delete this request?');">Delete</a>
                            <?php }else{
								echo "Admitted";
								}?>
                            </td>
                    </tr>
					<tr id="tr_<?php echo $f_arr['id'];?>" style="display:none">
						<td colspan="16" align="right" style="padding-right:50px;" id="td_<?php echo $f_arr['id'];?>" ><span><strong>Generated E-PIN:&nbsp;</strong></span><span id="sp_pin_<?php echo $f_arr['id'];?>" style="color:#FF0000; font-weight:bold; font-size:12px;"></span></td>
					</tr>
                    <?  $slno++; }?>
                    
                  	<tr>
						<td align="center" colspan="16">
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
<script type="text/javascript">
function generate_epin(user_id)
{
	if(confirm('Generate E PIN now?'))
	{
		$("#tr_"+user_id).show();
		$('#sp_pin_'+user_id).load('<?php echo "ajx_generate_epin.php?user_id=";?>'+user_id);	
	
	
	}

}

Calendar.setup({
	inputField     :    "start_dt",
	ifFormat       :    "<?=CAL_DF?>",
	button         :     "date1",
	align          :    "",
	singleClick    :     true
	});

Calendar.setup({
	inputField     :    "to_dt",
	ifFormat       :    "<?=CAL_DF?>",
	button         :     "date2",
	align          :    "",
	singleClick    :     true
	});


</script>

<? include "footer.php";?>	