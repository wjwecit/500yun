<?php
require_once 'db.php';
header ( "Content-Type: text/html;charset=utf-8" );

$w_name = mysql_escape_string ( $_GET ['w_name'] );
$w_pwd = mysql_escape_string ( $_GET ['w_pwd'] );
$w_sex = mysql_escape_string ( $_GET ['w_sex'] );
$w_age = mysql_escape_string ( $_GET ['w_age'] );
$w_area = mysql_escape_string ( $_GET ['w_area'] );
$w_comany = mysql_escape_string ( $_GET ['w_comany'] );
$w_contact = mysql_escape_string ( $_GET ['w_contact'] );
$w_enable = mysql_escape_string ( $_GET ['w_enable'] );

$usr = array (
		"w_name" => w_name,
		"w_pwd" => $w_pwd,
		"w_sex" => $w_sex,
		"w_age" => $w_age,
		"w_area" => $w_area,
		"w_comany" => $w_comany,
		"w_contact" => $w_contact,
		"w_enable" => $w_enable 
);

DB::insert ( "wei_db", $usr );
$resrow = mysql_affected_rows ();
$res = json_encode ( array (
		"result" => $resrow 
) );
echo $res;

?>