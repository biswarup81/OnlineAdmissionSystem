<?php
global $page_no;
//error_reporting(E_ALL);
//error_reporting(E_ALL && ~E_NOTICE);

function dt_dmy($get_date)
{
	return substr($get_date,8,2)."/". substr($get_date,5,2)."/". substr($get_date,0,4);
}
function dt_dmy_small($get_date)
{
	return substr($get_date,8,2)."/". substr($get_date,5,2)."/". substr($get_date,2,2);
}

function type_IMG($mime)
{
	switch($mime)
	{	
		case "image/jpeg":
			return "jpg";
		case "image/pjpeg":
			return "jpg";
		case "image/png":
			return "png";		
		case "image/gif":
			return "gif";
		case "application/x-shockwave-flash":
			return "swf";	
	}
	return "";
}

function type_HTML($mime)
{
	echo $mime;
	switch($mime)
	{	
		case "text/html":
			return "html";				
		case "text/plain":
		 	return "txt";
		case "application/msword":
		 	return "doc";	
 		case "application/vnd.ms-excel":
		 	return "xls";
		case "application/vnd.ms-powerpoint":
		 	return "ppt";	
		case "application/pdf":
			return "pdf";
		case "application/zip":
			return "zip";
			
		case "application/octet-stream":
			return "mpp";
	}
	return "";
}


function upload_file($source=1,$dest,$homeid='',$type='',$is_admin=0)//source as array,destination folder,filename
{
	if($source["name"]=="")
	{
	   return("1");
	}
	
	if($source["size"]>UPLOAD_SIZE && $is_admin==0)
	{
	   return("1");
	}	
	
	 list($name,$ext)=explode(".",$source["name"]);//extracting name and extension from filename
	 if($type=='')	 
		 $ext=type_IMG($source["type"]);//returns the extension of image file e.g. gif,jpg,bmp
	 if($type=='html')	 
		 $ext=$ext;//returns the extension of image file e.g. HTML,txt,doc,xls
	 if($type=='swf')	 
		 $ext="swf";	 
		
	 if($ext=="")//checking validity
	 {
	    return("2");
	 }
	 	
	 $name=uniqid("KQ",true);
	 $filename="$name"."."."$ext";
	 $counter=1;
		
	$filedest="$dest"."$filename";
	//checks for any duplicate file
	/*while(file_exists("$filedest"))
	{
	  $nametemp=$name."_".$counter;
	  $nametemp="$nametemp"."."."$ext";
	  $filedest="$dest"."$nametemp";
	  $counter++;
	  $filename=$nametemp;
	}*/
		
	$success1=move_uploaded_file("$source[tmp_name]","$filedest");
	chmod("$filedest",0777);
	if($success1)
	{
		return($filename);
	}
	else
	{
		return("3");
	}
	 
}//end of function upload_file_in_folder

function checkEmail($email) 
{
   
   if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))
   {
      return FALSE;
   }
//  WHEN UPLOAD TO THE SERVER UNQUOTE THE FOLLOWING LINES
   /*list($Username, $Domain) = split("@",$email);

   if(getmxrr($Domain, $MXHost)) 
   {
      return TRUE;
   }
   else 
   {
      if(fsockopen($Domain, 25, $errno, $errstr, 30)) 
      {
         return TRUE; 
      }
      else 
      {
         return FALSE; 
      }
   }
   */
   else
   {
      return TRUE;
	  }
   
}
//////////////////////////////////////////////////////////////
//validating us phone number
function VALIDATE_USPHONE($phonenumber,$useareacode=true)  
{  
if ( preg_match("/^[ ]*[(]{0,1}[ ]*[0-9]{3,3}[ ]*[)]{0,1}[-]{0,1}[]*[0-9]{3,3}[ ]*[-]{0,1}[ ]*[0-9]{4,4}[ ]*$/",$phonenumber) || 

             (preg_match("/^[ ]*[0-9]{3,3}[ ]*[-]{0,1}[ ]*[0-9]{4,4}[ ]*$/",$phonenumber) && !$useareacode))
return eregi_replace("[^0-9]", "",$phonenumber);  
//return FALSE;  
} 
////////////////////////////////////////////////////////////////////
//CHECKING  FILE TYPE
function man_MIME2Ext($mime)
		{
		  switch($mime)
			{
		    case "image/gif" :
							return "gif";

		    case "image/pjpeg" :
							return "jpg";

		    case "image/jpeg" :
							return "jpg";
			 case "image/png" :
							return "png";
			 case "image/tiff" :
							return "tiff";								
		  }

			return "";
		}


		
//*******************************************



function check_is_zip($mime)
		{
		
		  switch($mime)
			{
		    case "application/x-zip-compressed" :
							return "zip";		    							
		  }

			return "";
		}


		
//*******************************************


 function sysGetThumbImage($url, $alt = "",$max_width=120,$max_height=120,$url_only=0)
    {
    //global $width, $height,$max_image_width,$max_image_height;    
    if (!($d = @fopen ($url, 'r'))) return;
        else {
            	fclose($d);
           		 $size = getimagesize ($url);
				 
            if ($size[2] == "") return "<img src=$url width=96  height=96 border=0 alt=\"Format is not supported!\">\n";
            else
			 {
              	 $height = $size[1];
      				$width = $size[0];
   			 if ($height > $max_height)
         		{
             		 $height = $max_height;
             		 $percent = ($size[1] / $height);
             		 $width = ($size[0] / $percent);
         		}
    	 if ($width > $max_width)
        	 {
            	  $width = $max_width;
             	 $percent = ($size[0] / $width);
              	 $height = ($size[1] / $percent);
        	 }
    
				if($url_only==0)
					return "<img src=\"$url\" width=\"$width\"  height=\"$height\"  border=0".(($alt=="")?(""):(" alt=\"$alt\"")).">\n\n";
				else
					return "src=\"$url\" ".(($alt=="")?(""):(" alt=\"$alt\""))." width=\"$width\"  height=\"$height\"";
         	}
		}        
    }
	



function sysScrapImage($url, $alt = "",$max_width=80,$max_height=80)
{
    
	  
    if (!($d = @fopen ($url, 'r'))) return;
        else {
            	fclose($d);
           		 $size = getimagesize ($url);
				 
            if ($size[2] == "") return "<img src=$url width=80  height=80 border=0 alt=\"Format is not supported!\">\n";
            else
			 {
              	 $height = $size[1];
      				$width = $size[0];
   			 if ($height > $max_height)
         		{
             		 $height = $max_height;
             		 $percent = ($size[1] / $height);
             		 $width = ($size[0] / $percent);
         		}
    	 if ($width > $max_width)
        	 {
            	  $width = $max_width;
             	 $percent = ($size[0] / $width);
              	 $height = ($size[1] / $percent);
        	 }
    
                    return "<img src=\"$url\" width=\"$width\"  height=\"$height\"  border=0".(($alt=="")?(""):(" alt=\"$alt\""))." style=\"border:0px #183c4a solid;\">\n\n";
					
         }
		}        
    }	
//*********************************************************************************************************


function trim_desc ($s,$length) {
// limit the length of the given string to $MAX_LENGTH char
// If it is more, it keeps the first $MAX_LENGTH-3 characters 
// and adds "..."
// It counts HTML char such as &aacute; as 1 char.
//
// $MAX_LENGTH = 22;
$str_to_count = $s;
if (strlen($str_to_count) <= $length) {
   return $s;
}
$s2 = substr($str_to_count, 0, $length - 3);
$s2 .= "...";
return $s2;
}


//////////////////////////////////////////////////////////

