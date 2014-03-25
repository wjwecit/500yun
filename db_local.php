<?php
class DB{

	public static $db_host='mysql.500yun.com';
	public static $db_username='u727712547_wei';
	public static $db_name='u727712547_wdb';
	public static $db_pwd='4040940';

	function __construct(){
		print "Constructed \n";
	}

	function __destruct() {
		print "Destroying \n";
	}

	private static function  init(){
		mysql_connect(self::$db_host, self::$db_username, self::$db_pwd)or die('Could not connect: ' . mysql_error());
		mysql_select_db(self::$db_name) or die('Could not select database');
	}

	public static function update($sql){
			
	}



	public static function query($sql){
		self::init();
		$result=mysql_query($sql);
		$arrayData=array();
		$row=0;
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$arrayData[$row++]=$line;
		}
		return $arrayData;
	}



}

function fun_test_reg(){
	$str="aaaaaaaaaaaaaa@{page}@{session}";
	preg_match_all("/@{(?:\w+)}/", $str,$match);
	//var_dump($match);
	$m2=preg_replace("/@{(\w+)}/", "<?php echo \\1 ?>",$str);
	var_dump($m2);
	echo $m2;
}

function fun_test_page(){
	$fcontent=implode('',file('http://www.baidu.com'));
	$content=file_get_contents('http://email.163.com');
	print $content;
}

function fun_test_user(){
	$user=new User();

	$user->to_string();

	$user->name="大良";
	$user_en=json_encode($user);
	echo $user_en;
	echo iconv("UCS-2", "UTF-8", pack("H4","\u5927"));
	echo iconv("UCS-2", "UTF-8", "王");
	$jsons = preg_replace("#\\\u([0-9a-f]{4}+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $user_en);
	echo $jsons;
}

function function_testdb() {
	// Connecting, selecting database
	$link = mysql_connect('localhost', 'root', '123')or die('Could not connect: ' . mysql_error());
	echo 'Connected successfully';
	mysql_select_db('dodonew') or die('Could not select database');

	// Performing SQL query
	$query = 'SELECT * FROM actionlog limit 19';
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

	// Printing results in HTML
	echo "<table>\n";
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo "\t<tr>\n";
		foreach ($line as $col_value) {
			echo "\t\t<td>$col_value</td>\n";
		}
		echo "\t</tr>\n";
	}

	echo "</table>\n";
	//phpinfo();
}

function test_local_db(){
	$conn=mysql_connect('127.0.0.1','root','123')or die('connect error');
	mysql_select_db('dodonew');

	$sql="select * from actionlog where limit 1";
	$result=mysql_query($sql);
	$data=array();
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$data[]=$line;
	}
	echo $data[0];
	
	// 释放资源
    mysql_free_result($result);
    
    // 关闭连接
    mysql_close($conn);  
	
}


?>