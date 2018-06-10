<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of report_class
 *
 * @author pg
 */
class report_class {
    function getAllStudentList(){
        
        /*
         * select a.id,a.Application_No,a.password,a.Application_Fee,a.Demand_Draft_No,a.First_Name,a.Middle_Name,a.Last_Name,a.Gurdian_Name,a.Gurdian_Mobile_No,a.Gurdian_Relation,
        a.Other_Relation,a.occu,a.other_occu,a.desi,a.income,a.Gender,a.Date_Of_Birth,a.Category,a.Physically_Challenged,a.Religion,a.other_religion,a.Nationality,
        a.Address,a.ZIP_PIN,a.Address_1,a.pin2,a.Address_2,a.Country,a.Mobile,a.Land_Phone_No,a.email,a.Total_Marks,a.Bank_Payment_Verified,a.admit,a.course_id,
        a.course_level_id,a.session_id,a.submit_date,a.flag,a.state,a.district, b.Course_Level_Name, c.Course_Name , d.FLAG_NAME
	from application_table a, course_level b, course_table c, admission_flag d
	where a.course_level_id = b.Course_Level_Id and a.course_id = c.courseId 
         */
        
        $query = "select a.First_Name,a.Middle_Name,a.Last_Name, a.Application_No, b.Course_Level_Name, c.Course_Name,
            d.FLAG_NAME, a.Gurdian_Mobile_No, a.Gender,a.Category,a.Physically_Challenged,
            a.email,a.Total_Marks 
	    from application_table a, course_level b, course_table c, admission_flag d
	    where a.course_level_id = b.Course_Level_Id and a.course_id = c.courseId and d.FLAG_ID = a.flag ";
        $result = mysql_query($query) or die(mysql_error());
        
    }
}
