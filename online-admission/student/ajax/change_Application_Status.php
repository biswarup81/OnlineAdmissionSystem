<?php
include("../../../classes/config.php");
include "../../../classes/conn.php";
include ("../../../classes/admin_class.php");


$admin = new admin_class();
$draftTosubmit="<p>Thank you for Submitting your Application for Chandidas College. Kindly wait for the Merit List for result.</p>";
$draftRankedToAdmit = "<p>Thank you for taking admission to Chandidas College. Kindly go to college on 05-06-2014 with all your original copies</p>";
$confirmAdmission = "<p>Student has been admitted successfully</p>";
$inputFlag = filter_input(INPUT_GET, 'flag');
$inputId = filter_input(INPUT_GET, 'id');


if($inputFlag == 2){
    $query = "UPDATE `application_table` SET `flag`='".$inputFlag."' where `id`='".$inputId."'";
    mysql_query($query)or die(mysql_error());
    
    $message = $admin->getMessageByFlag($flag);
    echo $message;
    
} else if($inputFlag == 4){
    
    //update other application with the same to FLAG 7 for cancelled
    $query1 = "select a.email, a.mobile from user a,application_table b where a.user_id = b.user_id AND  b.id=$inputId";
    
    $result1 = mysql_query($query1)or die(mysql_error());
    
    while($rows = mysql_fetch_array($result1)){
        $phone = $rows['mobile'];
        $email = $rows['email'];
        $query2 = "UPDATE application_table a, user b SET a.flag='7' where (b.mobile = '". $phone ."' or b.email = '".$email."') and flag=3 and a.user_id=b.user_id";
        
        mysql_query($query2) or die(mysql_error());
    }
    
    
    
    $query3 = "UPDATE `application_table` SET `flag`='".$inputFlag."' , ADMISSION_ACCEPTANCE_DATE = CURRENT_TIMESTAMP() where `id`='".$inputId."'";
    mysql_query($query3)or die(mysql_error());
    
    $message = $admin->getMessageByFlag($flag);
    
    $update->sendMail($inputId, 4, null, null, null, null);
    
    echo $message;
    
} else if($inputFlag == 5){
    $query = "UPDATE `application_table` SET `flag`='".$inputFlag."' where `id`='".$inputId."'";
    mysql_query($query)or die(mysql_error());
    //Update course_seat_structure with the details filled.
    //get course_id and course_level_id from the application table.
    $query_application_table = "select * from application_table where `id`='".$inputId."'";
    $result = mysql_query($query_application_table) or die(mysql_error());
    $columnName = "Other_Filled";
    while($rows = mysql_fetch_array($result)) {
        //Update application_table with the other courses CANCELLED
        //(a.email = '$uname' or a.Gurdian_Mobile_No = '$uname') ") 
        $email = $rows['email'];
        $mobile_number = $rows['Gurdian_Mobile_No'];   
        $course_id = $rows['course_id'];
        $course_level_id = $rows['course_level_id'];
        //update application_table a set FLAG = 7 where (a.email = 'biswarup.ghoshal@gmail.com' or a.Gurdian_Mobile_No = '9874404111') and a.id != '3' 
        
        mysql_query("update application_table a set FLAG = 7 where "
                . "(a.email = '$email' or "
                . "a.Gurdian_Mobile_No = '$mobile_number') and "
                . "a.id != '$inputId' ") or die(mysql_error());
        
        //Update course_seat_structure table
        if($rows['Category'] == 'GEN'){
            $columnName = "Other_Filled";
        } else if($rows['Category'] == 'SC'){
            $columnName = "SC_Filled";
        } else if($rows['Category'] == 'ST'){
            $columnName = "ST_Filled";
        } else if($rows['Category'] == 'OBC-A'){
            $columnName = "OBC_A_Filled";
        } else if ($rows['Category'] == 'OBC-B'){
            $columnName = "OBC_B_Filled_Filled";
        } else {
            $columnName = "Other_Filled";
        }
        $query_add_in_course_structure = "update course_seat_structure set "
                . "$columnName = $columnName+1 where Course_Id = '$course_id' and Course_Level_Id = '$course_level_id'";
        mysql_query($query_add_in_course_structure) or die(mysql_error());
        //Send mail to the Candidate
        
    }
    $update = new admin_class();
    $update->sendMail(5,$inputId);
    echo $confirmAdmission;
}

//echo $inputFlag;
//echo "Updated with ==> ".$query;
?>