function sysGetMediumImage($url, $alt = "")
    {
    global $width, $height;
    $max_width = 300;
    $max_height = 175;

    if (!($d = @fopen ($url, 'r'))) return;
        else {
            fclose($d);
            $size = getimagesize($url);
            if ($size[2] == "") return "<img src=$url width=$width height=$height border=0 alt=\"Format is not supported!\">\n";
            else {
                if ($size[0] > $max_width){
                    $ratio = $size[0] / $max_width;
                    $width = $max_width;
                    $height = ceil ($size[1] / $ratio);
                    
                    if($height > $max_height)
                    {
                        $ratio = $height / $max_height;
                        $height = $max_height;
						
                        $width = ceil($width / $ratio);
						//$width=80;
                    }
                    
                    return "<img src=$url width=$width height=$height border=0".(($alt=="")?(""):(" alt=\"$alt\"")).">\n";
                } else {
                    $width = $size[0];
                    $height = $size[1];
                    return "<img src=$url width=$width height=$height border=0".(($alt=="")?(""):(" alt=\"$alt\"")).">\n";
                }
            }
        }
    }

/////////////////////

function sysGetBannerImage($url, $alt = "")
    {
    global $width, $height;
    $max_width = 468;
    $max_height = 60;

    if (!($d = @fopen ($url, 'r'))) return;
        else {
            fclose($d);
            $size = getimagesize($url);
            if ($size[2] == "") return "<img src=$url width=$width height=$height border=0 alt=\"Format is not supported!\">\n";
            else {
                if ($size[0] > $max_width){
                    $ratio = $size[0] / $max_width;
                    $width = $max_width;
                    $height = ceil ($size[1] / $ratio);
                    
                    if($height > $max_height)
                    {
                        $ratio = $height / $max_height;
                        $height = $max_height;
						
                        $width = ceil($width / $ratio);
						//$width=80;
                    }
                    
                    return "<img src=$url width=$width height=$height border=0".(($alt=="")?(""):(" alt=\"$alt\"")).">\n";
                } else {
                    $width = $size[0];
                    $height = $size[1];
                    return "<img src=$url width=$width height=$height border=0".(($alt=="")?(""):(" alt=\"$alt\"")).">\n";
                }
            }
        }
    }

/////////////////////


function getdatefromtimestamp($tm)
{
	$s=$tm;
	return date("m-d-Y",$s);
}

//////////////////////////////////////////

function getbizcatnamefromid($bcatid)
{
	$strb="select * from biz_category where category_id=$bcatid";
	$sqlbz=@mysql_query($strb);
	$numbz=mysql_num_rows($sqlbz);
	
	if($numbz)
	{
		$rsbiz=@mysql_fetch_row($sqlbz);
		
		return $rsbiz[1];
	}
	else
	{
		return 0;
	}
	
}

//////////////////////////////////////////

function get_file_size($size)
{
$filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
return round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i];
}

function get_time_HMS($size)
{
	if($size==0)
		return "";
	if($size<60)
	{
		return $size."Min";
	}
	if($size>=60 && $size<3600)
	{
		$min=floor($size/60);
		$sec=$size%60;
		if($sec<>0)
			return $min." Hr ".$sec." Min";
		else
			return $min." Hr";
	}
}


function auto_code($tab_name, $fld_name, $prefix)
{
	$f_sql=f(q("select ifnull(MAX($fld_name),0) AS MAXMCODE  FROM $tab_name"));
	
    if($f_sql['MAXMCODE'] =="0")
		return 1;
	else
		return intval($f_sql['MAXMCODE'])+1;
}


function pickname($Table,$scerchBy,$scerchItem,$key)
{
	$quary=q("select ".$scerchItem." from ".$Table." where ".$scerchBy."='".$key."'");
	$tot_rec=(int)nr($quary);
	$returnName='';
	if($tot_rec<>0)
	{
		$fatch_quary=f($quary);
		$returnName=$fatch_quary[0];
	}
	return $returnName;
}

function find_root($chapter)
{
	$quary=q("select subjectID,parentID from chapter where chapterID=$chapter");
	$fatch_arr=f($quary);
	$subName=pickname("subject","subjectID","subjectName",$fatch_arr['subjectID']);
	$chpName=pickname("chapter","chapterID","chapterName",$chapter);
	
	$j=0;
	$select_topic_arr[0]=$chpName;
	$j++;
	if($fatch_arr['parentID']!=0)
	{
		$i=1;
		
		while($i==1)
		{
			$prID=$fatch_arr['parentID'];
			$quary=q("select chapterID,parentID from chapter where chapterID=$prID");
			$fatch_arr=f($quary);
			if($fatch_arr['parentID']!=0)
			{			
				$chpName=pickname("chapter","chapterID","chapterName",$fatch_arr['chapterID']);
				$select_topic_arr[$j]=$chpName;
				$j++;
			}
			else
			{
				$chpName=pickname("chapter","chapterID","chapterName",$fatch_arr['chapterID']);
				$select_topic_arr[$j]=$chpName;
				$j++;
				$i=0;
			}
		}
	}
	$select_topic_arr[$j]=$subName;
	array_reverse($select_topic_arr);
	$rtxt='';
	for($i=count($select_topic_arr)-1;$i>=0;$i--)
	{
		if($i==count($select_topic_arr)-1)		
			$rtxt.= "[ ".$select_topic_arr[$i]." ] - [ ";
		elseif($i==0)		
			$rtxt.= "<font color=\"#990000\">".$select_topic_arr[$i]."</font> ]";
		else
			$rtxt.= $select_topic_arr[$i]." ] - [ ";
	}
	return $rtxt;	
}



function Vertical($chapterName)
{
	$vtxt='';
	for($i=0;$i<strlen($chapterName);$i++)
	{
		$vtxt.= substr($chapterName,$i,1)."<br>";
	}
	return $vtxt;
}

function changeDate_YMD($date,$fromtype='')
{
	if($fromtype=='')
	{
		if(CAL_DF=='%d-%m-%Y')
		{
			$y=explode('-',$date);
			$a=$y[0];
			$b=$y[1];
			$c=$y[2];
			
			$z=array($c,$b,$a);
			$k=implode("-",$z);

			return $k; 
		}
	}
	elseif($fromtype=='FROM-MDY')
	{
		$y=explode('/',$date);
		$a=$y[0];
		$b=$y[1];
		$c=$y[2];
		
		$z=array($c,$a,$b);
		$k=implode("-",$z);
		return $k; 
	}
}

function changeDate_DMY($date)
{
			$date = substr($date, 0, 10);
			$y=explode('-',$date);
			$a=$y[0];
			$b=$y[1];
			$c=$y[2];
			
			$z=array($c,$b,$a);
			$k=implode("-",$z);

			return $k; 

}

function changeDate_MDY($date)
{
			$date = substr($date, 0, 10);
			$y=explode('-',$date);
			$a=$y[0];
			$b=$y[1];
			$c=$y[2];
			
			$z=array($b,$c,$a);
			$k=implode("-",$z);

			return $k; 

}

function changeDate_ADV($date)
{
	
	$month=array("January","Febary","March","Aprial","May","June","July","August","September","October","November","December");
	$date = substr($date, 0, 10);
	$date=explode('-',$date);
	
	$y=$date[0];
	$m=$month[$date[1]-1];
	$d=$date[2];	

	return $d." ".$m.", ".$y; 
}

function changeDate_ADVTXT($date)
{
	$month=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	$date = substr($date, 0, 10);
	$date=explode('-',$date);
	
	$y=$date[0];
	$m=$month[$date[1]-1];
	$d=$date[2];	
	
	return $m." ".$d.", ".$y; 
}


