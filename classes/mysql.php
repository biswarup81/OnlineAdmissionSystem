<?
 $connected = false;
 function c()
  {
      global $db_host, $db_login, $db_pswd;

      $db = @mysql_connect($db_host, $db_login, $db_pswd) or die("COULD NOT CONNCECT");
	  //echo "CONNECTED";
	  
      $connected = true;
	 
      return $db;
  }

 function q($q_str)
 {
    global $db_name, $connected;
    if(!$connected)
    {
    	c();
    }

   mysql_select_db($db_name);
    //$r = mysql($db_name, $q_str);
	$r=mysql_query($q_str);
	d($db_name);
    return $r;
 }

 function d($db)
 {
    @mysql_close($db);
 }

 function e($r)
 {
  if(@mysql_numrows($r))
   return 0;
  else return 1;
 }

 function f($r){
  return @mysql_fetch_array($r);
 }

 function nr($r){
  return @mysql_num_rows($r);
 }
 function iid(){
  return @mysql_insert_id();
 }
 
 
 function sql_select($table,$fields,$arg,$debug)
{
  
  if($arg<>"")
  {
    $str= q('SELECT '.$fields.' FROM '.$table.' WHERE '.$arg);
	 
  
  }
  else
  {
    $str=q('SELECT '.$fields. 'FROM '.$table);
  
  }
  
  if($debug==1)
  {
    echo '<br>Error:'.mysql_error().'At:'.__LINE__.__FILE__.'.</br>';
	return false;
  }
return $str;
}


function sql_insert($table, $arg, $debug = FALSE)
{
 

   if(is_array($arg))
		{
			foreach($arg as $k => $v)
			{
				$keyList .= ($keyList ? ",`{$k}`" : "`{$k}`");
				$valList .= ($valList ? ",'{$v}'" : "'{$v}'");
			}
			$query = "INSERT INTO `{$table}` ({$keyList}) VALUES ({$valList})";
		}
		else
		{
			$query = 'INSERT INTO '."{$table} VALUES ({$arg})";
		}
 
 
 if ($result = q($query))
  {
	$tmp = mysql_insert_id();
	return $tmp;
	}
	 else
		 {
			if($debug==1)
  			 {
    				 echo "<br>Error:".mysql_error()." At:".__LINE__.__FILE__;
	 				return false;
  			 }	
		}
		
		
 	
}



function sql_update($table, $arg, $debug = FALSE)
{
   
   
   
   if ($result =q('UPDATE '.$table.' SET '.$arg)) {
			$result = mysql_affected_rows();
			return $result;
		} 


if($debug==1)
   {
     echo "<br>Error:".mysql_error()." At:".__LINE__.__FILE__;
	 return false;
   }
}

function sql_delete($table, $arg = '', $debug = FALSE)
{


  if (!$arg) 
  {
			if ($result =q('DELETE FROM '.$table)) 
			{
				return $result;
			} else 
			{
				//$this->dbError("db_Delete ($arg)");
				return FALSE;
			}
		} 
		
 else 
	{
		
		if ($result = q('DELETE FROM '.$table.' WHERE '.$arg))
		 {
				$tmp = mysql_affected_rows();
				return $tmp;
			} 
			else 
			{
				//$this->dbError('db_Delete ('.$arg.')');
				return FALSE;
			}
		}


 if($debug==1)
   {
     echo "<br>Error:".mysql_error()." At:".__LINE__.__FILE__;
	 return false;
   }
}

?>
