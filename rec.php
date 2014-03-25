<?php
require_once 'db.php';
header("Content-Type: text/html;charset=utf-8");

$w_name=mysql_escape_string($_GET['w_name']);
$w_pwd=mysql_escape_string($_GET['w_pwd']);
$w_sex=mysql_escape_string($_GET['w_sex']);
$w_age=mysql_escape_string($_GET['w_age']);
$w_area=mysql_escape_string($_GET['w_area']);
$w_comany=mysql_escape_string($_GET['w_comany']);
$w_contact=mysql_escape_string($_GET['w_contact']);
$w_enable=mysql_escape_string($_GET['w_enable']);

$sql="insert into wei_db (w_name,w_pwd,w_sex,w_age,w_area,w_company,w_contact,w_enable,w_create_time,w_last_edit_time)";
$sql=$sql."values('".$w_name."','";
$sql=$sql.$w_pwd."','";
$sql=$sql.$w_sex."','";
$sql=$sql.$w_age."','";
$sql=$sql.$w_area."','";
$sql=$sql.$w_comany."','";
$sql=$sql.$w_contact."','";
$sql=$sql.$w_enable."',now(),now())";
DB::update($sql);
$resrow=mysql_affected_rows();
$res=json_encode(array("result"=>$resrow));
echo $res;

?>