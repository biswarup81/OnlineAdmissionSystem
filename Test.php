<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include "./classes/config.php";
include "./classes/conn.php";
include "./classes/admin_class.php";

$admin = new admin_class();

//$admin->prepareMailBodyfor1stSubmission('201505170001');
//sendMail($inputId, $flag,$mprnt, $application_no, $Password,$email)
//$admin->sendMail(7,3,null, null,null ,null);

//$admin->updateCourseSeatTable('GEN', '12', '9');

echo "This is a Test";
//sendSMSByApplicationId(flag,id);
//$admin->sendSMSByApplicationId(4,2);

//$admin->publishSubjectWisemeritList('1', '16', '4');

$admin->sendMailAfterRankgeneration("BA Hons Ben", "12345", "asaa!wqwq", "9830875590", "biswarup.ghoshal@gmail.com", "16", "4");

    
?>