<?php
error_reporting(E_ALL);
require_once 'user.php';
require_once 'db.php';
header("Content-Type: text/html;charset=utf-8");

echo "Hello!";


$data=DB::query("select * from wei_db where w_name='wei' limit 1");
//mysql_connect('localhost','root','123')or die('connect error');
//mysql_select_db('test');
//
//$sql="select * from wei_db where w_name='wei' limit 1";
//$result=mysql_query($sql);
//$arrayData=array();
//while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
//	$arrayData[]=$line;
//}
//
if(count($data)>0){
	echo $data[0]['w_name'];
}

?>