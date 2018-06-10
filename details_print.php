<?php
//include_once "header.php";
session_start();
include "online-admission/config.php";
if(!isset($_SESSION['application_no_id'])){
	
	?><script>window.location.href="application_login.php"</script><?php
}
if(isset($_REQUEST['submit'])=="Submit"){
	mysql_query("update `application_table` set Demand_Draft_No='$_REQUEST[chlnNo]' WHERE `Application_No` = '".$_SESSION['application_no_id']."'");
}
if(isset($_REQUEST['accept'])=="Accept"){
	mysql_query("update `application_table` set admit='2' WHERE `Application_No` = '".$_SESSION['application_no_id']."'");
}
$res_query=mysql_query("SELECT * FROM `application_table` WHERE `Application_No` = '".$_SESSION['application_no_id']."'");
$row_query=mysql_fetch_array($res_query);
?>


				  <!-- Col1 -->

                	<div class="col1">			

						 <div><img src="index_files/ban7.jpg"></div>		

                         <!-- Content Heading -->

                         	<div class="content_heading">

                            	<div class="heading"><h2 style="font-size:15px;font-weight:bold;">Students <span style="color:#888;">Application Panel</span></h2> </div>

                            </div>

                             <p>

	<table class="money_res"  border="0" width="100%">
    <tr bgcolor="#FFFFFF">
		<td><label><a href="online-admission/form_details.php" target="_blank" >Application Details</a> </label></td>
	
		<td><label><a href="online-admission/form.php"  target="_blank">Application Money Receipt</a> </label></td>
	
		<td><label><a href="logout.php" >Logout</a> </label></td>
	</tr>
 </table>		
 <br />			
  <br />		
   <br />
   <?php if($row_query['Demand_Draft_No']==""){?>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="f1">			 
<table width="100%">
	
    <tr>
		<td width="30%"><label><font size="-1">Demand Draft No/Challan No :</font></label></td>
		<td width="43%"><input type="text" id="chlnNo" name="chlnNo"  style="background-color: #00579A; color: #FFFFFF; font-size: 16px; font-family: arial; border: solid 1px #000000" value="<?=$row_query['Demand_Draft_No']?>"/></td><td width="27%"><input type="submit" name="submit" value="Submit" style="background-color: #090; color: #FFFFFF; font-size: 12px; font-family: arial; border: solid 5px #090"/></td>
	</tr>
 </table>
</form>
<?php }?>
<?php if($row_query['admit']==0 && $row_query['Bank_Payment_Verified']==1){?>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="f2">			
 <table width="100%" border="0">
 	<tr>
    <td>Application Form is verified. For further Progress Click On <input type="submit" name="accept" value="Accept" style="background-color: #090; color: #FFFFFF; font-size: 12px; font-family: arial; border: solid 5px #090"/> Button</td>
    </tr>
 </table>
</form>		
					</p>

                          <div class="clear"></div>

                    </div>

                 <!-- Col2 -->

                	<div class="col2">

                                 <?php //include_once "ads.php";?>   

                                </div>

 						<!--col2 ends -->			

              		</div>

                <div class="clear"></div>

			  <!-- Slder -->	

            	<div class="image_scroll">

                	<a class="leftarrow" href="#"><img src="index_files/left_arrow.gif" alt=""></a>

                    	<div style="visibility: visible; overflow: hidden; position: relative; z-index: 2; left: 0px; width: 920px;" class="slider1">

                        	<ul style="margin: 0pt; padding: 0pt; position: relative; list-style-type: none; z-index: 1; width: 3220px; left: -920px;"><li style="overflow: hidden; float: left; width: 190px; height: 68px;"><a href="#"><img src="index_files/slider3.gif" alt=""></a></li><li style="overflow: hidden; float: left; width: 190px; height: 68px;"><a href="#"><img src="index_files/slider4.gif" alt=""></a></li><li style="overflow: hidden; float: left; width: 190px; height: 68px;"><a href="#"><img src="index_files/slider5.gif" alt=""></a></li><li style="overflow: hidden; float: left; width: 190px; height: 68px;"><a href="#"><img src="index_files/slider6.gif" alt=""></a></li>

                    			<li style="overflow: hidden; float: left; width: 190px; height: 68px;"><a href="#"><img src="index_files/slider1.gif" alt=""></a></li>

                    			<li style="overflow: hidden; float: left; width: 190px; height: 68px;"><a href="#"><img src="index_files/slider2.gif" alt=""></a></li>

                    			<li style="overflow: hidden; float: left; width: 190px; height: 68px;"><a href="#"><img src="index_files/slider3.gif" alt=""></a></li>

                    			<li style="overflow: hidden; float: left; width: 190px; height: 68px;"><a href="#"><img src="index_files/slider4.gif" alt=""></a></li>

                                <li style="overflow: hidden; float: left; width: 190px; height: 68px;"><a href="#"><img src="index_files/slider5.gif" alt=""></a></li>

                                <li style="overflow: hidden; float: left; width: 190px; height: 68px;"><a href="#"><img src="index_files/slider6.gif" alt=""></a></li>

                    		<li style="overflow: hidden; float: left; width: 190px; height: 68px;"><a href="#"><img src="index_files/slider1.gif" alt=""></a></li><li style="overflow: hidden; float: left; width: 190px; height: 68px;"><a href="#"><img src="index_files/slider2.gif" alt=""></a></li><li style="overflow: hidden; float: left; width: 190px; height: 68px;"><a href="#"><img src="index_files/slider3.gif" alt=""></a></li><li style="overflow: hidden; float: left; width: 190px; height: 68px;"><a href="#"><img src="index_files/slider4.gif" alt=""></a></li></ul>

                        </div>  

                    <a class="rightarrow" href="#"><img src="index_files/right_arrow.gif" alt=""></a>

                </div>

            </div>	

		<div class="clear"></div>

	</div>

</div>   

<?php }
?> 