function generatePassword($length = 8)
{
	$chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
	$numChars = strlen($chars);

	$string = '';
	for ($i = 0; $i < $length; $i++) {
		$string .= substr($chars, rand(1, $numChars) - 1, 1);
	}
	return $string;
}

function setrate($value)
{

if ($value == 5)
{
	$star = "images/rate/5star.gif" ;
}
if ($value>=1)
{
	$star = "images/rate/1star.gif" ;
}
if ($value>=1.5)
{
	$star = "images/rate/15star.gif" ;
}
if ($value>=2)
{
	$star = "images/rate/2star.gif" ;
}
if ($value>=2.5)
{
	$star = "images/rate/25star.gif" ;
}
if ($value>=3)
{
	$star = "images/rate/3star.gif" ;
}	
if ($value>=3.5)
{
	$star = "images/rate/35star.gif" ;
}	
if ($value >= 4)
{
	$star = "images/rate/4star.gif" ;
}	
if ($value >= 4.5)
{
	$star = "images/rate/45star.gif" ;
}	
if ($value >= 5)
{
	$star = "images/rate/5star.gif" ;
}	
if ($value<=0)
{
	$star = "images/rate/00star.gif" ;
}

return $star;
}	


function scrollArrowsleft($m, $y)
{
	// set variables for month scrolling
	//$nextyear = ($m != 12) ? $y : $y + 1;
	//$nextmonth = ($m == 12) ? 1 : $m + 1;
	$prevmonth = ($m == 1) ? 12 : $m - 1;
	$prevyear = ($m != 1) ? $y : $y - 1;
	
	

	$s .= "<img src=\"images/img_l.jpg\" border=\"0\" onClick=\"ajax_loadContent('main_div','ajx_ecalendar.php?calview=month&day=1".$day."&month=" . $prevmonth . "&year=" . $prevyear ."')\";>";
	//$s .= "<a href=\" index.php?calview=month&day=1".$day."&month=". $nextmonth . "&year=" . $nextyear . "\">";
	//$s .= "<img src=\"images/rightArrow.gif\" border=\"0\"></a>";
	
	return $s;
}

function scrollArrowsright($m, $y)
{
	// set variables for month scrolling
	$nextyear = ($m != 12) ? $y : $y + 1;
	$nextmonth = ($m == 12) ? 1 : $m + 1;
	//$prevmonth = ($m == 1) ? 12 : $m - 1;
	//$prevyear = ($m != 1) ? $y : $y - 1;
	
	

	//$s = "<a href=\" index.php?calview=month&day=1".$day."&month=" . $prevmonth . "&year=" . $prevyear . "\">\n";
	//$s .= "<img src=\"images/leftArrow.gif\" border=\"0\"></a> ";
	$s .= "<img align=\"right\" src=\"images/img_r.jpg\" border=\"0\"  onClick=\"ajax_loadContent('main_div','ajx_ecalendar.php?calview=month&day=1".$day."&month=". $nextmonth . "&year=" . $nextyear ."')\";>";
	
	return $s;
}

function writeCalendar($month, $year)
{
	$str = getDayNameHeader();
	$eventdata = getEventDataArray($month, $year);
	// get week position of first day of month.
	$weekpos = getFirstDayOfMonthPosition($month, $year);
	// get user permission level
	//$auth = auth();
	// get number of days in month
	$days = 31-((($month-(($month<8)?1:0))%2)+(($month==2)?((!($year%((!($year%100))?400:4)))?1:2):0));
	
	// initialize day variable to zero, unless $weekpos is zero
	if ($weekpos == 0) $day = 1; else $day = 0;
	
	// initialize today's date variables for color change
	$timestamp = mktime() + CURR_TIME_OFFSET * 3600;
	$d = date(j, $timestamp); $m = date(n, $timestamp); $y = date(Y, $timestamp);
	
	// loop writes empty cells until it reaches position of 1st day of month ($wPos)
	// it writes the days, then fills the last row with empty cells after last day
	while($day <= $days) {
		
		$str .="<tr>\n";

		for($i=0;$i < 7; $i++) {
			
			if($day > 0 && $day <= $days) {
				
				// enforce title limit
				$eventcount = count($eventdata[$day]["event"]);
				
				$str .= "	<td class=\"";
				if($eventcount<>0)
				{
					if($eventdata[$day]["status"][$j]<>0)
					{
						if (($day == $d) && ($month == $m) && ($year == $y))
							$str .= "aevent_today";
						else
							$str .= "aevent_day";
					}
					else
					{
						if (($day == $d) && ($month == $m) && ($year == $y))
							$str .= "devent_today";
						else
							$str .= "devent_day";
							
					}
				}
				else
				{
					if (($day == $d) && ($month == $m) && ($year == $y))
						$str .= "today";
					else
						$str .= "day";
				}				
				$str .= "_cell\" style=\"height: 55px\" valign=\"center\">";
				
				if (($day == $d) && ($month == $m) && ($year == $y))
					$str .="<span class=\"day_number_today\">";
				else
					$str .="<span class=\"day_number\">";
				
				if ($auth)
					$str .= "<a href=\"javascript: postMessage($day, $month, $year)\">$day</a>";
				else
					$str .= "$day";
				
				$str .= "</span><br>";
				
				
				if (MAX_TITLES_DISPLAYED < $eventcount) $eventcount = MAX_TITLES_DISPLAYED;
				
				// write title link if posting exists for day
				$count=0;
				for($j=0;$j < $eventcount;$j++) {
					//$count++;
					
					$str .= "<span class=\"title_txt\">";
					//$str .= "<a href=\"javascript:openPosting(" . $eventdata[$day]["id"][$j] . ")\">";
					$str .= "<a href=\"event.php?action=viewevent&event_date=". $eventdata[$day]["event_date"][$j] . "\">";
					if($count==0)
					{
					$str .= "<br style=\"line-height:5px\"><img src=\"images/events.jpg\" border=\"0\" align=\"center\"></a></span>";
					$count++;
					}
				
				}

				$str .= "</td>\n";
				$day++;
			} elseif($day == 0)  {
     			$str .= "	<td class=\"empty_day_cell\" valign=\"top\">&nbsp;</td>\n";
				$weekpos--;
				if ($weekpos == 0) $day++;
     		} else {
				$str .= "	<td class=\"empty_day_cell\" valign=\"top\">&nbsp;</td>\n";
			}
     	}
		$str .= "</tr>\n\n";
	}
	
	$str .= "</table>\n\n";
	return $str;
}
///********************************************************
function getDayNameHeader()
{
	global $lang;
	
	// adjust day name order if weekstart not Sunday
	if (WEEK_START != 0) {
		for($i=0; $i < WEEK_START; $i++) {
			$tempday = array_shift($lang['abrvdays']);
			array_push($lang['abrvdays'], $tempday);
		}
	}
	
	$s = "<table cellpadding=\"1\" cellspacing=\"1\" border=\"0\" width=\"100%\">\n<tr>\n";
	
	foreach($lang['abrvdays'] as $day) {
		$s .= "\t<td class=\"column_header\">&nbsp;$day</td>\n";
	}

	$s .= "</tr>\n\n";
	return $s;
}
//*****************************************************************

