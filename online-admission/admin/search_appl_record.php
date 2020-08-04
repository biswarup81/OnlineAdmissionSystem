<?php
include"top.php";


			//if(isset($_POST['CREATE_PATIENT_DATA'])){
                $appl_no = $_POST['appl_no'];
                $sql = "select b.course_level_name, c.course_name, a.* from".
                " application_table a, course_level b, course_table c where a.course_id = c.courseId and a.course_level_id = b.course_level_id".
                " and a.Application_No =".$appl_no. " and flag=5";
				$result = mysql_query($sql);
				$count = 0;
				while ($row = mysql_fetch_array($result)) {
		        $count = $count + 1;
		        $student_name=$row['First_Name']." ".$row['Last_Name'];
		        $course_lvl = $row['course_level_name'];
		        $course_name = $row['course_name'];
    }
    if($count==1)
    {
        echo "<h2 class='sub-header'>Verify Applicant Details:</h2>";
                echo "<table class='table table-striped'>
                                <thead>
                                <tr>
								<th>Application No</th>
								<th>Name</th>
								<th>Course Level</th>
								<th>Course Name</th>
							     </tr>
						          </thead>";
            echo "<tbody>
                                <tr>
								<td>".$appl_no."</td>
								<td>".$student_name."</td>
                                <td>".$course_lvl."</td>
                                <td>".$course_name."</td>
								<td><a href=adm_student.php?Appl_No=".$appl_no.">"."Click Here</a></td>
							     </tr>
						          </tbody>";
       
    }
    else 
    {
        echo "<div>Student:".$student_id." not found</div>";
    }

?>
