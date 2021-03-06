<?php
require_once 'dbconfig.php';

mysql_connect ( Dbconfig::$db_host, Dbconfig::$db_username, Dbconfig::$db_pwd ) or die ( 'Could not connect: ' . mysql_error () );
mysql_select_db ( Dbconfig::$db_name ) or die ( 'Could not select database' );
mysql_query ( "SET NAMES 'UTF8'" );
mysql_query ( "SET CHARACTER SET UTF8" );
mysql_query ( "SET CHARACTER_SET_RESULTS=UTF8'" );
class DB {
	function __construct() {
		print "Constructed \n";
	}
	function __destruct() {
		print "Destroying \n";
	}
	public static function update($sql) {
		return mysql_query ( $sql ) or die ( self::mysql_msg ( mysql_errno () ) ); // 不能连接数据库，用户名或密码错;
	}
	
	/**
	 * 将一条map化的数组插入记录到表中.
	 * 
	 * @param string $tablename
	 *        	数据表名
	 * @param array $bean
	 *        	map化的数组
	 * @return 操作成功返回true,否则返回false.
	 */
	public static function insert($tablename, $bean) {
		if (! $bean)
			return false;
		$sql_k = "insert into " . $tablename . "(";
		$sql_v = "values(";
		while ( $key = key ( $bean ) ) {
			if ($key) {
				$sql_k = $sql_k . $key . ",";
				if (is_string ( mysql_escape_string ( $bean [$key] ) )) {
					$sql_v = $sql_v . "'" . mysql_escape_string ( $bean [$key] ) . "',";
				} else {
					$sql_v = $sql_v . mysql_escape_string ( $bean [$key] ) . ",";
				}
				next ( $bean );
			}
		}
		$sql_k = substr_replace ( $sql_k, ")", strlen ( $sql_k ) - 1 );
		$sql_v = substr_replace ( $sql_v, ")", strlen ( $sql_v ) - 1 );
		return @mysql_query ( $sql_k . $sql_v );
	}
	
	/**
	 * 使用伪Map更新指定表名,指定主键的记录.
	 *
	 * @param string $tablename
	 *        	数据表名
	 * @param unknown_type $bean
	 *        	伪Map
	 * @param unknown_type $key
	 *        	主键名
	 * @return 更新成功返回true,否则false.
	 */
	public static function update_bean($tablename, $bean, $key) {
		if (! $bean)
			return false;
		if (! $bean [$key])
			return false;
		$sql = "update " . $tablename . " set ";
		while ( $key = key ( $bean ) ) {
			if ($key) {
				$sql = $sql . $key . "=";
				if (is_string ( mysql_escape_string ( $bean [$key] ) )) {
					$sql = $sql . "'" . mysql_escape_string ( $bean [$key] ) . "',";
				} else {
					$sql = $sql . mysql_escape_string ( $bean [$key] ) . ",";
				}
				next ( $bean );
			}
		}
		$sql = substr_replace ( $sql, "", strlen ( $sql ) - 1 );
		$sql = $sql . " where " . $key . "=" . mysql_escape_string ( $bean [$key] );
		return mysql_query ( $sql ) > 0;
	}
	
	/**
	 * 依据sql查询,并将结果放入数组返回.
	 * 
	 * @param string $sql
	 *        	执行的查询sql.
	 */
	public static function query($sql) {
		$result = @mysql_query ( $sql );
		$arrayData = array ();
		while ( $line = mysql_fetch_array ( $result, MYSQL_ASSOC ) ) {
			$arrayData [] = $line;
		}
		return $arrayData;
	}
	public static function mysql_msg($errno = 0) {
		$msg = array (
				"1005" => "创建表失败",
				"1006" => "创建数据库失败",
				"1007" => "数据库已存在，创建数据库失败",
				"1008" => "数据库不存在，删除数据库失败",
				"1009" => "不能删除数据库文件导致删除数据库失败",
				"1010" => "不能删除数据目录导致删除数据库失败",
				"1011" => "删除数据库文件失败",
				"1012" => "不能读取系统表中的记录",
				"1020" => "记录已被其他用户修改",
				"1021" => "硬盘剩余空间不足，请加大硬盘可用空间",
				"1022" => "关键字重复，更改记录失败",
				"1023" => "关闭时发生错误",
				"1024" => "读文件错误",
				"1025" => "更改名字时发生错误",
				"1026" => "写文件错误",
				"1032" => "记录不存在",
				"1036" => "数据表是只读的，不能对它进行修改",
				"1037" => "系统内存不足，请重启数据库或重启服务器",
				"1038" => "用于排序的内存不足，请增大排序缓冲区",
				"1040" => "已到达数据库的最大连接数，请加大数据库可用连接数",
				"1041" => "系统内存不足",
				"1042" => "无效的主机名",
				"1043" => "无效连接",
				"1044" => "当前用户没有访问数据库的权限",
				"1045" => "不能连接数据库，用户名或密码错误",
				"1048" => "字段不能为空",
				"1049" => "数据库不存在",
				"1050" => "数据表已存在",
				"1051" => "数据表不存在",
				"1054" => "字段不存在",
				"1065" => "无效的SQL语句，SQL语句为空",
				"1081" => "不能建立Socket连接",
				"1114" => "数据表已满，不能容纳任何记录",
				"1116" => "打开的数据表太多",
				"1129" => "数据库出现异常，请重启数据库",
				"1130" => "连接数据库失败，没有连接数据库的权限",
				"1133" => "数据库用户不存在",
				"1141" => "当前用户无权访问数据库",
				"1142" => "当前用户无权访问数据表",
				"1143" => "当前用户无权访问数据表中的字段",
				"1146" => "数据表不存在",
				"1147" => "未定义用户对数据表的访问权限",
				"1149" => "SQL语句语法错误",
				"1158" => "网络错误，出现读错误，请检查网络连接状况",
				"1159" => "网络错误，读超时，请检查网络连接状况",
				"1160" => "网络错误，出现写错误，请检查网络连接状况",
				"1161" => "网络错误，写超时，请检查网络连接状况",
				"1062" => "字段值重复，入库失败",
				"1169" => "字段值重复，更新记录失败",
				"1177" => "打开数据表失败",
				"1180" => "提交事务失败",
				"1181" => "回滚事务失败",
				"1203" => "当前用户和数据库建立的连接已到达数据库的最大连接数，请增大可用的数据库连接数或重启数据库",
				"1205" => "加锁超时",
				"1211" => "当前用户没有创建用户的权限",
				"1216" => "外键约束检查失败，更新子表记录失败",
				"1217" => "外键约束检查失败，删除或修改主表记录失败",
				"1226" => "当前用户使用的资源已超过所允许的资源，请重启数据库或重启服务器",
				"1227" => "权限不足，您无权进行此操作",
				"1235" => "MySQL版本过低，不具有本功能" 
		);
		$errno = ! empty ( $errno ) ? intval ( $errno ) : 0;
		if (array_key_exists ( intval ( $errno ), $msg )) {
			return $msg [$errno];
		} else {
			return;
		}
	}
}
?>