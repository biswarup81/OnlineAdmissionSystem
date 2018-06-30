<?Php
include "config.php";
session_start();


if(!isset($_SESSION['application_no_id'])){

	header('Location:application_login.php');
}
/*else {	
	$now = time();

	if ($now > $_SESSION['expire']) {
		session_destroy();
		header('Location: register.html');
	}
}*/

$res_query=mysql_query("SELECT * FROM `application_table` WHERE `Application_No` = '".$_SESSION['application_no_id']."'");
$row_query=mysql_fetch_array($res_query);
?>

<html><head>

<link type="text/css" rel="stylesheet" href="calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
<script type="text/javascript" src="calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">

<title>Applicant Details</title>



<style>
.Submit_reset{
	width:65px;
	height:30px;
	cursor:pointer;
	background-color: #FF9933;
	}

td { padding-left:20px; }

.sTD { background-color:#eee; }

.mTD { padding-left:0px;text-align:center; }



.style1 {







	color: #FF0000;







	font-weight: bold;







}







.style2 {color: #FF0000}







.style8 {color: #000000;

	font-weight: bold;



}

.style3 {font-size: x-small}

.style6 {color: #000000; font-weight: bold; font-size: 18px; }

.style9 {color: #0000FF}

.style10 {color: #000000}

.style12 {font-size: large}

.money_res {
	margin-top:50px;
}
.money_res tr:nth-child(even) td{
	background:#eee;
}	
.money_res tr:nth-child(odd) td{
	background:#fff;
}
.money_res .rem_bac_td td {
	background:none !important;
}
</style>
</head>
<body>
<center>
<table class="money_res"  border="0" width="0%">
	<tr class="rem_bac_td" bgcolor="#FF9933">
		<td colspan="2"><br />
		<font size="5"><strong><u>Kandra Radha Kanta Kundu Mahavidyalaya</u></strong> <br><br><strong>Applicant Details</strong> <br />
        Application No: <?=$row_query['Application_No'];?></font><br>
		&nbsp;</td>
	</tr>
   
    <tr bgcolor="#FFFFFF">
		<td width="200"><label>Name: </label></td>
		<td width="300" style="text-transform:uppercase;"><?=$row_query['First_Name']." ".$row_query['Middle_Name']." ".$row_query['Last_Name'];?></td>
	</tr>
    <tr>
		<td><label>Gender: </label></td>
		<td><?=$row_query['Gender'];?></td>
	</tr>
    <tr>
		<td><label>Guardian's Name: </label></td>
		<td style="text-transform:uppercase;"><?=$row_query['Gurdian_Name'];?></td>
	</tr>
    <tr>
		<td><label>Gurdian Relation : </label></td>
		<td><?=$row_query['Gurdian_Relation'];?></td>
	</tr>
     <?php if ($row_query['Gurdian_Mobile_No']!=""){?>
    <tr>
		<td><label>Mobile Number: </label></td>
		<td><?=$row_query['Gurdian_Mobile_No'];?></td>
	</tr>
    <?php }?>
    <tr>
		<td><label>Email ID: </label></td>
		<td><?=$row_query['email'];?></td>
	</tr>
    <tr>
		<td><label>Religion: </label></td>
		<td><?=$row_query['Religion'];?></td>
	</tr>
    <tr>
		<td><label>Nationality: </label></td>
		<td><?=$row_query['Nationality'];?></td>
	</tr>
    <tr>
		<td><label>Category: </label></td>
		<td><?=$row_query['Category'];?></td>
	</tr>
    <tr>
		<td><label>Date of Birth: </label></td>
		<td><?=$row_query['Date_Of_Birth'];?></td>
	</tr>
    <tr>
		<td><label>Physically Challenged: </label></td>
		<td><?=$row_query['Physically_Challenged'];?></td>
	</tr>
    <tr>
		<td><label>Address: </label></td>
		<td><?=$row_query['Address'];?></td>
	</tr>
    <tr>
		<td><label>Total_Marks: </label></td>
		<td><?=$row_query['Total_Marks'];?></td>
	</tr>
    <tr>
		<td><label>Application Fee: </label></td>
		<td><?=$row_query['Application_Fee'];?></td>
	</tr>
    <tr>
		<td><label>Demand Draft No: </label></td>
		<td><?=$row_query['Demand_Draft_No'];?></td>
	</tr>
    <tr>
		<td><label>Submit Date: </label></td>
		<td><?=$row_query['submit_date'];?></td>
	</tr>
    <tr>
		<td colspan="2" align="center"><button onClick="printpage()">Print</button>
<button onClick="window.location='details_print.php'">Back</button></td>
		
	</tr>
    
</table>
</center>
<script>
function printpage()
{
window.print();
}
</script>


</body>
</html>