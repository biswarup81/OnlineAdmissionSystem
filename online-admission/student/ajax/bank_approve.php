<?php
include("../../../classes/config.php");
include "../../../classes/conn.php";
include ("../../../classes/admin_class.php");
mysql_query("UPDATE `application_table` SET `Bank_Payment_Verified`=1 where `id`='".$_REQUEST[id]."'");
?>