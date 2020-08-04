	<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_class
 *
 * @author pg
 */
class admin_class {
    function sendMail($inputId, $flag,$mprnt, $application_no, $Password,$email){
        //echo "inside send mail";
		$send  = new sendMail();
        $admin = new admin_class();
        $collObj = $admin->getCollegeDetails();
        $studentLogin = $admin->getConstant("STUDENT_LOGIN");
        $from_mail = $admin->getConstant("FROM_MAIL");
        if($flag == 1){
           // echo "inside 1";
            //Send mail to Student that his form has been submitted.
            $toMail = $email;
			
            $subject =  "Online admission - ".$collObj->name ;
            $body = $admin->prepareMailBodyfor1stSubmission($application_no);

            //echo $body;
            //$header = $admin->prepareHeader();
            
            if($send->MailMe($toMail,$subject,$body)){
                    $result = "Your application form has been submitted successfully....";
                    "Application No:".$application_no;
                    $application_no_id=trim($application_no);
                    $_SESSION['application_no_id']=$application_no_id;
                    $_SESSION['application_no_id']; 	
                    $_SESSION['start'] = time();
                    $_SESSION['expire'] = $_SESSION['start'] + (60);
                    
            }else{
                    $result = "Your message could not be submited....";
            }
           //Get ApplicationId from Application Number
            $applicationObj = $admin->getApplicationDetails($application_no);
            
            $application_id = $applicationObj->id;
            
            $admin->sendSMSByApplicationId($flag, $application_id);
            
        }if($flag == 4){
            //Send mail to Student that his admission has been confirmed
            $subject =  "Application Acceptance - ".$collObj->name ;
            $body = $admin->prepareMailBodyAferAdmissionAcceptancebyStudent($inputId);
            $result = $admin->sendMailbyApplicationId($inputId, $body, $subject);
            
            $admin->sendSMSByApplicationId($flag,$inputId);
        } 
        if ($flag == 9){
            //Send mail to Student that his form has been submitted.
            
            $subject =  "Application Acceptance - ".$collObj->name ;
            $body = $admin->prepareMailBodyAferApplicationAcceptancebyAdmin($inputId);
            $result = $admin->sendMailbyApplicationId($inputId, $body, $subject);
            
            
            
            $admin->sendSMSByApplicationId($flag,$inputId);
            
            //echo $body;
            //echo $result; 
            
        }
        if($flag == 5){
            //Send mail to Student that his admission has been confirmed
            $subject =  "Admission Confirmation - ".$collObj->name ;
            $body = $admin->prepareMailBodyAfterAdmission($inputId);
            $result = $admin->sendMailbyApplicationId($inputId, $body, $subject);
            $admin->sendSMSByApplicationId($flag,$inputId);
        }
       if($flag == 3){
            //Send mail to Student that his he is sortlisted
           //echo "Send mail to Student that his he is sortlisted";
            $subject =  "Your Application is sortlisted - ".$collObj->name ;
            $body = $admin->prepareMailBodyAfterRankGeneration($inputId);
            $result = $admin->sendMailbyApplicationId($inputId, $body, $subject);
        }
        return $result;
    }
    
    
    
    function generateMeritList($iteration){
        $result = "";
        $admin = new admin_class();
        
        //Update application table with flag=12 (RANKED_BUT_NOT_ADMITTED)
        
        
        
        $query1 = "select a.Course_Id, a.Course_Level_Id
					, (Total_Seat - (SC+ ST+ OBC_A+ OBC_B) - SUM(case when e.flag in (4,5) and f.rank_category = 'GEN' then 1 else 0 end) ) as OTHAAV
					, SC - SUM(case when e.flag in (4,5) and f.rank_category = 'SC' then 1 else 0 end) as SCAV
					, ST - SUM(case when e.flag in (4,5) and f.rank_category = 'ST' then 1 else 0 end) as STAV
					, OBC_A - SUM(case when e.flag in (4,5) and f.rank_category = 'OBC-A' then 1 else 0 end) as 'OBC_AAV'
					, OBC_B - SUM(case when e.flag in (4,5) and f.rank_category = 'OBC-B' then 1 else 0 end) as 'OBC_BAV'	
					from course_seat_structure a  
					left join session_table b on a.Session_id = b.sessionid
					left join course_level c on a.course_level_id = c.course_level_id
					left join course_table d on a.course_id = d.courseid
					left outer join application_table e on a.Session_id = e.session_id and a.course_level_id = e.course_level_id and a.course_id = e.course_id
					left outer join application_rank_status f on e.application_no = f.application_no
					group by b.session_name, c.course_level_name, d.course_name, a.Total_Seat, (a.Total_Seat - a.SC - a.ST - a.OBC_A - a.OBC_B), a.SC, a.ST, a.OBC_A, a.OBC_B 
					having a.Course_Id in ( SELECT ctbl.CourseId FROM course_table ctbl WHERE ctbl.CourseId NOT IN ( 0 )  ) ";
        //16 - Bengali 17 - English 18-Hostory 19 - Geo 20 - Sanskrit 21 - General
        $result1 = mysql_query($query1) or die(mysql_error());
        
        while($rows1 = mysql_fetch_array($result1)){
            $courseid = $rows1['Course_Id'];
            $courselevelid = $rows1['Course_Level_Id'];
            //echo $courseid ." - ". $courselevelid. "- OBC-A Total : ".$admin->updateApplicationTable($courseid, $courselevelid, 'OBC_A', $rows1['OBC_AAV']);
            
            $admin->updateApplicationTable($iteration, $courseid, $courselevelid, 'GEN', $rows1['OTHAAV']); 
            $admin->updateApplicationTable($iteration, $courseid, $courselevelid, 'SC', $rows1['SCAV']);
            $admin->updateApplicationTable($iteration, $courseid, $courselevelid, 'ST', $rows1['STAV']);
            $admin->updateApplicationTable($iteration, $courseid, $courselevelid, 'OBC-A', $rows1['OBC_AAV']);
            $admin->updateApplicationTable($iteration, $courseid, $courselevelid, 'OBC-B', $rows1['OBC_BAV']);
            
        }
        //update the flag
        $admin->updateGenerateMeritListFlag($iteration);
        
        return $result;
        
    }
    
