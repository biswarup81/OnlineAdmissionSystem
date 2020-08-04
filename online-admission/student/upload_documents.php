<?php
error_reporting(0);
include "top.php";
include "header.php";
session_start();
if(!isset($_SESSION['user_id'])){
//	$user_id = $_SESSION['user_id'];
	header("Location:logout.php");
}
$user_id= $_SESSION['user_id'];

if(isset($_REQUEST['submit'])){
	if($_REQUEST['action'] == "pp_photo"){
		uploadFile('pp-photo',"$user_id".'-pp-photo');
		$pp_photo_file_name = $user_id.'-pp-photo.'.pathinfo($_FILES["pp-photo"]["name"], PATHINFO_EXTENSION);
		
        $insert_file_name_query2="INSERT INTO `gallery_image`(user_id, gallery_id, image, create_on) VALUES ('$user_id','2','$pp_photo_file_name',NOW())";
        mysql_query($insert_file_name_query2) or die(mysql_error());
		
		echo "<br><br><center><h3>Your Document successfully Uploaded</h3></center>";
	}
	else if($_REQUEST['action'] == "dob"){
		uploadFile('dob-proof',"$user_id".'-dob-proof');
		$dob_proof_file_name=$user_id.'-dob-proof.'.pathinfo($_FILES["dob-proof"]["name"], PATHINFO_EXTENSION);
		
        $insert_file_name_query1="INSERT INTO `gallery_image`(user_id, gallery_id, image, create_on) VALUES ('$user_id','1','$dob_proof_file_name',NOW())";
        mysql_query($insert_file_name_query1) or die(mysql_error());
		echo "<br><br><center><h3>Your Document successfully Uploaded</h3></center>";
	}
	else if($_REQUEST['action'] == "x_marksheet"){
	    uploadFile('secondary-marksheet',"$user_id".'-secondary-marksheet');
	    $secondary_marksheet_file_name=$user_id.'-secondary-marksheet.'.pathinfo($_FILES["secondary-marksheet"]["name"], PATHINFO_EXTENSION);
	 
	    $insert_file_name_query1="INSERT INTO `gallery_image`(user_id, gallery_id, image, create_on) VALUES ('$user_id','3','$secondary_marksheet_file_name',NOW())";
        mysql_query($insert_file_name_query1) or die(mysql_error());
		echo "<br><br><center><h3>Your Document successfully Uploaded</h3></center>";
	
	}
	else if($_REQUEST['action'] == "xii_marksheet"){
		uploadFile('hs-marksheet',"$user_id".'-hs-marksheet');
		$hs_marksheet_file_name=$user_id.'-hs-marksheet.'.pathinfo($_FILES["hs-marksheet"]["name"], PATHINFO_EXTENSION);
		
		$insert_file_name_query1="INSERT INTO `gallery_image`(user_id, gallery_id, image, create_on) VALUES ('$user_id','4','$hs_marksheet_file_name',NOW())";
        mysql_query($insert_file_name_query1) or die(mysql_error());
		echo "<br><br><center><h3>Your Document successfully Uploaded</h3></center>";
	}
	else if($_REQUEST['action'] == "cast_cerificate"){
		uploadFile('caste-proof',"$user_id".'-caste-proof');
		$caste_proof_file_name=$user_id.'-caste-proof.'.pathinfo($_FILES["caste-proof"]["name"], PATHINFO_EXTENSION);
		
		$insert_file_name_query1="INSERT INTO `gallery_image`(user_id, gallery_id, image, create_on) VALUES ('$user_id','5','$caste_proof_file_name',NOW())";
        mysql_query($insert_file_name_query1) or die(mysql_error());
		echo "<br><br><center><h3>Your Document successfully Uploaded</h3></center>";
	}
    else if($_REQUEST['action'] == "disability_cert"){	
	    uploadFile('disability-cert',"$user_id".'-disability-cert');
		$disability_cert_file_name=$user_id.'-disability-cert.'.pathinfo($_FILES["disability-cert"]["name"], PATHINFO_EXTENSION);
		
		$insert_file_name_query1="INSERT INTO `gallery_image`(user_id, gallery_id, image, create_on) VALUES ('$user_id','8','$disability_cert_file_name',NOW())";
        mysql_query($insert_file_name_query1) or die(mysql_error());
		echo "<br><br><center><h3>Your Document successfully Uploaded</h3></center>";
    }else{
		echo "<center><h3>Something goes wrong</h3></center>";
	}
	
	
	
  }else{
	echo "<center><h3>Failed to upload your document</h3></center>";
}


function uploadFile($fieldId, $fname) {
    //Check if the form was submitted
    //if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if file was uploaded without errors
        if (isset($_FILES["$fieldId"]) && $_FILES["$fieldId"]["error"] == 0) {
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "JPG" => "image/JPG", "JPEG" => "image/JPEG", "pdf" => "application/pdf");
            $filename = $_FILES["$fieldId"]["name"];
            $filetype = $_FILES["$fieldId"]["type"];
            $filesize = $_FILES["$fieldId"]["size"];
            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.\n");
            // Verify file size - 5MB maximum
            $maxsize = 10 * 1024 * 1024;
            if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.\n");
             //Verify MYME type of the file
            if (in_array($filetype, $allowed)) {
                 //Check whether file exists before uploading it
                if (file_exists("../pg/ulasset/" . $fname.".".$ext)) {
                    echo $filename . " is already exists.";
                } else {
                    move_uploaded_file($_FILES["$fieldId"]["tmp_name"], "../pg/ulasset/" . $fname.".".$ext);
                    //echo "Your files was uploaded successfully.";
                }
            } else {
                //echo "Error: There was a problem uploading your file. Please try again.\n";
            }
        } else {
            //echo "Error: " . $_FILES["$fieldId"]["error"]."\n";
        }
 }

?>

<?php include "footer.php"; ?>