function getEventDataArray($month, $year)
{
	//mysql_connect(DB_HOST, DB_USER, DB_PASS) or die(mysql_error());
	//mysql_select_db(DB_NAME) or die(mysql_error());
	//require "lib/conn.php";
	$user_id=$_SESSION['u_id'];
	$sql = "SELECT event_id,event_date, d, headline,status ";
	$sql .= "FROM  dt_event WHERE m = $month AND y = $year ";
	$sql .= "ORDER BY event_id";
	
	$result = mysql_query($sql) or die(mysql_error());
	
	while($row = mysql_fetch_assoc($result)) {
		$eventdata[$row["d"]]["event_date"][] = $row["event_date"];

		if (strlen($row["title"]) > TITLE_CHAR_LIMIT)
			$eventdata[$row["d"]]["event"][] = substr(stripslashes($row["event"]), 0, TITLE_CHAR_LIMIT) . "...";
		else
			$eventdata[$row["d"]]["event"][] = stripslashes($row["event"]);
		if($user_id=='')	
		{
			$eventdata[$row["d"]]["status"][] = $row["status"];
		}
		else
		{
			$q_arr=q("select row_id from dt_classmember where user_id=$user_id and class_id=".$row["class_id"]."  and is_cancel=0");
			$tot_rec=(int)nr($q_arr);
			if($tot_rec<>0)
				$eventdata[$row["d"]]["status"][] = 0;
			else
				$eventdata[$row["d"]]["status"][] = $row["status"];
		}
	}
	
	return $eventdata;
}


//***************************************************
function getFirstDayOfMonthPosition($month, $year)
{
	$weekpos = date("w",mktime(0,0,0,$month,1,$year));
	
	// adjust position if weekstart not Sunday
	if (WEEK_START != 0)
		if ($weekpos < WEEK_START)
			$weekpos = $weekpos + 7 - WEEK_START;
		else
			$weekpos = $weekpos - WEEK_START;
	
	return $weekpos;
}

function cur_convert($amt,$type)
{
	$f_cur=f(q("select * from dt_currency where is_active=1"));
	if( strtoupper($type)=='USD')
	{
		return $amt*$f_cur['usd'];
	}
	if( strtoupper($type)=='INR')
	{
		return $amt*$f_cur['inr'];
	}
}

function msgbox($msgno,$str1="",$str2="",$str3="")
{
$php_msgarr[0]="Data has been saved successfully !";
$php_msgarr[1]="Data has been updated successfully !";
$php_msgarr[2]="Data has been deleted successfully !";
$php_msgarr[3]="Invalid user name or password !";
$php_msgarr[4]="User already exist !";
$php_msgarr[5]="$str1 must be greater than $str2";
$php_msgarr[6]="$str1 must be less than $str2";
$php_msgarr[7]="$str1 must be equal with $str2";
$php_msgarr[8]="$str1 must be greater than or equal to $str2";
$php_msgarr[9]="Sorry !<br> This record already tagged with ohter records!";
$php_msgarr[10]="Please enter your $str1";
$php_msgarr[11]="Please specify your $str1";
$php_msgarr[12]="We are sorry!There are some technical error occured! ";
$php_msgarr[13]="We are sorry! but there are some technical error! The error has been sent to the".SITE_NAME." !";
$php_msgarr[14]="$str1 has been updated successfully!We will check it soon.";
$php_msgarr[15]="Please enter $str1";
$php_msgarr[16]="$str1 cant be left blank.";
$php_msgarr[17]="Invalid email address.";
$php_msgarr[18]="Email address not found.";
$php_msgarr[19]="Duplicate email address.";
$php_msgarr[20]="Duplicate user name.";
$php_msgarr[21]="Password must be greater than or equal to 8 characters.";
$php_msgarr[22]="Password didn't matched.";
$php_msgarr[23]="You have successfully logged in.";
$php_msgarr[24]="Your registration not been activated .<br>Please check your mail at ".$str1." and follow the instraction.";
$php_msgarr[25]="Your registration has been deactivated by site administrator.";
$php_msgarr[26]="Invalid user name or password!";
$php_msgarr[27]="No file to upload or file size greater than maximum permited size (500 KB) ! <br>";
$php_msgarr[28]="Invalid format of file [ ".$str1." ] !<br>";
$php_msgarr[29]="Some problem with copying file !<br>";
$php_msgarr[30]="Image has been uploaded successfully.<br>";
$php_msgarr[31]="$str1 Password didn't matched.";
$php_msgarr[32]="Please verify $str1!";
$php_msgarr[33]="The recipe has been added to your favourite list !";
$php_msgarr[34]="Your invitation has been send successfully to ".$str1.".";
$php_msgarr[35]="You are already joined to this community,please login and check your friend list.";
$php_msgarr[36]="Your registration has completed successfully,you can login after activation by admin";
$php_msgarr[37]="This $str1 already exist in our database,please make a change";
$php_msgarr[38]="This $str1 already published in our site, user can't change this";
$php_msgarr[39]="Your registration has been activated.<br> Feel free and login now.";
$php_msgarr[40]="Your are already an active user.";
$php_msgarr[41]="Only the user of Japan can register in this class.";
$php_msgarr[42]="Your message is on its way!";
$php_msgarr[43]="The item has been added to your shopping list !";
$php_msgarr[44]="No Friend Selected!";
$php_msgarr[45]="Newsletter has been sent successfully to $str1 !";
$php_msgarr[46]="Your password has been retrived successfully.<br>Please check your mail !";
$php_msgarr[47]="Your password has been changed successfully.<br>Please sign in with the new password!";
$php_msgarr[48]="Your recipe has been saved successfully.";
$php_msgarr[49]="Your recipe has been updated successfully.";
$php_msgarr[50]="Please select $str1.";
$php_msgarr[51]="Please locate your map.";
$php_msgarr[52]="Sorry this record not been deleted!<br> This $str1 already tagged with other $str2!";
$php_msgarr[53]="Please enter your email address properly.";
$php_msgarr[54]="Email-id already exist! Please enter another Email-id!";
$php_msgarr[55]="Hotel Type name already exist!";
$php_msgarr[56]="Room Type name already exist!";
$php_msgarr[57]="Hotel Type name cant be left blank!";
$php_msgarr[58]="$str1 already exist!";
$php_msgarr[59]="Banner name cant be left blank!";
$php_msgarr[60]="Banner Link cant be left blank!";
$php_msgarr[61]="Your inquiry has been sent to administrator.";
$php_msgarr[62]="Data cannot be deleted.Applicant has already posted for this job.";
$php_msgarr[63]="Your subscribtion has been completed succussfully.<br>You will get our newsletter soon.";
$php_msgarr[64]="Sorry, you have provided an invalid security code";
return $php_msgarr[$msgno];

}

function cl($id)
{
	if($_SESSION['language']=='EN')
	{
		$f_sql=f(q("select EN from sys_words where id='$id'"));
	}
	else
	{
		$f_sql=f(q("select ".$_SESSION['language'].",EN from sys_words where id='$id'"));
	}
	if($f_sql[0]=='' || !isset($f_sql[0]))
		return nl2br($f_sql[1]);	
	else
		return nl2br($f_sql[0]);	
}

function corrency_convert($tocur,$fromcur,$amt)
{
	if($tocur==$fromcur)
	{
		$amt=round($amt);
		return $amt;
	}
	else
	{
		$f_ar=f(q("select * from dt_currency where is_active=1"));
		$tocur=strtolower($tocur);
		$amt=round($amt*$f_ar["$tocur"]);
		return $amt;
	}
}

function left_tree($pmenu_id)
{

	 $q_arr_1=q("select * from dt_emenu where pmenu_id=$pmenu_id order by menu_id");						 
	 while($f_submenu=f($q_arr_1)){
		$menu_id=$f_submenu['menu_id'];
		if($f_submenu['page_id']<>0)
			$link="cmspage.php?page_id=".$f_submenu['page_id']."&menu_id=".$f_submenu['menu_id'];
		else
			$link=$f_submenu['pagelink'];
		
		$subpic="";
		$q_cchecksub=q("select menu_id from dt_emenu where pmenu_id=$menu_id");
		$tot_sub=(int)nr($q_cchecksub);
		if($tot_sub<>0)
			$link="#";
		echo "<div style=\"padding-left:1px;\"><li><a href=\"".$link."\">".$f_submenu['mname']."$subpic</a>";
		if($tot_sub<>0)
		{
			left_tree($menu_id);
		}
		echo "</li></div>";
	 }
}

