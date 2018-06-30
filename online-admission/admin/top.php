<?php
ob_start();
require "../../classes/config.php";
require "../../classes/mysql.php";
require "../../classes/functions.php";
require "../../classes/conn.php";

$admin_pagelist=20;
$f_limit=f(q("select * from dt_charlimit"));
$for_msg=$f_limit['for_msg'];
$for_ad=$f_limit['for_ad'];
?>