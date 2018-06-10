<?php
include("../../../classes/config.php");
include "../../../classes/conn.php";
include ("../../../classes/admin_class.php");
$update = new admin_class();
$draftTosubmit="<p>Thank you for Submitting your Application for Chandidas College. Kindly wait for the Merit List for result.</p>";
$draftRankedToAdmit = "<p>Thank you for taking admission to Chandidas College. Kindly go to college on 05-06-2014 with all your original copies</p>";
$confirmAdmission = "<p>Student has been admitted successfully</p>";
$inputFlag = filter_input(INPUT_GET, 'flag');
$inputId = filter_input(INPUT_GET, 'id');
$query = "UPDATE `application_table` SET `flag`='".$inputFlag."' where `id`='".$inputId."'";
mysql_query($query)or die(mysql_error());

if($inputFlag == 2){
    echo $draftTosubmit;
} else if($inputFlag == 9){
    //echo $draftRankedToAdmit;
    //Send mail
    $update->sendMail($inputId, 9, null, null, null, null);
    
    
} else if($inputFlag == 4){
    echo $draftRankedToAdmit;
    
    $update->sendMail($inputId, 4, null, null, null, null);
    
} else if($inputFlag == 5){
    
    $admin = new admin_class();
    //Update course_seat_structure with the details filled.
    //get course_id and
    
    $rows = $admin->getApplicationDetailsById($inputId);
    
    $email = $rows->email;
    $mobile_number = $rows->Gurdian_Mobile_No;   
    $course_id = $rows->course_id;
    $course_level_id = $rows->course_level_id;
    $category = $rows->Category;
    //update application_table a set FLAG = 7 where (a.email = 'biswarup.ghoshal@gmail.com' or a.Gurdian_Mobile_No = '9874404111') and a.id != '3' 
    
    $admin->cancelOtherApplication($email,$mobile_number,$inputId);
    

    //Update course_seat_structure table

    $admin->updateCourseSeatTable($category,$course_id,$course_level_id);

    //Send mail to the Candidate
    //$update->sendMail(5,$inputId);
    
    $update->sendMail($inputId, 5, null, null, null, null);
    echo $confirmAdmission;
}

//echo $inputFlag;
//echo "Updated with ==> ".$query;
?>
