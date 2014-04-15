<?php
include_once "../ezsql/ez_sql_core.php";
include_once "../ezsql/ez_sql_mysql.php";

$db = new ezSQL_mysql('root','','socialdb','localhost');
global $db;
?>
