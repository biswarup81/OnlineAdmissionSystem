<?php

function csvToExcelDownloadFromResult($result, $showColumnHeaders = true, $asFilename = 'data.csv') {
    setExcelContentType();
    setDownloadAsHeader($asFilename);
    return csvFileFromResult('php://output', $result, $showColumnHeaders);
}

function csvToExcelDownloadFromResult1($result, $filename, $showColumnHeaders = true, $asFilename = 'data.csv') {
	setExcelContentType();
	setDownloadAsHeader($filename);
	return csvFileFromResult('php://output', $result, $showColumnHeaders);
}

function csvFileFromResult($filename, $result, $showColumnHeaders = true) {
    $fp = fopen($filename, 'w');
    $rc = csvFromResult($fp, $result, $showColumnHeaders);
    fclose($fp);
    return $rc;
}

function csvFromResult($stream, $result, $showColumnHeaders = true) {
    if($showColumnHeaders) {
        $columnHeaders = array();
        $nfields = mysql_num_fields($result);
        for($i = 0; $i < $nfields; $i++) {
            $field = mysql_fetch_field($result, $i);
            $columnHeaders[] = $field->name;
        }
        fputcsv($stream, $columnHeaders);
    }

    $nrows = 0;
    while($row = mysql_fetch_row($result)) {
        fputcsv($stream, $row);
        $nrows++;
    }

    return $nrows;
}

function setExcelContentType() {
    if(headers_sent())
        return false;

    header('Content-type: application/vnd.ms-excel');
    return true;
}

function setDownloadAsHeader($filename) {
    if(headers_sent())
        return false;

    header('Content-disposition: attachment; filename=' . $filename);
    return true;
}
include "./config.php";
include "./conn.php";
include "./report_class.php";
include "./admin_class.php";

$report = new report_class();
$admin = new admin_class();

if(isset($_GET["MODE"])){
    $mode = $_GET["MODE"];
    
    if($mode == "SHOW_ALL_STUDENT"){
        $query = "select a.First_Name,a.Middle_Name,a.Last_Name, a.Application_No, b.Course_Level_Name, c.Course_Name,
            d.FLAG_NAME, a.Gurdian_Mobile_No, a.Gender,a.Category,a.Physically_Challenged,
            a.email,a.Total_Marks 
	    from application_table a, course_level b, course_table c, admission_flag d
	    where a.course_level_id = b.Course_Level_Id and a.course_id = c.courseId and d.FLAG_ID = a.flag ";
        $result = mysql_query($query) or die(mysql_error());
        csvToExcelDownloadFromResult($result);
    } else if($mode == "SHOW_RANK"){
    	$course_id = $_GET["COURSE"];
    	$course_level_id = $_GET["COURSE_LEVEL"];
    	$course = $admin->getCourseDetails($course_id)->Course_Name;
    	$course_level = $admin->getCourseLeveldetails($course_level_id)->Course_Level_Name;
    	$category = $_GET["CAT"];
    	if($category == "GEN") {
	    	/*$query = "select a.First_Name,a.Middle_Name,a.Last_Name, a.Application_No, b.Course_Level_Name, c.Course_Name,
	            d.FLAG_NAME, a.Gurdian_Mobile_No, a.Gender, ars.rank_category, a.Physically_Challenged,
	            a.email,a.Total_Marks
		    from application_table a, course_level b, course_table c, admission_flag d, application_rank_status ars
		    where a.course_level_id = b.Course_Level_Id and a.course_id = c.courseId and d.FLAG_ID = a.flag and a.application_no = ars.application_no
			and a.flag=3 and c.CourseId = $course_id and b.Course_Level_Id = $course_level_id and ars.rank_category	 = '$category'
				order by a.Total_Marks desc "; */
	    	
	    	
	    	$query = "select @rownum := @rownum +1 'Rank', concat (a.First_Name , ' ', a.Last_Name) as Name, a.Application_No, concat (b.Course_Level_Name, '(', c.Course_Name,')') as Course
	           ,a.Total_Marks
		    from application_table a, course_level b, course_table c, admission_flag d, application_rank_status ars, (
				
				SELECT @rownum :=0
				)e
		    where a.course_level_id = b.Course_Level_Id and a.course_id = c.courseId and d.FLAG_ID = a.flag and a.application_no = ars.application_no
			and a.flag=3 and c.CourseId = $course_id and b.Course_Level_Id = $course_level_id and ars.rank_category	 = '$category'
				order by a.Total_Marks desc ";
	    	
    	} else {
    		/*$query ="select concat (a.First_Name , ' ', a.Last_Name) as name, a.Application_No, concat (b.Course_Level_Name, '(', c.Course_Name,')') as course
    		,a.Total_Marks
    		from application_table a, course_level b, course_table c, admission_flag d
    		where a.course_level_id = b.Course_Level_Id and a.course_id = c.courseId and d.FLAG_ID = a.flag
    		and a.flag=3 and c.CourseId = $course_id and b.Course_Level_Id = $course_level_id and a.category	 = '$category'
    		order by a.Total_Marks desc ";
    		*/
    		$query ="SELECT @rownum := @rownum +1 'Rank', CONCAT( a.First_Name,  ' ', a.Last_Name ) AS Name, a.Application_No, CONCAT( b.Course_Level_Name,  '(', c.Course_Name,  ')' ) AS Course, a.Total_Marks
				FROM application_table a, course_level b, course_table c, admission_flag d, (
				
				SELECT @rownum :=0
				)e
				WHERE a.course_level_id = b.Course_Level_Id
				AND a.course_id = c.courseId
				AND d.FLAG_ID = a.flag
				AND a.flag =3
				AND c.CourseId = $course_id
				AND b.Course_Level_Id = $course_level_id
				AND a.category =  '$category'
				ORDER BY a.Total_Marks DESC" ;
    		
    		/*$query = "select a.First_Name,a.Middle_Name,a.Last_Name, a.Application_No, b.Course_Level_Name, c.Course_Name,
    		d.FLAG_NAME, a.Gurdian_Mobile_No, a.Gender, a.category, a.Physically_Challenged,
    		a.email,a.Total_Marks
    		from application_table a, course_level b, course_table c, admission_flag d
    		where a.course_level_id = b.Course_Level_Id and a.course_id = c.courseId and d.FLAG_ID = a.flag
    		and a.flag=3 and c.CourseId = $course_id and b.Course_Level_Id = $course_level_id and a.category	 = '$category'
    		order by a.Total_Marks desc "; */
    	}
    	//echo $query;
    	$result = mysql_query($query) or die(mysql_error());
    	csvToExcelDownloadFromResult1($result,$course."-".$course_level."-".$category.".csv");
    }
    
}


?>
