<?php
require_once 'dbconfig.php';
	class DB{
		function __construct(){
			print "Constructed \n";
		}
		
		function __destruct() {
	       print "Destroying \n";
	    }
		
		private static function  init(){
			mysql_connect(Dbconfig::$db_host, Dbconfig::$db_username, Dbconfig::$db_pwd)or die('Could not connect: ' . mysql_error());
			mysql_select_db(Dbconfig::$db_name) or die('Could not select database');
		}
		
		public static function update($sql){
			self::init();
			return mysql_query($sql);
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
?>