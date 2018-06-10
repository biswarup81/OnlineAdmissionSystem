<?
ob_start();
session_start();
//error_reporting(E_ALL ||E_NOTICE|| E_WARNING);
error_reporting(0);
ini_set('date.timezone', 'Asia/Calcutta');

ini_set("MAX_EXECUTION_TIME","0");
define("UPLOAD_SIZE",5120000);
define("UPLOAD_SIZE_TXT","500 kb");

//define("ROOT","dkm/");
define("ROOT","");

//define("WEBDIR","http://php/");
define("WEBDIR","http://www.rubyglitz.com/");
//define("PARTNERS_LOGO","partners_logo/");

define("SITE_NAME","Ruby India");
define("LINK_NAME","Ruby India");
define("LINK","http://www.rubyglitz.com/");

$show_rec_per_page=5;
	
define("PHY_ROOT",$_SERVER['DOCUMENT_ROOT']."/");

define("CAL_DF","%d-%m-%Y");
global $db_host,$db_login,$db_pswd,$db_name,$connected;

$db_host = 'localhost';
$db_login= 'onlinead_kandra';
$db_pswd = '#x9I@V1RBNhu';
$db_name = 'onlinead_kandra';




/*$db_host = 'localhost';
$db_login= 'swarnato_ampl';
$db_pswd = 'swarnato_ampl123';
$db_name = 'swarnato_ampl';*/




$connected = false;

/*******************************************************
************* Calendar Layout Options ******************
*******************************************************/

// Maximum number of event titles that appear per day 
// on month-view.  Note: doesn't limit number of 
// events a user can post, just what appears on month
// view.
define("MAX_TITLES_DISPLAYED", 5);
// Title character limit.  Adjust this value so event
// titles don't take more space than you want them to
// on calendar month-view.
define("TITLE_CHAR_LIMIT", 37);
// Allows you to specify the weekstart, or the day
// the calendar starts with.  The value must be
// a numeric value from 0-6.  Zero indicates that the
// weekstart is to be Sunday, 1 indicates that it is
// Monday, 2 Tuesday, 3 Wednesday... For most users
// it will be zero or one.
define("WEEK_START", 0);
// Allows you to specify the format in which time
// values are output.  Currently there are two
// formats available: "12hr", which displays
// hours 1-12 with an am/pm, and "24hr" which
// display hours 00-23 with no am/pm.
define("TIME_DISPLAY_FORMAT", "12hr");
// This directive allows you to specify a number 
// of hours by which the current time will be 
// offset.  The current time is used to highlight
// the present day on the month-view calendar, and 
// it is sometimes necessary to adjust the current 
// time, so that the present day does not roll-over 
// too early, or too late, for your intended 
// audience.  Both positive and negative integer 
// values are valid.


define("CURR_TIME_OFFSET", 0);
$dayname=array();
$dayname[0]="Sunday";
$dayname[1]="Monday";
$dayname[2]="Tuesday";
$dayname[3]="Wednesday";
$dayname[4]="Thursday";
$dayname[5]="Friday";
$dayname[6]="Saturday";
$lang['days'] 		= array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
$lang['months']		= array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
$lang['abrvmonth']=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
$lang['abrvdays'] 	= array("Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat");
$shortmonth=array();
$shortmonth[0]="Jan";
$shortmonth[1]="Feb";
$shortmonth[2]="Mar";
$shortmonth[3]="Apr";
$shortmonth[4]="May";
$shortmonth[5]="Jun";
$shortmonth[6]="Jul";
$shortmonth[7]="Aug";
$shortmonth[8]="Sep";
$shortmonth[9]="Oct";
$shortmonth[10]="Nov";
$shortmonth[11]="Dec";
?>
