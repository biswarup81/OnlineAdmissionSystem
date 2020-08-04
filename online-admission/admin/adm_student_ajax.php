<?php
include"top.php";
?>
<?php 
          $Appl_No = $_GET['application_num'];
          
          $app_sql = "SELECT a.id,a.Application_No,a.password,a.Application_Fee,
                    a.Demand_Draft_No,a.First_Name,a.Middle_Name,a.Last_Name,a.Gurdian_Name,
                    a.Gurdian_Mobile_No,a.Gurdian_Relation,
                    a.Other_Relation,a.occu,a.other_occu,a.desi,a.income,a.Gender,a.Date_Of_Birth,
                    a.Category,a.Physically_Challenged,a.Religion,a.other_religion,a.Nationality,
                    a.Address,a.ZIP_PIN,a.Address_1,a.pin2,a.Address_2,a.Country,a.Mobile,a.Land_Phone_No,
                    a.email,a.Total_Marks,a.Bank_Payment_Verified,a.admit, e.course_cd,
                    e.course_lvl_cd,a.session_id,a.submit_date,a.flag,a.state,a.district, 
                    b.Course_Level_Name, c.Course_Name 
                    FROM application_table a, course_level b, course_table c, admission_flag d, course_seat_structure e, session_table f
                    where a.course_level_id = b.Course_Level_Id and a.course_id = c.courseId
                    and d.FLAG_ID=a.flag and a.course_id = e.course_id and a.course_level_id = e.course_level_id
                    and e.session_id = f.SessionId and f.Admission_open = 1 and a.flag = 5
                    and a.Application_No = '$Appl_No'";
          $conn = new mysqli("localhost", "root", "ot288fO8JypG", "onlinead_kandra");
          $result = $conn->query($app_sql);
          $outp = array();
          $outp = $result->fetch_all(MYSQLI_ASSOC);
          echo json_encode($outp);
          
?>

			
