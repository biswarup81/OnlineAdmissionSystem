<?php
include("config.php");
session_start();
//print_r($_SESSION);
$appDetails_q=mysql_query("select * from application_table where Application_No='".$_SESSION['application_no_id']."'");
$appDetails=mysql_fetch_array($appDetails_q);
?>

<script>
function printpage()
{
	document.getElementById("printBtn").style.display="none";
	window.print();
}
</script>

<table width="900"  border="1" bordercolor="#000" cellpadding="0" cellspacing="0" style="page-break-after:always;">
  <tr>
    <td><table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td rowspan="4" width="200"><img src="../index_files/logo.gif" width="200" height="70"></td>
  </tr>
  <tr>
    <td align="center"><b>*Slip No : ____________________</b> &nbsp;&nbsp;&nbsp;&nbsp; <u>STUDENT COPY</u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>CODE : _________________________</b></td>
  </tr>
   
 
  <tr>
    <td align="center"><b>KANDRA RADHA KANTA KUNDU MAHAVIDYALAYA</b><br />ESTD:2001 <br />KANDRA,BURDWAN</td>
  </tr>
    <tr>
    <td><b>Deposit at Bank: _________________ Branch:_________________</b></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td><table width="900" border="0">
  <tr>
    <td width="116"><b>Admn. No :</b> </td>
    <td width="474"><b><?=strtoupper($appDetails['Application_No'])?></b></td>
    <td width="296"><b>Date :</b> <?=date("d/m/Y")?></td>
  </tr>
  <tr>
    <td><b>Name :</b> </td>
    <td><?=strtoupper($appDetails['First_Name']);?>&nbsp;<?=strtoupper($appDetails['Middle_Name'])?>&nbsp;<?=strtoupper($appDetails['Last_Name'])?></td>
    <td><b>Class :</b> </td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td><table width="900" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="400">Admission Fee</td>
    <td width="280" align="right"><?php 
	$sessionname=mysql_fetch_array(mysql_query("SELECT * FROM `session_table` WHERE `SessionId`='$appDetails[session_id]'"));
	echo $sessionname['Session_Name'];
	?></td>
    <td width="20" align="center"><b><del>&#2352;</del></b></td>
    <td width="200" align="right"><b><?php
    $appfee=$appDetails['Application_Fee'];
	if($appfee==null){ $appfee=0;}
	echo number_format($appfee,2)?></b></td>
  </tr>
  <tr>
    <td>To be paid by <b><?php echo date("d/m/Y");?></b></td>
    <td align="right"><b>Total</b></td>
    <td align="center"><b><del>&#2352;</del></b></td>
    <td align="right"><b><?php echo number_format($appfee,2);?></b></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td align="center">After <?php echo date("d/m/Y");?> Fees with late fine must be deposite as follow : </td>
  </tr>
  <tr>
    <td>
    <table width="900" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="180" align="center"><?php echo date("d/m/Y");?></td>
    <td width="180" align="center"><?php echo date("d/m/Y");?></td>
    <td width="180" align="center"><?php echo date("d/m/Y");?></td>
    <td width="180" align="center"><?php echo date("d/m/Y");?></td>
    <td width="180" align="center"><?php echo date("d/m/Y");?></td>
  </tr>
  <tr>
    <td align="center">Late Fine <b><del>&#2352;</del></b></td>
    <td align="center">200.00</td>
    <td align="center">200.00</td>
    <td align="center">200.00</td>
    <td align="center">200.00</td>
  </tr>
  <tr>
    <td align="center">Total <b><del>&#2352;</del></b></td>
    <td align="center"><b>200.00</b></td>
    <td align="center"><b>200.00</b></td>
    <td align="center"><b>200.00</b></td>
    <td align="center"><b>200.00</b></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td><table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">By Cash <input type="checkbox" name="by_csah" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pay Order <input type="checkbox" name="pay_order" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;&nbsp; ___________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date : ___________________________</td>
  </tr>
  <tr>
    <td align="center">Drawn On&nbsp;&nbsp; _______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bank&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ________________________________  Brunch</td>
  </tr>
  <tr>
    <td  align="center">for Rupees ________________________________________________________________________________________ Only</td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td align="center">Please Draw Pay Order in favor of<br />
    <b>"KANDRA RASHA KANTA KUNDU MAHAVIDYALAYA"</b> </td>
  </tr>
  <tr>
    <td style="list-style: square;">
    	<ul>
        	<li><b>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</b></li>
            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
        </ul>
    </td>
  </tr>
    <tr>
    <td align="center"><b>* Lorem Ipsum is simply dummy text of the printing and typesetting industry.</b> </td>
  </tr>
