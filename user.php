<?php
class User {
	public $id = 10000;
	public $name = "Jerry 王俊威";
	function User() {
	}
	function to_string() {
		echo "id:" . $this->id . ";name:" . $this->name;
	}
}
?>