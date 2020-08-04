<?php
include "../../classes/config.php";
include "../../classes/conn.php";
function uploadFile($fieldId, $fname,$fileTypeCat,$applicationNo) {
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if file was uploaded without errors
        if (isset($_FILES["$fieldId"]) && $_FILES["$fieldId"]["error"] == 0) {
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "JPG" => "image/JPG", "JPEG" => "image/JPEG", "pdf" => "application/pdf");
            $filename = $_FILES["$fieldId"]["name"];
            $filetype = $_FILES["$fieldId"]["type"];
            $filesize = $_FILES["$fieldId"]["size"];
            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            echo "filename :$filename";
	    echo "filetype :$filetype";
	    echo "filesize : $filesize";
            echo "Extension : $ext";
            if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
            // Verify file size - 5MB maximum
            $maxsize = 10 * 1024 * 1024;
            if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
            // Verify MYME type of the file
            if (in_array($filetype, $allowed)) {
                // Check whether file exists before uploading it
                if (file_exists("/pg/ulasset/" . $fname)) {
                    echo $filename . " is already exists.";
                } else {
                    move_uploaded_file($_FILES["$fieldId"]["tmp_name"], "/pg/ulasset/" . $fname.".".$ext);
					updateUploadFilesTable($fileTypeCat,$fname.".".$ext,$applicationNo);
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

function updateUploadFilesTable($fileTypeCat,$fname,$applicationNo){
		if($fileTypeCat=="ApplicationChallan"){
			$update_query = "update at_uploadfiles set App_challan_File_name='$fname' where Application_No='$applicationNo'";
			mysql_query($update_query) or die(mysql_error());
		}elseif($fileTypeCat=="AdmissonChallan"){
			$update_query = "update at_uploadfiles set Admisson_challan_File_name='$fname' where Application_No='$applicationNo'";
			mysql_query($update_query) or die(mysql_error());
		}
}
		$app-number=strtoupper(trim($_REQUEST['app-no']));
		$form-type=strtoupper(trim($_REQUEST['frm-type']));
		$file-name-id=strtoupper(trim($_REQUEST['fld-id']));
		if($form-type=="ApplicationChallan"){
			$file_name=$application_no.'-application-challan.'.pathinfo($_FILES["$file-name-id"]["name"], PATHINFO_EXTENSION);
			uploadFile($file-name-id, $file_name,$form-type,$app-number);
		}elseif($form-type=="AdmissonChallan"){
			$file_name=$application_no.'-admisson-challan.'.pathinfo($_FILES["$file-name-id"]["name"], PATHINFO_EXTENSION);
			uploadFile($file-name-id, $file_name,$form-type,$app-number);
		}
?>