    function publishSubjectWisemeritList ($iteration, $courseid, $courselevelid){
    	$result = "";
    	$admin = new admin_class();
    	
    	$query1 = "select a.Gurdian_Mobile_No, concat(b.Course_Level_Name, ' - ', c.Course_Name) as course, a.course_id, a.course_level_id, a.id, a.application_no, a.Gurdian_Mobile_No  
				from application_table a
				left join session_table s on a.Session_id = s.sessionid
				left join course_level b on a.course_level_id = b.course_level_id
				left join course_table c on a.course_id = c.courseid
				left join application_rank_status d on a.application_no = d.application_no
				where s.Admission_open = 1
				and a.course_level_id = ".$courselevelid.
				" and a.course_id = ".$courseid.
				" and d.iteration = ".$iteration.
				" and d.rank_status between 100 and 150";
    	
    	//echo $query1;
    	$result1 = mysql_query($query1) or die(mysql_error());
    	   	
    	
    	$count = mysql_num_rows($result1) or die(mysql_error());
    	//echo $count;
    	$MobileNumString = "";
    	$i = 1;
    	
    	while($rows1 = mysql_fetch_array($result1)  ){
    		$course = $rows1['course'];
    		
    		//Send mail
    		//$admin->sendMailAfterRankgeneration($course, $rows1['application_no'], $rows1['password'],$rows1['Gurdian_Mobile_No'], $rows1['email'],$rows1['course_id'], $rows1['course_level_id']);
    		//echo $course;
    		if($i == 1){
    			$MobileNumString = $rows1['Gurdian_Mobile_No'];
    		} else {
    			$MobileNumString = $MobileNumString.",". $rows1['Gurdian_Mobile_No'];
    			
    		}
    		//echo $i;
    		$i++;
    		//echo $MobileNumString;
    	}
    //	echo "finfished";
    	
    	$message = "Your application  for ".$course." is sort listed. Follow instruction online to complete admission - Kandra RKK Mahavidyalaya";
    
    	
    	//$admin->sendSMS($message, $MobileNumString);
    	$admin->auditTrailSMS($message, $MobileNumString);
    	
    	return "success";
    	
    }
    
    function sendMailAfterRankgeneration($course, $application_no, $password,$mobile, $email,$course_id, $course_level_id){
    	
    	$admin = new admin_class();
    	$studentLogin = $admin->getConstant("STUDENT_LOGIN");
    	$application_FeeObj = $admin->getApplicationFeeByCourseIdAndCourseLevelId($course_id, $course_level_id);
    	$collObj = $admin->getCollegeDetails();
    	$subject =  "Your Application is sortlisted - ".$collObj->name ;
    	echo $subject;
    	$body = "<html><head><body >
    	<div ><div >
    	<h2> Application Num # ".$application_no ."</h2>
    	<p>Your Application for". $course ." has been sort listed. Kindly logon to the Online Admission System with the following URL :</p>
    	<p><a href='".$studentLogin."' target='_blank'>".$studentLogin."</a></p>
    	<p>ID : Use your E-Mail ID or Mobile Numberand password : ".$password."(Change your password from the panel)</p>
    	<h2>Instructions</h2>
    	<p><strong>STEP 1</strong>: Deposite Admission Fee of <b><u>RS. ".$application_FeeObj->TOTAL_FEE." </u></b>to ".$admin ->getConstant('BANK_NAME')."  </p>
                    <p>".$admin ->getConstant('BRANCH_ACCOUNT')."</p>
                    <p><strong>STEP 2 </strong>: After depositing the money, login to the Student Panel and Confirm your Admission.</p>
                    <p>Keep your deposite Slip for future reference</p>
                    <p>For any other clarification, ".$admin ->getConstant('COLLEGE_CONTACT')."</p>
                  </div>
                </body>
                </html>"; 
    	echo $body;
    	
    	
    	
    	$header = $admin->prepareHeader();
    	
    	if(mail($email,$subject,$body,$header)){
    		$result = "Your application form has been submitted successfully....";
    		
    		
    	}else{
    		$result = "Your message could not be submited....";
    	}
    	
    	return $result;
    	
    	
    }
    function generateSubjectWisemeritList($iteration, $courseid, $courselevelid){
    	
    	$result = "";
    	$admin = new admin_class();
    	
    	//Update application table with flag=12 (RANKED_BUT_NOT_ADMITTED)
    	
    	mysql_query("update application_table set flag = 12 where flag=3 and course_level_id = $courselevelid and course_id = $courseid ") or die (mysql_error());
    	
    	$query1 = "select a.Course_Id, a.Course_Level_Id
					, (Total_Seat - (SC+ ST+ OBC_A+ OBC_B) - SUM(case when e.flag in (5) and f.rank_category = 'GEN' then 1 else 0 end) ) as OTHAAV
					, SC - SUM(case when e.flag in (4,5) and f.rank_category = 'SC' then 1 else 0 end) as SCAV
					, ST - SUM(case when e.flag in (4,5) and f.rank_category = 'ST' then 1 else 0 end) as STAV
					, OBC_A - SUM(case when e.flag in (4,5) and f.rank_category = 'OBC-A' then 1 else 0 end) as 'OBC_AAV'
					, OBC_B - SUM(case when e.flag in (4,5) and f.rank_category = 'OBC-B' then 1 else 0 end) as 'OBC_BAV'	
					from course_seat_structure a  
					left join session_table b on a.Session_id = b.sessionid
					left join course_level c on a.course_level_id = c.course_level_id
					left join course_table d on a.course_id = d.courseid
					left outer join application_table e on a.Session_id = e.session_id and a.course_level_id = e.course_level_id and a.course_id = e.course_id
					left outer join application_rank_status f on e.application_no = f.application_no and f.admit_flag = 1
					group by b.session_name, c.course_level_name, d.course_name, a.Total_Seat, (a.Total_Seat - a.SC - a.ST - a.OBC_A - a.OBC_B), a.SC, a.ST, a.OBC_A, a.OBC_B 
					having a.Course_Id = $courseid and a.Course_Level_Id = $courselevelid";
    	
    	//echo $query1;
    	//16 - Bengali 17 - English 18-Hostory 19 - Geo 20 - Sanskrit 21 - General
    	$result1 = mysql_query($query1) or die(mysql_error());
    	
    	while($rows1 = mysql_fetch_array($result1)){
    		
    		//echo $courseid ." - ". $courselevelid. "- OBC-A Total : ".$admin->updateApplicationTable($courseid, $courselevelid, 'OBC_A', $rows1['OBC_AAV']);
    		
    		$admin->updateApplicationTable($iteration, $courseid, $courselevelid, 'GEN', $rows1['OTHAAV']);
    		$admin->updateApplicationTable($iteration, $courseid, $courselevelid, 'SC', $rows1['SCAV']);
    		$admin->updateApplicationTable($iteration, $courseid, $courselevelid, 'ST', $rows1['STAV']);
    		$admin->updateApplicationTable($iteration, $courseid, $courselevelid, 'OBC-A', $rows1['OBC_AAV']);
    		$admin->updateApplicationTable($iteration, $courseid, $courselevelid, 'OBC-B', $rows1['OBC_BAV']);
    		
    	}
    	//update the flag
    	//$admin->updateGenerateMeritListFlag($iteration);
    	
    	return $result;
    	
    }
    
    
    
    
    function updateGenerateMeritListFlag($iteration){
    	
    	$query = "update  generate_merit_list set Active = 0 where iteration = '".$iteration."'";
    	//echo $query;
    	$result = mysql_query($query) or die(mysql_error());
    }
    