function menu_tree($pmenu_id,$top_pos=0,$left_pos=2)
{

echo "<div class=\"imsc\"><div class=\"imsubc\" style=\"width:200px;top:".$top_pos."px;left:".$left_pos."px;\"><ul style=\"\">";
						 $q_arr_1=q("select * from dt_emenu where pmenu_id=$pmenu_id order by menu_id");						 
						 while($f_submenu=f($q_arr_1)){
						 	$menu_id=$f_submenu['menu_id'];
							if($f_submenu['page_id']<>0)
								$link="cmspage.php?page_id=".$f_submenu['page_id']."&menu_id=".$f_submenu['menu_id'];
							else
								$link=$f_submenu['pagelink'];
							
							$subpic="";
							$q_cchecksub=q("select menu_id from dt_emenu where pmenu_id=$menu_id");
							$tot_sub=(int)nr($q_cchecksub);
							if($tot_sub<>0)
							{
								$link="#";
								//$subpic="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;";
							}	
						 	echo "<li style=\"list-style:none; list-style-image:url(../images/bullet.jpg);\"><a href=\"".$link."\" class=\"menu_r\">".$f_submenu['mname']."$subpic</a>";
							if($tot_sub<>0)
							{
								menu_tree($menu_id,-15,150);
							}
							echo "</li>";
						 }
						echo "</ul></div></div>";
}


/*
**********************************************************************************************************************************
**********************************************************************************************************************************
The following functions are wriiten for Golden Future Growth PLan and Binary Plan
**********************************************************************************************************************************
**********************************************************************************************************************************
*/

/*
*********************************************************************************
Function for calculating Growth Income:
--------------------------------------
Two parameters are there, one is ID i.e. uid of that member from dt_member_details, send one is Total number of Members on that payout date.

Two arrays $a and $b are taken to determine the start and end value of a group wise structure such as 1-50,51-100,101-200 etc. 
First it will check that total number of members i.e. $member is in which group, if found then it will check the id's location in group.
Then it calculates and return the growth Income as per rule such as if total member is 400, then id between 1-50 will get 200,
51-100 will get 100, 101-200 will get 50 and 201-400 will not get any amount.

*********************************************************************************
*/

function getCost($id,$member)
{
	$a=array("50","100","200","400","800","1600","3200","6400","12800","25600","51200","102400");
	$b=array("1","51","101","201","401","801","1601","3201","6401","12801","25601","51201");
	
	for($i=0,$j=0;$i<count($a);$i++,$j++)
	{
		if($member>=$b[$j] && $member<=$a[$i])               //Check which group Total Member Number is in
		{
			$pct=($member/$a[$i])*100;                       //Calculate percentage of total member against highest range
		
			for($k=1;$k<=$i;$k++)
			{
				if($id>=$b[$k-1] && $id<=$a[$k-1])           //Check in which group ID is located
				{
					$p=$i-($k-1);
					
					$mcost=$a[$p-1]*($pct/100);              //Calculates Growth Income
					break;
				}
			}								
			break;
		}
	}
	return $mcost;
}


/*
*********************************************************************************
Function for showing members of Two levels of the given ID:
-----------------------------------------------------------
There is one parameter i.e. Member ID.
This function returns the child member ids of next two levels as array. The first element contains immediate 1st level members, and 2nd 
element contains level 2 members.

*********************************************************************************
*/

function getMember($mem_id)
{
	$level1='';
	$level2='';
	
	$q_rec=mysql_query("select * from dt_member_master where ref_id='$mem_id'");
	while($f_rec=mysql_fetch_array($q_rec))
	{
		$q_res=mysql_query("select * from dt_member_master where ref_id='".$f_rec['mem_id']."'");
		while($f_res=mysql_fetch_array($q_res))
		{
			$level2.=$f_res['mem_id'].",";
		}
		
		$level1.=$f_rec['mem_id'].",";
	}
	$lvl2=substr($level2,0,-1);
	$lvl1=substr($level1,0,-1);
	
	return $arr=array("$lvl1","$lvl2");	
}


/*
*********************************************************************************
Recursive Function for calculating Sponsor's Incentive upto 25th level:
----------------------------------------------------------------------
There are four parameters, Member ID, amount, Next level of Member, loop counter
Initially $amt1 and $i must send 0 i.e. ZERO
$level is to be sent as the next level of $mem_id
Sponsor Income will take place upto 25th level and amount will be generated as per rule.
Next 1 to 14 level per head Rs.10 and 15-25 per head Rs.25
 
*********************************************************************************
*/

function getSponsorIncome($mem_id,$amt1,$level,$i)
{
	while($i<25)
	{
		if($i==0)
	  	{
	    	$q_arr="select * from dt_member_master where ref_id='$mem_id' and level='$level'";
			$q_res=mysql_query("select * from dt_member_master where ref_id='$mem_id' and level='$level'");	
			$amt=mysql_num_rows($q_res);
			$amt1=$amt1;
	 	}	
	 	else
		{
			//more than one $mem_id is passed in following query
			$q_arr="select * from dt_member_master where ($mem_id) and level='$level'";
			$q_res=mysql_query("select * from dt_member_master where ($mem_id) and level='$level'");	
			$amt=mysql_num_rows($q_res);
			if($i<15)
			{
				$amt1+=$amt*10;
			}
			if($i>=15 && $i<25)
			{
				$amt1+=$amt*5;
			}
		}

		$output=array();			
		
		while($f_res=mysql_fetch_array($q_res))
		{
			$output[] = "ref_id = '".$f_res['mem_id']."' ";	
		}
		$i=$i+1;
		$level=$level+1;
 
		$mem_id = implode(' or ', $output);
		return getSponsorIncome($mem_id,$amt1,$level,$i);	//Function call itself with new value of each parameter	
	}	
	  
	return $amt1;
	break;
}


/*
*********************************************************************************
Recursive Function for calculating total number of member of a given member upto 15th level:
--------------------------------------------------------------------------------------------
There are four parameters, Member ID, amount, Next level of Member, loop counter
Initially $amt1 and $i must send 0 i.e. ZERO
$level is to be sent as the next level of $mem_id

*********************************************************************************
*/

function getTotMember($mem_id,$amt1,$level,$i)
{
	while($i<15)
	{
		if($i==0)
	  	{
	    	$q_arr="select * from dt_member_master where ref_id='$mem_id' and level='$level'";
			$q_res=mysql_query("select * from dt_member_master where ref_id='$mem_id' and level='$level'");	
			$amt=mysql_num_rows($q_res);
			$amt1+=$amt;
	 	}	
	 	else
		{
			$q_arr="select * from dt_member_master where ($mem_id) and level='$level'";
			$q_res=mysql_query("select * from dt_member_master where ($mem_id) and level='$level'");	
			$amt=mysql_num_rows($q_res);
			$amt1+=$amt;			
		}
		//echo $q_arr;
		$output=array();			
		
		while($f_res=mysql_fetch_array($q_res))
		{
			$output[] = "ref_id = '".$f_res['mem_id']."' ";	
		}
		$i=$i+1;
		$level=$level+1;
 
		$mem_id = implode(' or ', $output);
		return getTotMember($mem_id,$amt1,$level,$i);		
  }
	return $amt1;
	break;
}


/*
*********************************************************************************
Recursive Function for calculating number of members of a given member upto 15th level at each level:
----------------------------------------------------------------------------------------------------
There are four parameters, Member ID, amount, Next level of Member, loop counter
Initially $amt1 and $i must send 0 i.e. ZERO
$level is to be sent as the next level of $mem_id

*********************************************************************************
*/

