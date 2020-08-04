<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Application Challan</title>
</head>
<body>
<?php if(isset($_GET["application_num"]) && !empty($_GET["application_num"])){?>
    <form action="upload-manager.php" method="post" enctype="multipart/form-data">
        <h2>Upload Application Challan Scan Copy of #<?php echo $_GET["application_num"] ?></h2>
        <label for="app-challan">Filename:</label>
        <input type="file" name="app-challan" id="app-challan">
		<input type="hidden" name="app-no" value="<?php echo $_GET["application_num"] ?>"/>
		<input type="hidden" name="frm-type" value="ApplicationChallan"/>
		<input type="hidden" name="fld-id" value="app-challan"/>
        <input type="submit" name="submit" value="Upload">
        <p><strong>Note:</strong> Only .jpg, .pdf formats allowed to a max size of 5 MB.</p>
    </form>
<?php }else { echo "Invalid application number";}?>
</body>
</html>