    function updateApplicationTable($iteration, $courseid, $courselevelid,$category,$input_num){
    	
    	
        
        if($category == "GEN"){
            
    $query2 = "SELECT a.Application_No, u.fname  First_Name, u.lname Last_Name, p.Gurdian_Mobile_No, u.email, u.password,
                            a.submit_date, d.flag_name, b.Course_Level_Name, c.Course_Name, a.total_marks, p.Category category
                            FROM application_table a, personal_details p, user u, course_level b, course_table c, admission_flag d
                            WHERE a.course_level_id = b.Course_Level_Id
                            AND a.course_id = c.courseId
                            AND a.user_id = p.user_id
                            AND a.user_id = u.user_id
                            AND d.FLAG_ID = a.flag "
                           . " AND a.course_id = '$courseid'  "
                           . " AND a.course_level_id = '$courselevelid' and a.flag = '9'"
                           . "order by a.Total_Marks desc limit 0, $input_num";
            //echo "GENERAL -> ".$query2;
        } else {
        $query2 = "SELECT a.Application_No, u.fname  First_Name, u.lname Last_Name, p.Gurdian_Mobile_No, u.email, u.password,
                            a.submit_date, d.flag_name, b.Course_Level_Name, c.Course_Name, a.total_marks, p.Category category
                            FROM application_table a, personal_details p, user u, course_level b, course_table c, admission_flag d
                            WHERE a.course_level_id = b.Course_Level_Id
                            AND a.user_id = p.user_id
                            AND a.user_id = u.user_id
                            AND a.course_id = c.courseId
                            AND d.FLAG_ID = a.flag "
                           . " and a.course_id = '$courseid' and "
                           . "a.course_level_id = '$courselevelid' and p.Category = '$category' and a.flag in ( '9', '3') "
                           . "order by a.Total_Marks desc limit 0, $input_num";
                           //echo "RESERVATIONS -> ".$query2;
        }
        //echo $query2;
        $admin = new admin_class();
        $result2 = mysql_query($query2) or die(mysql_error());
        $count =1;
        $last_record = mysql_num_rows($result2);
        //echo "last record = ".$last_record;
        $query = "update application_table set flag=3 where Application_No in (";
          
        echo"<table border=1 cellspacing=1 cellpadding=1>";
		
		
		//echo "<td>APPLICATION</td><td>First Name</td><td>Last Name</td><td>E-Mail</td><td>Phone</td><td>Category</td><td>TOTAL_MARKS</td>";
		
        while($rows2 = mysql_fetch_array($result2)){
           $id = $rows2['Application_No'];
           //$query ="update first_merit_list set flag=3 , category='".$category."' where id =".$id;
           //$query = $query.$id.",";
//echo "$count : ".$query; 
           
           echo"<tr><td>".$count."</td><td>". $rows2['Application_No']."</td><td>".$rows2['First_Name'].
                   "</td><td>".$rows2['Last_Name']."</td><td>".$rows2['Gurdian_Mobile_No']."</td><td>".
                   $category."</td><td>".$rows2['Course_Level_Name'].
                   "-".$rows2['Course_Name']."</td><td>"
                   . $rows2['total_marks']."</td></tr>"; 
           //mysql_query($query) or die(mysql_error());
           //Send mail
           //$admin->sendMail($id, 3, null, null, null, null);
           //$admin->sendSMSByApplicationId(3, $id);
           
           if($last_record == $count ){
               //echo "count";
               $query = $query.$id ;
           } else {
               $query = $query.$id.",";
           }
           $count++;
           $rank_status = $admin->getRankStatus($rows2['category'], $category);
           
           //Get the rank status
           
           $insert_query = "insert into application_rank_status(application_no,rank_status,application_category,rank_category, iteration) values('".$rows2['Application_No']."',".$rank_status.",'". $rows2['category']."','". $category."','".$iteration."')";
           //echo $insert_query;
           mysql_query($insert_query) or die(mysql_error());
         
        }
        if(mysql_num_rows($result2) > 0) {
                //echo "<tr><td colspan='9'>".$query.")</td></tr>";
                //mysql_query($query.")") or die(mysql_error());
            }
        /*if($category == "GEN"){
            
            if(mysql_num_rows($result2) > 0) {
                echo "<tr><td colspan='9'>".$query.")</td></tr>";
                mysql_query($query.")") or die(mysql_error());
            }
            
        } else {
            
            if(mysql_num_rows($result2) > 0) {
                echo "<tr><td colspan='9'>".$query.")</td></tr>";
                mysql_query($query.")") or die(mysql_error());
            }
        } */
        echo "</table><br>";
        //echo "count = ".$count;
        
        $query = $query.")";
        //echo $query."</br>";
        if(strlen($id) > 0) {
        	mysql_query($query) or die(mysql_error());
        }
        
       
        
        return $count;
        
    }
    
