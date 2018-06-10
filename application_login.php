<?php
//error_reporting(0);
//include_once "header.php";
session_start();
include "online-admission/config.php";
$alert="";
if(isset($_SESSION['application_no_id'])){
			?><script>window.location.href="details_print.php"</script><?php
}
if(isset($_REQUEST['submit'])){
	$_SESSION['application_no_id'] = $_REQUEST['username'];
	$res_query=mysql_query("SELECT * FROM `application_table` WHERE `Application_No` = '".						$_SESSION['application_no_id']."'");
	$row_query=mysql_fetch_array($res_query);
	
	
	if($_REQUEST['username'] == $row_query['Application_No'] && $_REQUEST['password'] == $row_query['password']){
	//echo $_SESSION['application_no_id'];
	if(isset($_SESSION['application_no_id'])){
			?><script>window.location.href="details_print.php"</script><?php
	}
	
}else{
	unset($_SESSION['application_no_id']);
	session_destroy();
	$alert="Application ID or Password is Worng";
}
	//exit;
}

?>





<script type="text/javascript">
function validateForm(form)
{
	var user=form.username.value;
	var pass=form.password.value;
	document.getElementById("username_warning").innerHTML="";
	document.getElementById("password_warning").innerHTML="";
	
	var flag=1;
	if(user == "")
	{
		document.getElementById("username_warning").innerHTML="Please enter Username";
		flag=0;
	}
	if(pass == "")
	{
		document.getElementById("password_warning").innerHTML="Please enter Password";
		flag=0;
	}
	if(flag==0)
		return false;
	return true;
}

</script>


				  <!-- Col1 -->

                	<div class="col1">			

						 <div><img src="index_files/ban7.jpg"></div>		

                         <!-- Content Heading -->

                         	<div class="content_heading">

                            	<div class="heading"><h2 style="font-size:15px;font-weight:bold;">Students <span style="color:#888;">Login :</span></h2> </div>

                            </div>

                             <p>
<br /><br /><br /><br /><br />
			<table width="100%" >
<tr><td align="center">
<form name="login_form" method="post" onSubmit="return validateForm(this);">
    <table style="padding:20px;border:solid 1px #F63;">
           
                <tbody>
                <tr><td colspan="3" style="color:red;font-size:14px;"><?=$alert?></td></tr>
                <tr><td>Application ID</td><td>:</td><td><input type="text" id="username" name="username" style="background-color:#FF9" ><div id="username_warning" style="color:red;font-size:11px;"></div>	</td></tr>
                
                <tr><td>Password</td><td>:</td><td><input type="password" id="password" name="password" style="background-color:#FF9" ><div id="password_warning" style="color:red;font-size:11px;"></div>	</td></tr>
                
                <tr>
                    <td></td><td></td><td><input type="submit" value="SUBMIT" name="submit"  style="border:none; padding-left:27px; padding-right:26px;" ></td>
                </tr>
    </tbody></table>
    </form>
</td></tr></table>			 


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

<?php //include_once "footer.php";?> 















