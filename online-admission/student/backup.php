<?php
/**Developer: Anish Karim C*[thecoderin@gmail.com]*****			      *     *     *
***ClassFor: MySQL Database BackUP[backup.php]***********                       *   *   *
***CreatedOn: 19th November 2009**U:3,Dec09******************                     * * *
***Details: Configuration data will set to class variables******             * * *  C  * * *
************** Create an object call**************************			  * * *
**************Assign Variables and call Function BackUp******			*   *   *
***Suggestions and Comments are welcome******************		      *     *     *
*/

include_once("mysql.class.inc");
include_once("config.php");

$backup	= new MyBackUp(); //creating an object of MyBackUp

//SERVER CONFIG
if(!empty($server['host']))
	$backup->server	= $server['host']; //Joining the configuration Server data to class Server variables.
if(!empty($server['port']))
	$backup->port	= $server['port'];
if(!empty($server['user']))
	$backup->usern	= $server['user'];

$backup->userp	= $server['pass'];
$backup->dbase	= $server['database'];

//Mail Config
if(!empty($mailer["FromMail"]))
	$backup->mailFrom = $mailer["FromMail"];
if(!empty($mailer["ToMail"]))
	$backup->mailTo = $mailer["ToMail"];

	$backup->body = $mailer["MailBody"];
	$backup->isDel= $mailer["DAS"];

//FILENAME GENERATION
//UNIQUE FILE NAME GENERATION TO SET ONE BACKUP A DAY. Change the date function to time if you need more than on file per day. 
	$backup->filename = $backUpFolder."/".$server['database']."_".date("Y_M_d H_i_s").".sql";

//Calling generator Function
if(!$backup->BackUp())
{
	echo $backup->error; //On error this function returns back. Error details will be in this variable.
}
else
{
	echo "Back Up made";
}	

//For more details Please visit: http://is.gd/5b3Xk

?>