    function prepareMailBodyfor1stSubmission($application_no){
        //Send mail to Student that his form has been submitted.
        
        $admin = new admin_class();
        $rowObj = $admin ->getApplicationDetails($application_no);
        $studentLogin = $admin->getConstant("STUDENT_LOGIN");
        $body = "<html><head><body >
        <div >
          <div >
            <h2> Application Num # $application_no</h2>
            <p>Your Application for $rowObj->Course_Level_Name  (' $rowObj->Course_Name  ') has been submitted successfully. Kindly logon to the Online Admission System with the following URL :</p>
            <p><a href='".$studentLogin."' target='_blank'>".$studentLogin."</a></p>
            <h2>Instructions</h2>
            <p><strong>STEP 1</strong>: Deposite Application Fee of ".$admin ->getConstant('APPLICATION_FEE')." to ".$admin ->getConstant('BANK_NAME')." in the following Branchs. </p>
            <p>".$admin ->getConstant('BRANCH_ACCOUNT')."</p>
            <p><strong>STEP 2 </strong>: After depositing the money, login to the Student Panel and Submit your form. Application Form once submitted cannot be altered.</p>
            <p>Keep your deposite Slip for future reference</p>
            <p>For any other clarification, ".$admin ->getConstant('COLLEGE_CONTACT')."
              <!-- end #mainContent -->
            </p>
          </div>

        </body>
        </html>";      
        
        //echo $body;
        return $body;
    }
     function prepareMailBodyAferAdmissionAcceptancebyStudent($id){
        $admin = new admin_class();
        $rowObj = $admin ->getApplicationDetailsById($id);
       
        $collObj = $admin->getCollegeDetails();
        $studentLogin = $admin->getConstant("STUDENT_LOGIN");
        $visit_date = $admin->getConstant("COLLEGE_VISIT_DATE");
        $body = "<html><head><body >
        <div >
          <div >
            <h2> Application Num # $rowObj->Application_No </h2>
            <h3>YOUR APPLICATION HAS BEEN COMPLETED. YOU ARE AMITTED IN $collObj->name</h3>    
            <p>Your Application for $rowObj->Course_Level_Name  (' $rowObj->Course_Name  ') is Approved. Kindly logon to the Online Admission System with the following URL :</p>
            <p><a href='".$studentLogin."' target='_blank'>".$studentLogin."</a></p>
            <p>ID : Use your E-Mail ID or Mobile Numberand password : $rowObj->password (Change your password from the panel)</p>
            
            <p><strong>NOTE 1</strong>: Visit College with the following documents :between $visit_date</p>
           
            <p><strong></strong>: 1. Application Fee Bank Reciept.</p>
            <p><strong></strong>: 2. Admission Fee Bank Reciept.</p>
            <p><strong></strong>: 3. All Original and photo copies.</p>
            <p>For any other clarification, ".$admin ->getConstant('COLLEGE_CONTACT')."
              
            </p>
          </div>

        </body>
        </html>";    
                   
        return $body;
    }
    function prepareMailBodyAferApplicationAcceptancebyAdmin($id){
        //Send mail to Student After college confirms his Application - 2nd Submission
        
        $admin = new admin_class();
        $rowObj = $admin ->getApplicationDetailsById($id);
        $studentLogin = $admin->getConstant("STUDENT_LOGIN");
        $body = "<html><head><body >
        <div >
          <div >
            <h2> Application Num # $rowObj->Application_No </h2>
            <h3>You shall get further communication through E-Mail after you're shortlisted</h3>    
            <p>Your Application for $rowObj->Course_Level_Name  (' $rowObj->Course_Name  ') is Approved. Kindly logon to the Online Admission System with the following URL :</p>
            <p><a href='".$studentLogin."' target='_blank'>".$studentLogin."</a></p>
            <p>ID : Use your E-Mail ID or Mobile Numberand password : $rowObj->password (Change your password from the panel)</p>
            
            <p><strong>NOTE 1</strong>: KEEP YOUR BANK DEPOSITE SLIP FOR FUTURE REFERENCE</p>
           
            <p><strong>NOTE 2 </strong>: Application Form once submitted cannot be altered.</p>
      
            <p>For any other clarification, ".$admin ->getConstant('COLLEGE_CONTACT')."
              
            </p>
          </div>

        </body>
        </html>";      
        
        //echo $body;
        return $body;
    }
    
