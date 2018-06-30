<?php 
include "top.php";
include "header.php";
include "../../classes/admin_class.php";
$admin = new admin_class();
$helpDesk = $admin->getConstant("HELP_DESK");
?>

<div align="justify" >
<?php echo $helpDesk ; ?>
</div>
<?php include "footer.php";?>