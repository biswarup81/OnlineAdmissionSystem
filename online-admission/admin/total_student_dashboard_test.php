<?php
include"top.php";
include "..../../classes/admin_class.php";

$admin = new admin_class();
$con=$admin->getConnection();
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql = "SELECT SUM(
        CASE WHEN a.Category = 'GEN'
        THEN 1
        ELSE 0
        END ) AS GEN, SUM(
        CASE WHEN a.Category = 'SC'
        THEN 1
        ELSE 0
        END ) AS SC, SUM(
        CASE WHEN a.Category = 'ST'
        THEN 1
        ELSE 0
        END ) AS ST, SUM(
        CASE WHEN a.Category = 'OBC-A'
        THEN 1
        ELSE 0
        END ) AS 'OBC-A', SUM(
        CASE WHEN a.Category = 'OBC-B'
        THEN 1
        ELSE 0
        END ) AS 'OBC-B', session_table.session_name, course_level.course_level_name, course_table.course_name, 
        a.course_id, a.course_level_id
        FROM application_table a
        LEFT JOIN session_table ON a.session_id = session_table.sessionid
        LEFT JOIN course_level ON a.course_level_id = course_level.course_level_id
        LEFT OUTER JOIN course_table ON a.course_id = course_table.courseid
        where flag not in (1)    
        GROUP BY session_table.session_name, course_level.course_level_name, course_table.course_name
        order by course_table.course_name, course_level.course_level_name";



$return_arr = array();

if ($result = mysqli_query( $con, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
    $row_array['GEN'] = $row['GEN'];
    $row_array['OBC-A'] = $row['OBC-A'];
    $row_array['OBC-B'] = $row['OBC-B'];

    array_push($return_arr,$row_array);
   }
 }


echo json_encode($return_arr);

// Free result set
mysqli_free_result($result);

mysqli_close($con);
?>