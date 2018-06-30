<?php

include '../../classes/config.php';
include '../../classes/conn.php';

if(isset($_GET['stateId'])) { 
   drop_1($_GET['stateId']); 
}

function drop_1($drop_var)
{  
    
	$result = mysql_query("SELECT * FROM `districts` WHERE `state_id`='$drop_var'") 
	or die(mysql_error());
	
	echo '
	      <option value="" disabled="disabled" selected="selected">Choose one</option>';
			
		   while($drop_2 = mysql_fetch_array( $result )) 
			{
			  echo '<option value="'.$drop_2['id'].'">'.$i.$drop_2['name'].'</option>';
			}
	
	echo '';
   
}

?>
