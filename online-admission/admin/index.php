<?php 
include "top.php";
include "header.php";
include "../../classes/admin_class.php";

$admin = new admin_class();

$rowObj = $admin->getCollegeDetails();

?>
<p><strong>Welcome to <?php echo $rowObj->name ?> Administration Panel. Please click the menus on the left side to operate</strong></p>
<?php include "footer.php";?>