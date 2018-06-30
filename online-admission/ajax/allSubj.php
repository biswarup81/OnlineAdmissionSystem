<?php
include '../../classes/config.php';
include '../../classes/conn.php';
drop_1(); 
function drop_1($drop_var)
{  
    
	
	$result = mysql_query("SELECT * FROM subject_master a order by a.Subject_Name asc ") 
	or die(mysql_error());
	//$x='<select name="D1" id="D1" >';
	$x='<option value="" selected="selected">Select Subject</option>';
			
		   while($drop_2 = mysql_fetch_array( $result )) 
			{
			  $x.= '<option value="'.$drop_2['Subject_Id'].'">'.$drop_2['Subject_Name'].'</option>';
			}
	
	//$x.= '</select>';
   echo $x;
}

?>