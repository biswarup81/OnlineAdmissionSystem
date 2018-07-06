<?php
include"top.php";


			//if(isset($_POST['CREATE_PATIENT_DATA'])){
                $appl_no = $_POST['appl_no'];
                $sql = "select * from application_table where Application_No =".$appl_no;
				$result = mysql_query($sql);
				$count = 0;
				while ($row = mysql_fetch_array($result)) {
		        $count = $count + 1;
		        $student_name=$row['First_Name']." ".$row['Last_Name'];
		        
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
                                <td>".$student_name."</td>
                                <td>".$student_name."</td>
								<td><a href=adm_student.php?Appl_No=".$appl_no.">"."Click Here</a></td>
							     </tr>
						          </tbody>";
       
    }
    else 
    {
        echo "<div>Student:".$student_id." not found</div>";
    }

?>