    function prepareMailBodyAfterAdmission($id){
        $admin = new admin_class();
        $rowObj = $admin ->getApplicationDetailsById($id);
       
        $collObj = $admin->getCollegeDetails();
        $visit_date = $admin->getConstant("COLLEGE_VISIT_DATE");
        $body = "<html><head><body >
        <div >
          <div >
            <h2> Application Num # $rowObj->Application_No </h2>
            <h3>YOUR APPLICATION HAS BEEN COMPLETED. YOU ARE AMITTED IN $collObj->name</h3>    
            
            
            <p><strong>NOTE 1</strong>: Visit College with the following documents : between $visit_date</p>
           
            <p><strong></strong>: 1. Application Fee Bank Reciept.</p>
            <p><strong></strong>: 2. Admission Fee Bank Reciept.</p>
            <p><strong></strong>: 3. All Original and photo copies.</p>
            <p>For any other clarification, ".$admin ->getConstant('COLLEGE_CONTACT')."
              
            </p>
          </div>

        </body>
        </html>";    
                   
        return $body;
    }
    
    function prepareMailBodyAfterRankGeneration($id){
        $admin = new admin_class();
        $rowObj = $admin ->getApplicationDetailsById($id);
        $studentLogin = $admin->getConstant("STUDENT_LOGIN");
        $application_FeeObj = $admin->getApplicationFeeByCourseIdAndCourseLevelId($rowObj->course_id, $rowObj->course_level_id);
        $body = "<html><head><body >
                <div ><div >
                    <h2> Application Num # $rowObj->Application_No</h2>
                    <p>Your Application for $rowObj->Course_Level_Name  (' $rowObj->Course_Name  ') has been sort listed. Kindly logon to the Online Admission System with the following URL :</p>
                    <p><a href='".$studentLogin."' target='_blank'>".$studentLogin."</a></p>
                    <p>ID : Use your E-Mail ID or Mobile Numberand password : $rowObj->password (Change your password from the panel)</p>
                    <h2>Instructions</h2>
                    <p><strong>STEP 1</strong>: Deposite Admission Fee of <b><u>RS. ".$application_FeeObj->TOTAL_FEE." </u></b>to ".$admin ->getConstant('BANK_NAME')."  </p>
                    <p>".$admin ->getConstant('BRANCH_ACCOUNT')."</p>
                    <p><strong>STEP 2 </strong>: After depositing the money, login to the Student Panel and Confirm your Admission.</p>
                    <p>Keep your deposite Slip for future reference</p>
                    <p>For any other clarification, ".$admin ->getConstant('COLLEGE_CONTACT')."</p>
                  </div>
                </body>
                </html>";     
        //echo $body;
        return $body;
    }
    
   function getApplicationDetails($application_no){
       //$subjectCombination = "";
       
       $query = "select a.id,a.Application_No,a.Application_Fee,a.Admission_Fee, a.user_id,
        a.Demand_Draft_No,h.fname,h.mname,h.lname,h.mobile,g.Gurdian_Name,g.Gurdian_Mobile_No,g.Gurdian_Relation,
        g.Other_Relation,g.occu,g.other_occu,g.desi,g.income,h.Gender,g.Date_Of_Birth,
       g.Category,g.Physically_Challenged,g.Religion,g.other_religion,g.Nationality,
        g.Address,g.ZIP_PIN,g.Address_1,g.pin2,g.Address_2,g.Country,g.Mobile,g.Land_Phone_No,
        h.email,a.Total_Marks,a.Bank_Payment_Verified,a.admit,a.course_id,
        a.course_level_id,a.session_id,a.submit_date,a.flag,g.state, e.name as state_name, g.district,f.name as district_name,  
        b.Course_Level_Name, c.Course_Name,a.Doc_verified
	from application_table a, course_level b, course_table c, admission_flag d, states e, districts f , personal_details g,user h
	where a.course_level_id = b.Course_Level_Id and a.course_id = c.courseId and g.state = e.id and g.district = f.id  
        and d.FLAG_ID=a.flag and g.user_id = a.user_id and h.user_id=a.user_id and a.Application_No='".$application_no."' ";
       
       //echo $query;
       
       $result = mysql_query($query)or die(mysql_error());
       $rowObject = mysql_fetch_object($result) ;
       
       /*while($rows = mysql_fetch_array($result)){
           $subjectCombination = $rows['Course_Level_Name'] . '('. $rows['Course_Name'] . ')';
       } */
       
       return $rowObject;
   }
   
