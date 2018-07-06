<?php
include"top.php";
?>
<?php 
          $Appl_No = $_GET['application_num'];
          
          $app_sql = "SELECT `id`, `Application_No`, `password`, `Application_Fee`, `Demand_Draft_No`, 
                    `First_Name`, `Middle_Name`, `Last_Name`, `Gurdian_Name`, `Gurdian_Mobile_No`, `Gurdian_Relation`, `Other_Relation`, 
                    `occu`, `other_occu`, `desi`, `income`, `Gender`, `Date_Of_Birth`, `Category`, `Physically_Challenged`, `Religion`, 
                    `other_religion`, `Nationality`, `Address`, `ZIP_PIN`, `Address_1`, `pin2`, `Address_2`, `Country`, `Mobile`, 
                    `Land_Phone_No`, `email`, `Total_Marks`, `Bank_Payment_Verified`, `admit`, `course_id`, `course_level_id`, `session_id`,
                    `submit_date`, `flag`, `state`, `district`, `CREATE_DATE`, `Course_Level_New`, `ADMISSION_ACCEPTANCE_DATE` 
                    FROM `application_table` where Application_No = '$Appl_No'";
         //  echo $app_sql;
          $result = mysql_query($app_sql) or die(mysql_error());
          
          $return_arr = array();
          
          while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
              $row_array['id'] = $row['id'];
              $row_array['Application_No'] = $row['Application_No'];
              $row_array['password'] = $row['password'];
              $row_array['Application_Fee'] = $row['Application_Fee'];
              $row_array['Demand_Draft_No'] = $row['Demand_Draft_No'];
              $row_array['First_Name'] = $row['First_Name'];
              $row_array['Middle_Name'] = $row['Middle_Name'];
              $row_array['Last_Name'] = $row['Last_Name'];
              $row_array['Gurdian_Name'] = $row['Gurdian_Name'];
              $row_array['Gurdian_Mobile_No'] = $row['Gurdian_Mobile_No'];
              $row_array['Gurdian_Relation'] = $row['Gurdian_Relation'];
              $row_array['Other_Relation'] = $row['Other_Relation'];
              $row_array['occu'] = $row['occu'];
              $row_array['other_occu'] = $row['other_occu'];
              $row_array['desi'] = $row['desi'];
              $row_array['income'] = $row['income'];
              $row_array['Gender'] = $row['Gender'];
              $row_array['Date_Of_Birth'] = $row['Date_Of_Birth'];
              $row_array['Category'] = $row['Category'];
              $row_array['Physically_Challenged'] = $row['Physically_Challenged'];
              $row_array['Religion'] = $row['Religion'];
              $row_array['other_religion'] = $row['other_religion'];
              $row_array['Nationality'] = $row['Nationality'];
              $row_array['Address'] = $row['Address'];
              $row_array['ZIP_PIN'] = $row['ZIP_PIN'];
              $row_array['Address_1'] = $row['Address_1'];
              $row_array['pin2'] = $row['pin2'];
              $row_array['Address_2'] = $row['Address_2'];
              $row_array['Country'] = $row['Country'];
              $row_array['Mobile'] = $row['Mobile'];
              $row_array['Land_Phone_No'] = $row['Land_Phone_No'];
              $row_array['email'] = $row['email'];
              $row_array['Total_Marks'] = $row['Total_Marks'];
              $row_array['Bank_Payment_Verified'] = $row['Bank_Payment_Verified'];
              $row_array['admit'] = $row['admit'];
              $row_array['course_id'] = $row['course_id'];
              $row_array['course_level_id'] = $row['course_level_id'];
              $row_array['session_id'] = $row['session_id'];
              $row_array['submit_date'] = $row['submit_date'];
              $row_array['flag'] = $row['flag'];
              $row_array['state'] = $row['state'];
              $row_array['district'] = $row['district'];
              $row_array['CREATE_DATE'] = $row['CREATE_DATE'];
              $row_array['Course_Level_New'] = $row['Course_Level_New'];
              $row_array['ADMISSION_ACCEPTANCE_DATE'] = $row['ADMISSION_ACCEPTANCE_DATE'];
              
              array_push($return_arr,$row_array);
          }
          echo json_encode($return_arr);
?>

			