function getLevelMember($mem_id,$cn1,$level,$i)
{
	while($i<15)
	{
		if($i==0)
	  	{
			$q_cnt=mysql_query("select count(*) as cn from dt_member_master where ref_id='$mem_id' and level='$level'");
		
			$q_res=mysql_query("select * from dt_member_master where ref_id='$mem_id' and level='$level'");			
	    	$f_cnt=mysql_fetch_array($q_cnt);
			$cn1=$f_cnt['cn'].",";			
	 	}	
	 	else
		{
			$q_cnt=mysql_query("select count(*) as cn from dt_member_master where ($mem_id) and level='$level'");
			
			$q_res=mysql_query("select * from dt_member_master where ($mem_id) and level='$level'");
			$f_cnt=mysql_fetch_array($q_cnt);				
			$cn1.=$f_cnt['cn'].",";			
		}
		//echo $q_arr;
		$output=array();			
		
		while($f_res=mysql_fetch_array($q_res))
		{
			$output[] = "ref_id = '".$f_res['mem_id']."' ";	
		}
		$i=$i+1;
		$level=$level+1;
 
		$mem_id = implode(' or ', $output);
		return getLevelMember($mem_id,$cn1,$level,$i);		
  }
	return $cn1;
	break;
}


/*
*********************************************************************************
Recursive Function for calculating Leaders Dhamaka:
---------------------------------------------------

*********************************************************************************
*/

function dhamaka($mem_id,$set,$level,$i,$amt)
{
	$arr=array(0,0,4000,20000,65000,200000,500000,2000000,10000000);
	if($level==1)
	{
		$result = q("SELECT COUNT(*) FROM dt_member_master WHERE ref_id='$mem_id' ") or die(mysql_error());
	}	
	else
	{
		$result = q("SELECT COUNT(*) FROM dt_member_master WHERE ($mem_id) ") or die(mysql_error());
	}
		
	$row=f($result);
	$count=$row['COUNT(*)']."<br />";
	$div=pow(5,$level);
	$cnt=floor($count/$div);
	$val=$cnt*$div;

	if($cnt>=1)
	{
		if($level==1)
		{
			$result1=q("SELECT mem_id from dt_member_master WHERE ref_id='$mem_id' limit 0,$val ")or die(mysql_error());
        }
		else
		{
			$result1=q("SELECT mem_id from dt_member_master WHERE ($mem_id) limit 0,$val")or die(mysql_error());
		}
		$output = array();

        while ($row1 = f($result1)) 
		{
			$output[] = "ref_id = '".$row1['mem_id']."' ";
        }

		if($level>=2)
		{
			$m_id=explode(" or ",$mem_id);
					
			$is_five=0;
			$count_five=1;
			$set=0;
			for($x=1;$x<=count($m_id);$x++)
			{
				  
				$y=$x-1;
				$f_count=f(q("select count(*) as tot_mem from dt_member_master where $m_id[$y]"));
				  
				if($f_count['tot_mem']>=5)
				{
					$is_five+=1;
				}				
					
				if($x%5==0)
				{
				   	if($is_five==5)
					{
						$count_five=$count_five*5;
					}
					else
					{
						$count_five=$count_five;
						$cnt=$cnt-1;
					}
					$is_five=0;
						
					} 
				}

				if($count_five%5==0)
				{
				   	if($cnt==0)
				   	{
				   		$cnt=1;
				   	}	 
				    $amt=$amt+($arr[$level]*$cnt);
					$i=$i+1;
				  	$level=$level+1;
				  	$status=1;					
				}				
			}
			
			if($level==1)
			{	 
				$i=$i+1;
				$level=$level+1;	
				$status=1;
				$amt=0;
			}
			
			if($status==1)
			{			   	  
				$set=$cnt;				
				$mem_id = implode(' or ', $output);
				return dhamaka($mem_id,$set,$level,$i,$amt);
			}
		}
	return $amt;
	break; 
}


/*
*********************************************************************************
Recursive Function for calculating total number of levels of the given Member:
------------------------------------------------------------------------------
This function contains two parameters: Member Id and level, initially level is set to 0 i.e. ZERO.

*********************************************************************************
*/

function find_level($pid,$level)
{
   
    if($level==0)
	  $result = q("SELECT COUNT(*) FROM dt_binary WHERE parent_id='$pid' ")or die(mysql_error());
	else
	  $result = q("SELECT COUNT(*) FROM dt_binary WHERE ($pid) ")or die(mysql_error());
    while($row = f( $result )) {

    $lvlparent = $row['COUNT(*)'];
	}
	//$tot=pow(2,$level);
	if($lvlparent>0)
	{
	      if($level==0)
	         $result1=q("SELECT user_id from dt_binary WHERE parent_id='$pid' ")or die(mysql_error());
		  else
			 $result1=q("SELECT user_id from dt_binary WHERE ($pid)")or die(mysql_error());
		  $output = array();
		  while ($row = f($result1)) {
		  $output[] = "parent_id = '".$row['user_id']."' ";
         }
	
      $level=$level+1;
	  $pid = implode(' or ', $output);
      return find_level($pid,$level);
   }
   else {
		return $level;	
		break;
   } 
} 


/*
*********************************************************************************
Direct Income of Binary:
------------------------
There is one parameter i.e. Member ID
It will count the number of direct member who are referred by the Member maximum Two and return direct income

*********************************************************************************
*/

function bin_direct($mem_id)
{
	$q_arr=q("select * from dt_binary where ref_id='$mem_id'");
	$cnt=(int)nr($q_arr);
	if($cnt>=2)
	{
		$amt=2*200;
	}
	else
	{
		$amt=$cnt*200;
	}
	return $amt;
}

/*
*********************************************************************************
Spill Income of Binary:
-----------------------
There is one parameter i.e. Member ID
It will count the total number of direct members who are referred by the Member. If the number of member count is greater that 2 then
First two are not included to count Spill Income. Because they are choosen under direct Income.
Finally the income amount is generated.

*********************************************************************************
*/

function bin_spill_income($mem_id)
{
	$q_spill=q("select * from dt_binary where ref_id='$mem_id'");
	$cnt=(int)nr($q_spill);
	if($cnt>=2)
	{
		$tot=$cnt-2;
	}
	else
	{
		$tot=0;
	}
	return $tot*200;	
}


/*
*********************************************************************************
To find number of child of a member:
------------------------------------
There is two parameter i.e. Member id and value.
This function is called with the Member Id, it calculates the number of child the id have.
$val id initially set to 1, it will be incremented and recusrsively this function calls itself.
This function is called for next following functions.
*********************************************************************************
*/

function child($pid,$val)
{
	if($val==1)
	{
		$result=q("SELECT COUNT(*) FROM dt_binary WHERE parent_id='$pid'") or die(mysql_error());
	} 
	else
	{
		$result=q("SELECT COUNT(*) FROM dt_binary WHERE ($pid)") or die(mysql_error());
	}

	while($row=f($result))
	{
		$lvl2parent = $row['COUNT(*)'];
	}
	
	if($lvl2parent<>0)
	{
		if($val==1)
	    	$result1=q("SELECT user_id from dt_binary WHERE parent_id='$pid'") or die(mysql_error());
     	else
			$result1=q("SELECT user_id from dt_binary WHERE ($pid)") or die(mysql_error());

		$output = array();
		while($row=f($result1))
		{
			$output[]="parent_id='".$row['user_id']."'";
		}
		
		$pid=implode(' or ', $output);
		$val=$lvl2parent+$val;
		return child($pid,$val);
  	}
	else
  	{
		return $val;
  	} 
}


