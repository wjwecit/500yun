<?php
error_reporting(E_ALL);
require_once 'user.php';
require_once 'db.php';
header("Content-Type: text/html;charset=utf-8");

echo "Hello!";

$bean=array();
$bean['w_name']="wei";
$bean['w_age']=33;
$bean['w_pwd']=333;

//echo DB::insert('wei_db', $bean);

//echo json_encode($bean);

// $sql="select * from wei_db where w_name='wei'";
// $result=mysql_query($sql);
// $arrayData=array();
// while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
// 	foreach ($line as $c){
// 		echo $c.'  ';
// 	}
// 	echo "\n\r";
// }

$data=DB::query("select * from wei_db  limit 1");
//var_dump($data);
foreach ($data as $row){
	//var_dump($row);
	while($key=key($row)){
		if(strstr($key, "name")){
			echo $key."=>".$row[$key];
		}
		next($row);
	}
}

// $name=mysql_escape_string($_GET['w_name']);

// if($name){
// 	$data=DB::query("select * from wei_db where w_name='wei' limit 1");

// 	foreach ($data as $row){
// 		echo $row;
// 	}
// 	if(count($data)>0){
// 		echo $data[0]['w_name'];
// 	}
// }




?>