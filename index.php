<?php
error_reporting(E_ALL);
require_once 'user.php';
require_once 'db.php';
header("Content-Type: text/html;charset=utf-8");

echo "Hello!";

$bean=array();
$bean['w_name']="Jerry 王俊威";
$bean['w_age']=33;
$bean['w_pwd']=333;

echo DB::insert('wei_db', $bean);

//echo json_encode($bean);

$name=mysql_escape_string($_GET['w_name']);

if($name){
	echo ','.$name;
	$data=DB::query("select * from wei_db where w_name='wei' limit 1");

	if(count($data)>0){
		echo $data[0]['w_name'];
	}
}




?>