/*
*********************************************************************************
To find number of child of a member who use the member as RefId or Spill Id:
---------------------------------------------------------------------------
There is FIVE parameters i.e. $pid,$mem_id,$ref,$tot,$val
$pid is Parent Id which is used to find its immediate next children.
$mem_id is Member Id which is used to check whether the child members in resultset have RefId or Spill Id same to this Member Id
$ref is Refrence Id which is sent as a Child of Member Id and used to check whether the child members in resultset have RefId or Spill Id same to these RefIds
$tot is Total, its value increamented when The user id found who have RefId or Spill Id similar to Member Id or Reference Ids
$val is used as counter variable, it is initially set as 0.
This function is called for next following functions.

*********************************************************************************
*/

function direct_child($pid,$mem_id,$ref,$tot,$val)
{
	if($val==1)
	{
		$result = mysql_query("SELECT COUNT(*) FROM dt_binary WHERE parent_id='$pid'")or die(mysql_error());
		$ref_arr = array($ref); //An array is created with the reference id initially sent
	} 
	else
	{
		$result = mysql_query("SELECT COUNT(*) FROM dt_binary WHERE ($pid) ")or die(mysql_error());
		$ref_arr = explode(",",$ref);   //When $val is increamented, $ref is getting more id separated by ','.So it's exploded to create an array
    }
	
    while($row = mysql_fetch_array( $result )) 
	{
		$lvl2parent = $row['COUNT(*)'];
	}
	
	if($lvl2parent<>0)
	{
		if($val==1)
	    {	
			$result1=mysql_query("SELECT ref_id,spill_id,user_id from dt_binary WHERE parent_id='$pid' ")or die(mysql_error());
		}	
      	else
		{
			$result1=mysql_query("SELECT ref_id,spill_id,user_id from dt_binary WHERE ($pid)")or die(mysql_error());
		}
	   
		$output = array();		
       	
		while ($row = mysql_fetch_array($result1)) 
		{
			if($mem_id==$row['ref_id'] || $mem_id==$row['spill_id'] || in_array($row['ref_id'],$ref_arr) || in_array($row['spill_id'],$ref_arr))
			{
				$tot=$tot+1;
				array_push($ref_arr,$row['user_id']);			//When User Id found, it push into array
		    }
			
			$output[] = "parent_id = '".$row['user_id']."'";
    	}
		
		$pid = implode(' or ', $output);
		$ref = implode(',', $ref_arr);   //array elements are sent by separating them with ','
		$val=$val+1;
		return direct_child($pid,$mem_id,$ref,$tot,$val);
	}
  	else
	{
    	return $tot;
  	} 
}



/*
*********************************************************************************
This function counts the number of members have same pair:
---------------------------------------------------------
This function is called with parameter as Pair. This function checks each members and find out the number of members who have
same pair and return it.

This function is called for next following functions.

*********************************************************************************
*/

function bin_residual($club)
{
	$residual=array("100","250","500","1000");
	$count==0;
	$q_mem=q("select * from dt_binary,dt_binary_members where dt_binary.user_id=dt_binary_members.mem_id and dt_binary_members.join_date>(select max(payout_dt) from dt_bin_payout)");
	while($f_mem=f($q_mem))
	{
		$mem_id=$f_mem['user_id'];
		$f_left=f(q("select * from dt_binary where position='L' and parent_id='$mem_id'"));
		$f_right=f(q("select * from dt_binary where position='R' and parent_id='$mem_id'"));
		
		if($f_left['user_id']<>'')
		{
			$rec=mysql_query("select * from dt_binary where user_id='".$f_left['user_id']."' and ref_id='$mem_id' or spill_id='$mem_id'");
			if((int)mysql_num_rows($rec)>0)
			{
				$left_child=direct_child($f_left['user_id'],$mem_id,$f_left['user_id'],1,1);
			}
			else
			{
				$left_child=direct_child($f_left['user_id'],$mem_id,$mem_id,0,1);
			}			
		}
		else
		{
			$left_child=0; 
		}
		
		if($f_right['user_id']<>'')
		{
			$rec1=mysql_query("select * from dt_binary where user_id='".$f_right['user_id']."' and ref_id='$mem_id' or spill_id='$mem_id'");
			if((int)mysql_num_rows($rec1)>0)
			{
				$right_child=direct_child($f_right['user_id'],$mem_id,$f_right['user_id'],1,1);
			}
			else
			{
				$right_child=direct_child($f_right['user_id'],$mem_id,$mem_id,0,1);
			}
		}
		else
		{
			$right_child=0; 
		}
				
		$pair=min($left_child,$right_child);	
			
		if($pair==$club)
		{
			$count=$count+1;
		}
	}
	return $count;	
}


/*
*********************************************************************************
To find residual income of a member sent by parameter:
---------------------------------------------------------
This function is called with Member Id. This function find out the pair and calculates the Residual Income.
It got the total number of members who also have same pair. Then calculates the amount.

*********************************************************************************
*/

function bin_residual_income($mem_id)
{
	$residual=array("100","250","500","1000");
	
	//echo $mem_id;
	$f_left=f(q("select * from dt_binary where position='L' and parent_id='$mem_id'"));
	$f_right=f(q("select * from dt_binary where position='R' and parent_id='$mem_id'"));
		
	if($f_left['user_id']<>'')
	{
		$rec=mysql_query("select * from dt_binary where user_id='".$f_left['user_id']."' and ref_id='$mem_id' or spill_id='$mem_id'");
		if((int)mysql_num_rows($rec)>0)
		{
			$left_child=direct_child($f_left['user_id'],$mem_id,$f_left['user_id'],1,1);
		}
		else
		{
			$left_child=direct_child($f_left['user_id'],$mem_id,$mem_id,0,1);
		}
	}
	else
	{
		$left_child=0; 
	}
	
	if($f_right['user_id']<>'')
	{
		$rec1=mysql_query("select * from dt_binary where user_id='".$f_right['user_id']."' and ref_id='$mem_id' or spill_id='$mem_id'");
		if((int)mysql_num_rows($rec1)>0)
		{
			$right_child=direct_child($f_right['user_id'],$mem_id,$f_right['user_id'],1,1);
		}
		else
		{
			$right_child=direct_child($f_right['user_id'],$mem_id,$mem_id,0,1);
		}	
	}
	else
	{
		$right_child=0; 
	}
			
	$pair=min($left_child,$right_child);				
	
	for($i=0;$i<count($residual);$i++)
	{
		if($pair==$residual[$i])
		{
			$maxtot=bin_residual($pair);
		}
	}
	
	$f_memtot=f(q("select count(*) from dt_binary,dt_binary_members where dt_binary.user_id=dt_binary_members.mem_id and dt_binary_members.join_date>(select max(payout_dt) from dt_bin_payout)"));
	$count=$f_memtot['count(*)'];
	$income=(25*$count)/$maxtot;
	return $income;
}


/*
*********************************************************************************
Pair Income is calculated:
---------------------------------------------------------
This function is called with Member Id. This function find out the pair and calculates the Pair Income.
The amount should be within Rs.25000

*********************************************************************************
*/

