<?php
include"top.php";
include"header.php";

$sql = "SELECT SUM(
        CASE WHEN b.rank_category = 'GEN'
        THEN 1
        ELSE 0
        END ) AS GEN, SUM(
        CASE WHEN b.rank_category = 'SC'
        THEN 1
        ELSE 0
        END ) AS SC, SUM(
        CASE WHEN b.rank_category = 'ST'
        THEN 1
        ELSE 0
        END ) AS ST, SUM(
        CASE WHEN b.rank_category = 'OBC-A'
        THEN 1
        ELSE 0
        END ) AS 'OBC-A', SUM(
        CASE WHEN b.rank_category = 'OBC-B'
        THEN 1
        ELSE 0
        END ) AS 'OBC-B', session_table.session_name, course_level.course_level_name, course_table.course_name, 
        a.course_id, a.course_level_id
        FROM application_table a
		LEFT JOIN application_rank_status b on a.application_no = b.application_no
        LEFT JOIN session_table ON a.session_id = session_table.sessionid
        LEFT JOIN course_level ON a.course_level_id = course_level.course_level_id
        LEFT OUTER JOIN course_table ON a.course_id = course_table.courseid
        where a.flag=5 and b.admit_flag = 1
        GROUP BY session_table.session_name, course_level.course_level_name, course_table.course_name
        order by course_table.course_name, course_level.course_level_name ";
       
       $result = mysql_query($sql) or die(mysql_error());
       
       
        
            
        
?>
<table border="1 px;" style="width:50%">
    <tr><td>Subject</td>
        <td>General</td>
        <td>SC</td>
        <td>ST</td>
        <td>OBC-A</td>
        <td>OBC-B</td>
    </tr>
<?php while($row = mysql_fetch_array($result))    {  ?>
    
    <tr><td><?php echo $row['course_level_name']. '-'. $row['course_name'] ; ?></td>
        <td><a href="ranked_student_list.php?course_id=<?php echo $row['course_id']; ?>&course_level_id=<?php echo $row['course_level_id']; ?>&category=GEN&subject=<?php echo $row['course_level_name']. '-'. $row['course_name'] .'(GENERAL)' ; ?>"><u><?php echo $row['GEN']; ?></u></a></td>
        <td><a href="ranked_student_list.php?course_id=<?php echo $row['course_id']; ?>&course_level_id=<?php echo $row['course_level_id']; ?>&category=SC&subject=<?php echo $row['course_level_name']. '-'. $row['course_name'] .'(SC)' ; ?>"><u><?php echo $row['SC']; ?></u></a></td>
        <td><a href="ranked_student_list.php?course_id=<?php echo $row['course_id']; ?>&course_level_id=<?php echo $row['course_level_id']; ?>&category=ST&subject=<?php echo $row['course_level_name']. '-'. $row['course_name'] .'(ST)'; ?>"><u><?php echo $row['ST']; ?></u></a></td>
        <td><a href="ranked_student_list.php?course_id=<?php echo $row['course_id']; ?>&course_level_id=<?php echo $row['course_level_id']; ?>&category=OBC-A&subject=<?php echo $row['course_level_name']. '-'. $row['course_name'] .'(OBC-A)'; ?>"><u><?php echo $row['OBC-A']; ?></u></a></td>
        <td><a href="ranked_student_list.php?course_id=<?php echo $row['course_id']; ?>&course_level_id=<?php echo $row['course_level_id']; ?>&category=OBC-B&subject=<?php echo $row['course_level_name']. '-'. $row['course_name'] .'(OBC-B)'; ?>"><u><?php echo $row['OBC-B']; ?></u></a></td>
    </tr>    
<?php            
            
        } 
        
?>
</table>

<?php include "footer.php";?>	