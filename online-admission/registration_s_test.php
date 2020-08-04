<?Php
error_reporting(0);
include '../classes/config.php';
include '../classes/conn.php';
include "../classes/admin_class.php";

$sql_chk="SELECT * FROM `application_table` order by id desc limit 1";
$s=mysql_query($sql_chk);
if(mysql_num_rows($s)>0){
echo date("Ymd")." hr ";
	$chk_table_dtls=mysql_fetch_array($s);
//	$chk_date=date("Ymd",strtotime($chk_table_dtls['submit_date']));
$chk_date=substr($chk_table_dtls['Application_No'], 0,8);
echo " s ". $chk_date;
//echo $chk_date." - ".date("Ymd");
	if(date("Ymd")<=$chk_date){
//echo "test3";
			$application_no=$chk_table_dtls['Application_No']+1;
echo " ".$application_no;
	}else{
			$application_no=date("Ymd")."0001";
echo " 1 ". $application_no;
		}
}else{
		 $application_no=date("Ymd")."0001";
echo " 2 ". $application_no;
	}
//---------
$sess_id_f=mysql_fetch_array(mysql_query("SELECT * FROM `session_table` WHERE `Admission_open`='1'"));
$sess_id=$sess_id_f['SessionId'];

?>