function bin_pair_income($mem_id)
{
	$f_left=mysql_fetch_array(mysql_query("select * from dt_binary where position='L' and parent_id='$mem_id'"));
	$f_right=mysql_fetch_array(mysql_query("select * from dt_binary where position='R' and parent_id='$mem_id'"));
		
	if($f_left['user_id']<>'')
	{
		$rec=mysql_query("select * from dt_binary where user_id='".$f_left['user_id']."' and ref_id='$mem_id' or spill_id='$mem_id'");
		if((int)mysql_num_rows($rec)>0)
		{
			$left_child=direct_child($f_left['user_id'],$mem_id,$f_left['user_id'],1,1);
		}
		else
		{
			$left_child=direct_child($f_left['user_id'],$mem_id,$mem_id,0,1);
		}	
	}
	else
	{
		$left_child=0; 
	}
	
	if($f_right['user_id']<>'')
	{
		$rec1=mysql_query("select * from dt_binary where user_id='".$f_right['user_id']."' and ref_id='$mem_id' or spill_id='$mem_id'");
		if((int)mysql_num_rows($rec1)>0)
		{
			$right_child=direct_child($f_right['user_id'],$mem_id,$f_right['user_id'],1,1);
		}
		else
		{
			$right_child=direct_child($f_right['user_id'],$mem_id,$mem_id,0,1);
		}		
	}
	else
	{
		$right_child=0; 
	}
			
			
	$pair=min($left_child,$right_child);				
		
	$amt=(200*$pair);
	
	if($amt<25000)
	{
		$income=$amt;
	}
	else
	{
		$income=25000;
	}
	
	return $income;
}



/*
*********************************************************************************
Calculate difference in days between two months:
------------------------------------------------
This function returns the day difference between two given date as parameter

*********************************************************************************
*/

function daysDifference($endDate, $beginDate)
{
   //explode the date by "-" and storing to array
   $date_parts1=explode("-", $beginDate);
   $date_parts2=explode("-", $endDate);
   //gregoriantojd() Converts a Gregorian date to Julian Day Count
   $start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
   $end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
   return $end_date - $start_date;
}


/*
*********************************************************************************
Gift Calculation within SIX months:
-----------------------------------
This function returns the gift while checking the pair is in what group.

*********************************************************************************
*/

function bin_gift($mem_id)
{
	$arr1=array("50","100","200","300","500","1000","2000","5000","10000");
	$arr2=array("Mixer Grinder","Color TV","Laptop","Pulsor","Yamaha R-15","Alto Car","Indica","Honda City","Scorpio");
	
	$f_time=f(q("select * from dt_binary_members where mem_id='$mem_id'"));
	$daydiff=daysDifference(date("Y-m-d"),$f_time['join_date']);  //It calculates day difference between two dates
	if($daydiff<=180)
	{
		$f_left=f(q("select * from dt_binary where position='L' and parent_id='$mem_id'"));
		$f_right=f(q("select * from dt_binary where position='R' and parent_id='$mem_id'"));
			
		if($f_left['user_id']<>'')
		{
			$rec=mysql_query("select * from dt_binary where user_id='".$f_left['user_id']."' and ref_id='$mem_id' or spill_id='$mem_id'");
			if((int)mysql_num_rows($rec)>0)
			{
				$left_child=direct_child($f_left['user_id'],$mem_id,$f_left['user_id'],1,1);
			}
			else
			{
				$left_child=direct_child($f_left['user_id'],$mem_id,$mem_id,0,1);
			}
			//$left_child=child($f_left['user_id'],1);
		}
		else
		{
			$left_child=0; 
		}
		
		if($f_right['user_id']<>'')
		{
			$rec1=mysql_query("select * from dt_binary where user_id='".$f_right['user_id']."' and ref_id='$mem_id' or spill_id='$mem_id'");
			if((int)mysql_num_rows($rec1)>0)
			{
				$right_child=direct_child($f_right['user_id'],$mem_id,$f_right['user_id'],1,1);
			}
			else
			{
				$right_child=direct_child($f_right['user_id'],$mem_id,$mem_id,0,1);
			}	
			
			//$right_child=child($f_right['user_id'],1);
		}
		else
		{
			$right_child=0; 
		}
				
				
		$pair=min($left_child,$right_child);					
			
	
		for($i=count($arr1)-1;$i>=0;$i--)
		{
			if($pair==$arr1[$i])
			{
				$gift=$arr2[$i];
				break;
			}
		}	
	}
	
	return $gift;
}


/*
*********************************************************************************
Count Left Child and Right Child:
---------------------------------
The member id is sent, it calculates the number of Left child and right child  and return as an array

*********************************************************************************
*/

function bin_child($mem_id)
{
	$f_left=f(q("select * from dt_binary where position='L' and parent_id='$mem_id'"));
	$f_right=f(q("select * from dt_binary where position='R' and parent_id='$mem_id'"));

	if($f_left['user_id']<>'')
	{
		$left_child=child($f_left['user_id'],1);
	}
	else
	{
		$left_child=0; 
	}
	
	if($f_right['user_id']<>'')
	{
		$right_child=child($f_right['user_id'],1);
	}
	else
	{
		$right_child=0; 
	}
	
	return $child=array("$left_child","$right_child");	
}


/*
*********************************************************************************
Count Total Member:
---------------------------------
This function is general function used to count total number of members

*********************************************************************************
*/

function totmem()
{
 	$sql="select count(*) as c from dt_binary_members";
	$rs=q($sql);
	$f_rs=f($rs);
	return $f_rs['c'];
}
 
 
/*
*********************************************************************************
Find Parent Node:
-----------------
This recursive function found the Parent Node of given id for the given position

*********************************************************************************
*/
 
function find_parent_node($sid,$spos)
{
	$q_child=q("select * from dt_binary where parent_id='$sid' and position='$spos'");
  	if((int)nr($q_child)>0)
  	{
		$f_child=f($q_child);
	   	$sid=$f_child['user_id'];
	   	return find_parent_node($sid,$spos);
	}	
  	else  
  	{
		return $sid;
		break;
  	}   
}

function check_member($intro_id="")
{
	// first check spill id and check for vacant position
		$sql=q("SELECT * FROM `dt_join` WHERE `user_id`='".$intro_id."' and `child_count`< '5'");
		//echo "SELECT * FROM `dt_join` WHERE `user_id`='DC0100000001' and `child_count`< '3'";
		 if((int)nr($sql)=='1') // postion vacant. proceed
		 {
				/*//if 1st condition matches check whether spill id is in the tree of introducer id.
				if($spill_id<>$intro_id)// 
				{
						$chk_intro_id=find_intro_id($spill_id,$intro_id);
						//echo $chk_intro_id;
						if($chk_intro_id>0)
						{
							return 1;
						
						}
						else
						{
						 return -1; // invalid team
						}
				}
			 else
			 {
			  return 1; //same introducer same spill 
			 }
			 */
			 
			 $res = f($sql);
			 $parent_id = $res['user_id'];
			 $child_count = $res['child_count']+1;
			 $level = $res['level']+1;
			 $url = "chk_tree=1@parent_id=$parent_id@child_count=$child_count@level=$level";
			 return $url;
			  
			 					
						 
		 }
		else
		{
			$url = "chk_tree=-2@parent_id=0@child_count=0@level=0";
			return $url; //postion is not vacant
		} 

	}

function find_intro_id($spill_id="",$intro_id="")
{
	if($spill_id=="0")
	{
		return 0;
	}
	$sql=q("SELECT parent_id FROM dt_binary WHERE user_id='$spill_id'");
	//echo "SELECT parent_id FROM dt_binary WHERE user_id='$spill_id' ";
	if((int)nr($sql)>0)
	{
		$f_parent_id=f($sql);
		//echo $f_parent_id["parent_id"]."--".$intro_id ;
		if($f_parent_id["parent_id"]=="$intro_id")
		{
		  
			return 1;// $f_parent_id["parent_id"];
			//exit();
		
		}
		/*else if($f_parent_id["parent_id"]==0)
		{
			return 0;
			break;
		}*/
		
		else 
		{
		  return find_intro_id($f_parent_id["parent_id"],$intro_id);
		}
	}
	


}

?>