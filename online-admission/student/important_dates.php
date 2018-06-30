<?php 
include "top.php";
include "header.php";
include "../../classes/admin_class.php";
$admin = new admin_class();
$important_dates = $admin->getConstant("IMPORTANT_DATES");
?>

<div align="justify" >
<?php echo $important_dates ; ?>
</div>
<?php include "footer.php";?>