   function getConstant($key){
       $query = "SELECT * FROM admission_constant where name = '".$key."'";
       //echo $query;
       $result = mysql_query($query)or die(mysql_error());
       $rowObject = mysql_fetch_object($result) ;
       
       /*while($rows = mysql_fetch_array($result)){
           $subjectCombination = $rows['Course_Level_Name'] . '('. $rows['Course_Name'] . ')';
       } */
       
       return $rowObject->DESCRIPTION;
   }
   function sendMailbyApplicationId($inputId,$body,$subject){
        
       
        $admin = new admin_class();
        $rowObj = $admin->getApplicationDetailsById($inputId)  ;   
        //echo $body;
        $toMail = $rowObj->email;
        $header = $admin->prepareHeader();
        $application_no = $rowObj->Application_No;
        if(mail($toMail,$subject,$body,$header)){
                $result = "Your application form has been submitted successfully....";
                "Application No:".$application_no;
                $application_no_id=trim($application_no);
                $_SESSION['application_no_id']=$application_no_id;
                $_SESSION['application_no_id']; 	
                $_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + (60);

        }else{
                $result = "Your message could not be submited....";
        }
        
        return $result;
   }
   
   function getApplicationDetailsById($id){
       //$subjectCombination = "";
       
       $query = "select a.id,a.Application_No,a.user_id,
        a.Demand_Draft_No,h.fname,h.mname,h.lname,h.mobile,g.Gurdian_Name,g.Gurdian_Mobile_No,g.Gurdian_Relation,
        g.Other_Relation,g.occu,g.other_occu,g.desi,g.income,h.Gender,g.Date_Of_Birth,
       g.Category,g.Physically_Challenged,g.Religion,g.other_religion,g.Nationality,
        g.Address,g.ZIP_PIN,g.Address_1,g.pin2,g.Address_2,g.Country,g.Mobile,g.Land_Phone_No,
        h.email,a.Total_Marks,a.Bank_Payment_Verified,a.admit,a.course_id,
        a.course_level_id,a.session_id,a.submit_date,a.flag,g.state, e.name as state_name, g.district,f.name as district_name,  
        b.Course_Level_Name, c.Course_Name,a.Doc_verified
	from application_table a, course_level b, course_table c, admission_flag d, states e, districts f , personal_details g,user h
	where a.course_level_id = b.Course_Level_Id and a.course_id = c.courseId and g.state = e.id and g.district = f.id  
        and d.FLAG_ID=a.flag and g.user_id = a.user_id and h.user_id=a.user_id and a.id='".$id."'";
       
       //echo $query;
       
       $result = mysql_query($query)or die(mysql_error());
       $rowObject = mysql_fetch_object($result) ;
       
       /*while($rows = mysql_fetch_array($result)){
           $subjectCombination = $rows['Course_Level_Name'] . '('. $rows['Course_Name'] . ')';
       } */
       
       return $rowObject;
   }
   function getApplicationFeeByCourseIdAndCourseLevelId($courseid, $courselevelid){
       $query = "SELECT * FROM fee_structure where Course_Id = $courseid "
               . "and Course_Level_Id = $courselevelid ";
       //echo $query;
       $result = mysql_query($query) or die(mysql_error());     
       $rowObj = mysql_fetch_object($result);
       
       return $rowObj;
   }
   
   function prepareHeader(){
       $admin = new admin_class();
       $from_mail = $admin->getConstant("STUDENT_LOGIN");
       $header = 'From: noreply@online-admission.co.in' . "\r\n" ;
       $header.= 'MIME-Version: 1.0' . "\r\n";
       $header.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
       
       return $header;
   }
   
   function getCollegeDetails(){
       $query = "select * from cname";
       //echo $query;
       $result = mysql_query($query) or die(mysql_error());     
       $rowObj = mysql_fetch_object($result);
       
       return $rowObj;
   }
   function getMessageByFlag($flag){
       $message = "";
       $admin = new admin_class();
       if($flag == 2){
           $message = $admin->getConstant("DRAFT_TO_SUBMIT");
           
       } else if ($flag == 4){
           $message = $admin->getConstant("ADMISSION_SUBMISSION_BY_STUDENT");
       }
       return "<p>".$message."</p>";
   }
   function updateCourseSeatTable($category,$course_id,$course_level_id){
        if($category == 'GEN'){
             $query_add_in_course_structure = "update course_seat_structure "
                . "set Other_Filled = Other_Filled+1 where Course_Id = '".$course_id."' "
                . "and Course_Level_Id = '".$course_level_id."'";
            
        } else if($category == 'SC'){
            
            $query_add_in_course_structure = "update course_seat_structure "
                . "set SC_Filled = SC_Filled+1 where Course_Id = $course_id "
                . "and Course_Level_Id = $course_level_id";
        } else if($category == 'ST'){
           
            $query_add_in_course_structure = "update course_seat_structure "
                . "set ST_Filled = ST_Filled+1 where Course_Id = $course_id "
                . "and Course_Level_Id = $course_level_id";
           
        } else if($category == 'OBC-A'){
            
            $query_add_in_course_structure = "update course_seat_structure "
                . "set OBC_A_Filled = OBC_A_Filled+1 where Course_Id = $course_id "
                . "and Course_Level_Id = $course_level_id";
        } else if ($category == 'OBC-B'){
            
            $query_add_in_course_structure = "update course_seat_structure "
                . "set OBC_B_Filled_Filled = OBC_B_Filled_Filled+1 where Course_Id = $course_id "
                . "and Course_Level_Id = $course_level_id";
           
        } else {
           
           $query_add_in_course_structure = "update course_seat_structure "
                . "set Other_Filled = Other_Filled+1 where Course_Id = $course_id "
                . "and Course_Level_Id = $course_level_id";
        }
       
        //echo $query_add_in_course_structure;
        mysql_query($query_add_in_course_structure) or die(mysql_error());
   }
   
