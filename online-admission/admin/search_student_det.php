<?php
include"top.php";


			//if(isset($_POST['CREATE_PATIENT_DATA'])){
                $sql_set = 0;
                
                
                if(isset($_POST['student_id']))
                {
                    $student_id = $_POST['student_id'];
                    $sql = "select * from pg_student where row_id like '".$student_id."%'";
                    $sql_set = 1;
                }
                
                
                if(isset($_POST['fst_name']))
                {
                    $fst_name = $_POST['fst_name'];
                    if($sql_set<1)
                    {
                    $sql = "select * from pg_student where fst_name like '". $fst_name . "%'" ;
                    $sql_set = 1;
                    }
                    else 
                        $sql = $sql . " and fst_name like '". $fst_name . "%'" ;
                }
                
                if(isset($_POST['last_name']))
                {
                    $last_name = $_POST['last_name'];
                    if($sql_set<1)
                    {
                    $sql = "select * from pg_student where last_name like '" . $last_name . "%'";
                    $sql_set = 1;
                    }
                    else 
                        $sql = $sql . " and last_name like '". $last_name . "%'" ;
                }
                
				$result = mysql_query($sql);
				$count = 0;
				echo "<h2 class='sub-header'>Student Search Result:</h2>";
				echo "<table class='table table-striped'>
                                <thead>
                                <tr>
								<th>Student Id</th>
								<th>Student Name</th>
								<th>Date of Birth</th>
								<th>Gender</th>
								<th>Category</th>
								<th>Physically Challenged</th>
								<th>Student Details</th>
							     </tr>
						          </thead>";
				while ($row = mysql_fetch_array($result)) {
		        $count = $count + 1;
		        $student_name=$row['fst_name']." ".$row['last_name'];
		        $std_id = $row['row_id'];
   

            echo "<tbody>
                                <tr>
								<td>".$std_id."</td>
								<td>".$student_name."</td>
								<td>".$row['dob']."</td>
								<td>".$row['gender']."</td>
								<td>".$row['category']."</td>
								<td>".$row['ph_challenged']."</td>
								<td><a href=student_details.php?student_id=".$std_id.">"."Click Here</a></td>
							     </tr>
						          </tbody>";
       
    }
    if ($count<1)
    {
        echo "<div>Student:".$student_id." not found</div>";
    }

?>