</table>

<table width="900"  border="1" bordercolor="#000" cellpadding="0" cellspacing="0"  style="page-break-after:always;">
  <tr>
    <td><table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td rowspan="4" width="200"><img src="../index_files/logo.gif" width="200" height="70"></td>
  </tr>
  <tr>
    <td align="center"><b>*Slip No : ____________________</b> &nbsp;&nbsp;&nbsp;&nbsp; <u>BANK COPY</u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>CODE : _________________________</b></td>
  </tr>
   
 
  <tr>
    <td align="center"><b>KANDRA RADHA KANTA KUNDU MAHAVIDYALAYA</b><br />ESTD:2001 <br />KANDRA,BURDWAN</td>
  </tr>
    <tr>
    <td><b>Deposit at Bank: _________________ Branch:_________________</b></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td><table width="900" border="0">
  <tr>
    <td width="116"><b>Admn. No :</b> </td>
    <td width="474"><b><?=strtoupper($appDetails['Application_No'])?></b></td>
    <td width="296"><b>Date :</b> <?=date("d/m/Y")?></td>
  </tr>
  <tr>
    <td><b>Name :</b> </td>
    <td><?=strtoupper($appDetails['First_Name']);?>&nbsp;<?=strtoupper($appDetails['Middle_Name'])?>&nbsp;<?=strtoupper($appDetails['Last_Name'])?></td>
    <td><b>Class :</b> </td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td><table width="900" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="400">Admission Fee</td>
    <td width="280" align="right"><?php 
	$sessionname=mysql_fetch_array(mysql_query("SELECT * FROM `session_table` WHERE `SessionId`='$appDetails[session_id]'"));
	echo $sessionname['Session_Name'];
	?></td>
    <td width="20" align="center"><b><del>&#2352;</del></b></td>
    <td width="200" align="right"><b><?php
    $appfee=$appDetails['Application_Fee'];
	if($appfee==null){ $appfee=0;}
	echo number_format($appfee,2)?></b></td>
  </tr>
  <tr>
    <td>To be paid by <b><?php echo date("d/m/Y");?></b></td>
    <td align="right"><b>Total</b></td>
    <td align="center"><b><del>&#2352;</del></b></td>
    <td align="right"><b><?php echo number_format($appfee,2);?></b></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td align="center">After <?php echo date("d/m/Y");?> Fees with late fine must be deposite as follow : </td>
  </tr>
  <tr>
    <td>
    <table width="900" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="180" align="center"><?php echo date("d/m/Y");?></td>
    <td width="180" align="center"><?php echo date("d/m/Y");?></td>
    <td width="180" align="center"><?php echo date("d/m/Y");?></td>
    <td width="180" align="center"><?php echo date("d/m/Y");?></td>
    <td width="180" align="center"><?php echo date("d/m/Y");?></td>
  </tr>
  <tr>
    <td align="center">Late Fine <b><del>&#2352;</del></b></td>
    <td align="center">200.00</td>
    <td align="center">200.00</td>
    <td align="center">200.00</td>
    <td align="center">200.00</td>
  </tr>
  <tr>
    <td align="center">Total <b><del>&#2352;</del></b></td>
    <td align="center"><b>200.00</b></td>
    <td align="center"><b>200.00</b></td>
    <td align="center"><b>200.00</b></td>
    <td align="center"><b>200.00</b></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td><table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">By Cash <input type="checkbox" name="by_csah" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pay Order <input type="checkbox" name="pay_order" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;&nbsp; ___________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date : ___________________________</td>
  </tr>
  <tr>
    <td align="center">Drawn On&nbsp;&nbsp; _______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bank&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ________________________________  Brunch</td>
  </tr>
  <tr>
    <td  align="center">for Rupees ________________________________________________________________________________________ Only</td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td align="center">Please Draw Pay Order in favor of<br />
    <b>"KANDRA RASHA KANTA KUNDU MAHAVIDYALAYA"</b> </td>
  </tr>
  <tr>
    <td style="list-style: square;">
    	<ul>
        	<li><b>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</b></li>
            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
        </ul>
    </td>
  </tr>
    <tr>
    <td align="center"><b>* Lorem Ipsum is simply dummy text of the printing and typesetting industry.</b> </td>
  </tr>
