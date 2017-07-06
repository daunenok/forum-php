<?php
class Database {
	private static $server = "localhost";
	private static $dbname = "daunenok";
	private static $user = "root";
	private static $password = "";
	public static $conn;

	public static function connect() {
		$str = "mysql:host=" . self::$server;
		$str .= ";dbname=" . self::$dbname;
		self::$conn = new PDO($str, self::$user, self::$password);
	}

	public static function disconnect() {
		self::$conn = null;
	}
}
?>