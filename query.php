<?php
require_once 'db.php';
header ( "Content-Type: text/html;charset=utf-8" );

$w_name = mysql_escape_string ( $_GET ['w_name'] );

?>