   function cancelOtherApplication($email,$mobile_number,$inputId){
       $query = "update application_table a set FLAG = 12 where "
            . "(a.email = '$email' or "
            . "a.Gurdian_Mobile_No = '$mobile_number') and "
            . "a.id != '$inputId' and flag in (3,4,5)";
       mysql_query($query) or die(mysql_error());
       
   }
   function auditTrailSMS($message, $mobile_num){
   	
	   	$insert_query = "insert into sms_sent_info (MESSAGE, MOBILE) values ('".$message."','".$mobile_num."')";
	   	
	   	
	   	mysql_query($insert_query) or die(mysql_error());
	   	
	   //	echo "Query executed";
	   	
   }
   function sendSMS($message, $mobile_num){
       $admin = new admin_class();
	   
       //Audit Trail SMS
       $admin->auditTrailSMS($message, $mobile_num);
       
      
       
       //$url="http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?";
       $url = trim($admin->getConstant("SMS_API_URL"));
       $sms_user_name =  trim($admin->getConstant("SMS_USER"));
       $sms_psswd = trim($admin->getConstant("SMS_PASS"));
       $sender_id = trim($admin->getConstant("SMS_SENDER_ID"));
       $mobile_num = trim($mobile_num);
       //echo ($url);
       //echo ($sms_user_name);
       //echo ($sender_id);
       //echo ($mobile_num);
       $message = urlencode($message);
        $ch = curl_init(); 
        if (!$ch){die("Couldn't initialize a cURL handle");}
        $ret = curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);          
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        //curl_setopt ($ch, CURLOPT_POSTFIELDS,"username=kandra&password=1493715534&sendername=KRKKMV&mobileno=".$mobileNo."&message=".$message );
        //curl_setopt ($ch, CURLOPT_POSTFIELDS,"username=".$sms_user_name."&password=".$sms_psswd."&sendername=".$sender_id."&mobileno=91".$mobile_num."&message=".$message );
        curl_setopt ($ch, CURLOPT_POSTFIELDS,"user=".$sms_user_name."&pass=".$sms_psswd."&sender=".$sender_id."&phone=".$mobile_num."&text=".$message."&priority=ndnd&stype=normal" );

        $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $curlresponse = curl_exec($ch);	
       
