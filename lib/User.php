<?php
class User {
	private $name;
	private $pass;

	public function __construct($name, $pass) {
		$this->name = $name;
		$this->pass = $pass;
	}

	public function login() {
		Database::connect();
		$users = new Dbobject("forum_users");
		$items = $users->query_many("name", $this->name);
		Database::disconnect();
		if (empty($items) || $items[0]["pass"] != $this->pass) {
			return false;
		} else {
			$user_name = $this->name;
			$access = (int)$items[0]["access"];
			return [$user_name, $access];
		}
	}

	public function register() {
		Database::connect();
		$users = new Dbobject("forum_users");
		$arr1 = ["name", "pass", "access"];
		$arr2 = [$this->name, $this->pass, 1];
		$users->insert($arr1, $arr2);
		Database::disconnect();
	}
}
?>