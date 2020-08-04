<?php
include "../../classes/config.php";
include "../../classes/conn.php";

function uploadFile($fieldId, $fname,$fileTypeCat,$applicationNo,$user_id) {
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if file was uploaded without errors
        if (isset($_FILES["$fieldId"]) && $_FILES["$fieldId"]["error"] == 0) {
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "JPG" => "image/JPG", "JPEG" => "image/JPEG");
            $filename = $_FILES["$fieldId"]["name"];
            $filetype = $_FILES["$fieldId"]["type"];
            $filesize = $_FILES["$fieldId"]["size"];
            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            echo "filename :$filename";
	    echo "<br>filetype :$filetype";
	    echo "<br>filesize : $filesize";
            echo "<br>Extension : $ext";
	    echo "<br>user id:".$user_id."<br>";
            if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
            // Verify file size - 5MB maximum
            $maxsize = 10 * 1024 * 1024;
            if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
            // Verify MYME type of the file
            if (in_array($filetype, $allowed)) {
                // Check whether file exists before uploading it
                if (file_exists("../pg/ulasset/" . $fname)) {
                    echo $filename . " is already exists.";
                } else {
                    move_uploaded_file($_FILES["$fieldId"]["tmp_name"], "../pg/ulasset/" . $fname.".".$ext);
					updateUploadFilesTable($fileTypeCat,$fname.".".$ext,$applicationNo,$user_id);
                    echo "Your files was uploaded successfully.";
                }
            } else {
                echo "Error: There was a problem uploading your file. Please try again.";
            }
        } else {
            echo "Error: " . $_FILES["$fieldId"]["error"];
        }
    }
}

function updateUploadFilesTable($fileTypeCat,$fname,$applicationNo,$user_id){
		if($fileTypeCat=="ApplicationChallan"){
			$insert_query = "INSERT INTO `offline_payments`(`user_id`, `app_no`,`gallery_id`, `doc_name`)
                             VALUES('$user_id','$applicationNo','6','$fname')";
			$update_query = "UPDATE `application_table` SET `Application_Fee`= 'challan',`flag`=2  WHERE `Application_No`= '$applicationNo' ";
			mysql_query($update_query) or die(mysql_error());
			mysql_query($insert_query) or die(mysql_error());
		}elseif($fileTypeCat=="AdmissonChallan"){
			$insert_query = "INSERT INTO `offline_payments`(`user_id`, `app_no`,`gallery_id`, `doc_name`)
                             VALUES('$user_id','$applicationNo','7','$fname')";
			$update_query = "UPDATE `application_table` SET `Admission_Fee`= 'challan',`flag`=4  WHERE `Application_No`= '$applicationNo' ";
			mysql_query($update_query) or die(mysql_error());
			mysql_query($insert_query) or die(mysql_error());
		}
}

$appNumber = $_REQUEST["app-no"];
$formType = $_REQUEST["frm-type"];
$fileNameId = $_REQUEST["fld-id"];
$user_id = $_REQUEST["user_id"];
		if($formType=="ApplicationChallan"){
			$file_name=$appNumber.'-application-challan';
			uploadFile($fileNameId, $file_name,$formType,$appNumber,$user_id);
		}elseif($formType=="AdmissonChallan"){
			$file_name=$appNumber.'-admisson-challan';
			uploadFile($fileNameId, $file_name,$formType,$appNumber,$user_id);
		}
?>