</table>

<table width="900"  border="1" bordercolor="#000" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td rowspan="4" width="200"><img src="../index_files/logo.gif" width="200" height="70"></td>
  </tr>
  <tr>
    <td align="center"><b>*Slip No : ____________________</b> &nbsp;&nbsp;&nbsp;&nbsp; <u>COLLEGE COPY</u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>CODE : _________________________</b></td>
  </tr>
   
 
  <tr>
    <td align="center"><b>KANDRA RADHA KANTA KUNDU MAHAVIDYALAYA</b><br />ESTD:2001 <br />KANDRA,BURDWAN</td>
  </tr>
    <tr>
    <td><b>Deposit at Bank: _________________ Branch:_________________</b></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td><table width="900" border="0">
  <tr>
    <td width="116"><b>Admn. No :</b> </td>
    <td width="474"><b><?=strtoupper($appDetails['Application_No'])?></b></td>
    <td width="296"><b>Date :</b> <?=date("d/m/Y")?></td>
  </tr>
  <tr>
    <td><b>Name :</b> </td>
    <td><?=strtoupper($appDetails['First_Name']);?>&nbsp;<?=strtoupper($appDetails['Middle_Name'])?>&nbsp;<?=strtoupper($appDetails['Last_Name'])?></td>
    <td><b>Class :</b> </td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td><table width="900" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="400">Admission Fee</td>
    <td width="280" align="right"><?php 
	$sessionname=mysql_fetch_array(mysql_query("SELECT * FROM `session_table` WHERE `SessionId`='$appDetails[session_id]'"));
	echo $sessionname['Session_Name'];
	?></td>
    <td width="20" align="center"><b><del>&#2352;</del></b></td>
    <td width="200" align="right"><b><?php
    $appfee=$appDetails['Application_Fee'];
	if($appfee==null){ $appfee=0;}
	echo number_format($appfee,2)?></b></td>
  </tr>
  <tr>
    <td>To be paid by <b><?php echo date("d/m/Y");?></b></td>
    <td align="right"><b>Total</b></td>
    <td align="center"><b><del>&#2352;</del></b></td>
    <td align="right"><b><?php echo number_format($appfee,2);?></b></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td align="center">After <?php echo date("d/m/Y");?> Fees with late fine must be deposite as follow : </td>
  </tr>
  <tr>
    <td>
    <table width="900" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="180" align="center"><?php echo date("d/m/Y");?></td>
    <td width="180" align="center"><?php echo date("d/m/Y");?></td>
    <td width="180" align="center"><?php echo date("d/m/Y");?></td>
    <td width="180" align="center"><?php echo date("d/m/Y");?></td>
    <td width="180" align="center"><?php echo date("d/m/Y");?></td>
  </tr>
  <tr>
    <td align="center">Late Fine <b><del>&#2352;</del></b></td>
    <td align="center">200.00</td>
    <td align="center">200.00</td>
    <td align="center">200.00</td>
    <td align="center">200.00</td>
  </tr>
  <tr>
    <td align="center">Total <b><del>&#2352;</del></b></td>
    <td align="center"><b>200.00</b></td>
    <td align="center"><b>200.00</b></td>
    <td align="center"><b>200.00</b></td>
    <td align="center"><b>200.00</b></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td><table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">By Cash <input type="checkbox" name="by_csah" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pay Order <input type="checkbox" name="pay_order" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;&nbsp; ___________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date : ___________________________</td>
  </tr>
  <tr>
    <td align="center">Drawn On&nbsp;&nbsp; _______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bank&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ________________________________  Brunch</td>
  </tr>
  <tr>
    <td  align="center">for Rupees ________________________________________________________________________________________ Only</td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td align="center">Please Draw Pay Order in favor of<br />
    <b>"KANDRA RASHA KANTA KUNDU MAHAVIDYALAYA"</b> </td>
  </tr>
  <tr>
    <td style="list-style: square;">
    	<ul>
        	<li><b>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</b></li>
            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
        </ul>
    </td>
  </tr>
    <tr>
    <td align="center"><b>* Lorem Ipsum is simply dummy text of the printing and typesetting industry.</b> </td>
  </tr>
</table>
<button onClick="printpage()" id="printBtn">Print</button>