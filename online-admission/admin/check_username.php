<?php
include "top.php";
$username=$_GET['username'];

$sql=mysql_query("select * from `admin` where username='$username' and flag=0");
if(mysql_num_rows($sql)>0){
	$p=1;
	}
else{
	$p=0;
	}
echo $p;

?>