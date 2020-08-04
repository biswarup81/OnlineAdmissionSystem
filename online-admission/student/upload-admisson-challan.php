<?php
session_start();
if(!isset($_SESSION['user_id'])){
	header("Location:logout.php");
}
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Admisson Challan</title>
</head>
<body>
<?php if(isset($_GET["application_num"]) && !empty($_GET["application_num"])){?>
    <form action="upload-manager.php" method="post" enctype="multipart/form-data">
        <h2>Upload Admisson Challan Scan Copy for #<?php echo $_GET["application_num"] ?></h2>
        <label for="adm-challan">Filename:</label>
        <input type="file" name="adm-challan" id="adm-challan">
		<input type="hidden" name="user_id" id="user-id" value="<?php echo $user_id;?>">
		<input type="hidden" name="app-no" value="<?php echo $_GET["application_num"] ?>"/>
		<input type="hidden" name="frm-type" value="AdmissonChallan"/>
		<input type="hidden" name="fld-id" value="adm-challan"/>
        <input type="submit" name="submit" value="Upload">
        <p><strong>Note:</strong> Only .jpg  formats allowed to a max size of 5 MB.</p>
    </form>
<?php }else { echo "Invalid application number";}?>
</body>
</html>