       //return $result;
   }
   
   function sendSMSByApplicationId($flag,$id){
       //echo ("id ==>"+$id);
       $admin =new admin_class();
       $rowObj = $admin->getApplicationDetailsById($id);
       $application_no = $rowObj->Application_No;
       $mobile_num=$rowObj->mobile;
       $password = $rowObj->password;
       $courlevel = $rowObj->Course_Level_Name;
       $coursename = $rowObj->Course_Name;
       $student_panel = $admin->getConstant("STUDENT_LOGIN");
       $collegeVisit_date = $admin->getConstant("COLLEGE_VISIT_DATE");
       $collObj = $admin->getCollegeDetails();
       $college_name = $collObj->name ;
       if($flag == 1){
           $message = "Application ".$application_no." Submitted. Loginto ".$student_panel." using MobileNo Password ".$password;
       } else if($flag == 9){
           //Your application~for~is accepted. You will receive further communication if you are sort listed.
           
           $message = "Your application ".$application_no." for ".$courlevel."-".$coursename." is accepted. You will receive further communication if you are sort listed.";
       } else if($flag == 3){
           //Your application~for~is sort listed. Follow instruction online to complete admission.
           
           $message = "Your application ".$application_no." for ".$courlevel."-".$coursename." is sort listed. Follow instruction online to complete admission.";
       } else if($flag == 4){
           //You have accepted your admission for~Visit college on~with all documents. Refer online instruction
           
           $message = "You have accepted your admission for ".$courlevel."-".$coursename.". Visit college on ".$collegeVisit_date." with all documents. Refer online instruction";
       } else if($flag == 5){
           //You have completed your admission for~Wecome to~
           
           $message = "You have completed your admission for ".$courlevel."-".$coursename.". Wecome to ".$college_name;
       } 
       //echo $message;
       
       
       $admin->sendSMS($message, $mobile_num);
               
   }
   
   
   function retrieveForms(){
       $sql = "SELECT SUM(
        CASE WHEN b.Category = 'GEN'
        THEN 1
        ELSE 0
        END ) AS GEN, SUM(
        CASE WHEN b.Category = 'SC'
        THEN 1
        ELSE 0
        END ) AS SC, SUM(
        CASE WHEN b.Category = 'ST'
        THEN 1
        ELSE 0
        END ) AS ST, SUM(
        CASE WHEN b.Category = 'OBC-A'
        THEN 1
        ELSE 0
        END ) AS 'OBC-A', SUM(
        CASE WHEN b.Category = 'OBC-B'
        THEN 1
        ELSE 0
        END ) AS 'OBC-B', session_table.session_name, course_level.course_level_name, course_table.course_name
        FROM application_table a
        LEFT JOIN personal_details b ON a.user_id = b.user_id
        LEFT JOIN session_table ON a.session_id = session_table.sessionid
        LEFT JOIN course_level ON a.course_level_id = course_level.course_level_id
        LEFT OUTER JOIN course_table ON a.course_id = course_table.courseid
        GROUP BY session_table.session_name, course_level.course_level_name, course_table.course_name
        order by course_table.course_name, course_level.course_level_name";
       
       $result = mysql_query($sql) or die(mysql_error());
       
        $rows = null;
       
         
        while($row = mysql_fetch_assoc($result))    {
            echo $row['GEN'];
            $rows[] = $row;
        } 
        
       
        
        return $rows;
       
   }
   function getConnection(){
   $db_host = 'localhost';
	$db_login= 'onlinead_kandra';
	$db_pswd = '#x9I@V1RBNhu';
	$db_name = 'onlinead_kandra';
      $con = mysql_connect($db_host,$db_login,$db_pswd);
      if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
      mysql_select_db($db_host);
      return $con;
   }
   function getKanyaShreeDetails($applicationNum){
        $query = "select * from kanyashree where application_num = ".$applicationNum;
       //echo $query;
       $result = mysql_query($query) or die(mysql_error());     
       $rowObj = mysql_fetch_object($result);
       
       return $rowObj;
   }
   function getBankTransactionDetails($applicationNum){
        $query = "select * from app_confirm_table where application_num = ".$applicationNum;
       //echo $query;
       $result = mysql_query($query) or die(mysql_error());     
       $rowObj = mysql_fetch_object($result);
       
       return $rowObj;
   }
   
    function getPaymentDetails($applicationNum){
        $query = "select * from admission_payments where Application_No = ".$applicationNum;
       //echo $query;
       $result = mysql_query($query) or die(mysql_error());     
       $rowObj = mysql_fetch_object($result);
       
       return $rowObj;
   }
   
   function getRankPublishDetails(){
   	$query = "SELECT a.`iteration`, a.`Active` FROM `generate_merit_list` a
				WHERE SYSDATE() > a.PUBLIH_DATE
				and a.`iteration` = (SELECT max(b.`iteration`) FROM `generate_merit_list` b
				                     WHERE SYSDATE() > b.PUBLIH_DATE
                    )";
   	//echo $query;
   	$result = mysql_query($query) or die(mysql_error());
   	$rowObj = mysql_fetch_object($result);
   	
   	return $rowObj;
   }
   
   function getCourseDetails($course_id){
   	$query = "select * from  course_table where CourseId = ".$course_id;
   	//echo $query;
   	$result = mysql_query($query) or die(mysql_error());
   	$rowObj = mysql_fetch_object($result);
   	
   	return $rowObj;
   }
   
   function getCourseLeveldetails($course_level_id){
   	$query = "select * from  course_level where Course_Level_Id = ".$course_level_id;
   	//echo $query;
   	$result = mysql_query($query) or die(mysql_error());
   	$rowObj = mysql_fetch_object($result);
   	
   	return $rowObj;
   }

   function getRankStatus($application_category, $rank_category){
   	$rankstatus;
   	if($application_category == $rank_category){
   		if($application_category == "GEN"){
   			$rankstatus = 100;
   		} elseif ($application_category == "SC"){
   			$rankstatus = 110;
   		} elseif ($application_category == "ST"){
   			$rankstatus = 120;
   		} elseif ($application_category == "OBC-A"){
   			$rankstatus = 130;
   		} elseif ($application_category == "OBC-B"){
   			$rankstatus = 140;
   		} elseif ($application_category == "PH"){
   			$rankstatus = 150;
   		}
   		
   	} else {
   		if ($application_category == "SC"){
   			$rankstatus = 111;
   		} elseif ($application_category == "ST"){
   			$rankstatus = 121;
   		} elseif ($application_category == "OBC-A"){
   			$rankstatus = 131;
   		} elseif ($application_category == "OBC-B"){
   			$rankstatus = 141;
   		} elseif ($application_category == "PH"){
   			$rankstatus = 151;
   		}
   	}
   	return $rankstatus;
   }
   
   function getAdmissionConstant($key){
   	$query = "select * from  admission_constant where NAME = '".$key."'";
   	
   	//echo $query;
   	$result = mysql_query($query) or die(mysql_error());
   	$rowObj = mysql_fetch_object($result);
   	
   	return $rowObj;
   }
   function getSessionDetails(){
   	$query = "select * from  session_table where Admission_open = 1 ";
   	
   	//echo $query;
   	$result = mysql_query($query) or die(mysql_error());
   	$rowObj = mysql_fetch_object($result);
   	
   	return $rowObj;
   	
   }
   function getApplicationDetailsByMobileNumber($mobile_number){
   	$query = "SELECT a.Application_No, a.First_Name, a.Middle_Name, a.Last_Name, a.Gurdian_Mobile_No, a.Gurdian_Name, a.Gurdian_Relation, a.occu, a.income, a.Gender, a.Date_Of_Birth, a.Category, a.Physically_Challenged, a.Religion, a.Nationality, a.Address, a.ZIP_PIN, a.Country, c.name, d.name, a.email, a.Address_1, a.pin2, a.Address_2, b.Board, b.Roll_Index_No, b.Year_Of_Passing
				FROM application_table a, applicaion_marks b, states c, districts d
				WHERE a.Application_No = b.Application_No
				AND a.state = c.id
				AND a.district = d.id
				AND a.Gurdian_Mobile_No
				IN (
				'$mobile_number'
				)
				AND a.session_id
				IN (
				
				SELECT session_id
				FROM session_table
				WHERE admission_open =1
				)
				ORDER BY a.CREATE_DATE ASC 
				LIMIT 1";
   	
   	$result = mysql_query($query) or die(mysql_error());
   	$rowObj = mysql_fetch_object($result);
   	
   	return $rowObj;
   	
   }
   function getAppAttachmentDetails($user_id, $img_id){
   	$query = "select `image` from  `gallery_image` where user_id = '$user_id' AND gallery_id = '$img_id' and 	is_deleted = 'N' ";
   	$result = mysql_query($query) or die(mysql_error());
   	$row = mysql_fetch_array($result);
   	return $row['image'];
   }

    function getApplAdmChallanDetails($application_num, $img_id){
        $query = "select `doc_name`, `is_verified`  from  `offline_payments` where app_no = '$application_num' AND gallery_id = '$img_id' ";
        $result = mysql_query($query) or die(mysql_error());
        $rowObj = mysql_fetch_object($result);

        return $rowObj;

   }


}
