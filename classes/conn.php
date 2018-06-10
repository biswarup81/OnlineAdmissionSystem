<?php

define("DB_NAME", $db_name);				// db name
define("DB_USER", $db_login);				// db username
define("DB_PASS", $db_pswd);				// db password
define("DB_HOST", $db_host);

mysql_connect(DB_HOST, DB_USER, DB_PASS) or die(mysql_error());
//echo 'asasasas';
// Prefix added to table names.  Do not change after
// initial installation.
//define("DB_TABLE_PREFIX", "calendar_");

mysql_select_db(DB_NAME) or die(mysql_error('could not select the database'));
?>