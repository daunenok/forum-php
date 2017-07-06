<?php
class Dbobject {
	public $table;

	public function __construct($val) {
		$this->table = $val;
	}

	public function count_all() {
		$sql = "SELECT COUNT(*) AS qty FROM " . $this->table;
		$stmt = Database::$conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return (int)$result["qty"];
	}

	public function find_all() {
		$sql = "SELECT * FROM " . $this->table;
		$stmt = Database::$conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function del_item($id) {
		$sql = "DELETE FROM " . $this->table . " WHERE id=?";
		$stmt = Database::$conn->prepare($sql);
		$stmt->execute([$id]);
	}

	public function query_one($id) {
		$sql = "SELECT * FROM " . $this->table . " WHERE id=?";
		$stmt = Database::$conn->prepare($sql);
		$stmt->execute([$id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function query_many($field, $value) {
		$sql = "SELECT * FROM " . $this->table;
		$sql .= " WHERE " . $field  . "=?";
		$stmt = Database::$conn->prepare($sql);
		$stmt->execute([$value]);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function query_sql($arg) {
		$sql = "SELECT * FROM " . $this->table;
		$sql .= " "  . $arg;
		$stmt = Database::$conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function update($id, $field, $value) {
		$sql = "UPDATE " . $this->table;
		$sql .= " SET " . $field . "=? WHERE id=?";
		$stmt = Database::$conn->prepare($sql);
		$stmt->execute([$value, $id]);
	}

	public function insert($arr1, $arr2) {
		$count = count($arr2);
		$question = array_fill(0, $count, "?");
		$sql = "INSERT INTO " . $this->table;
		$sql .= "(" . join(", ", $arr1) . ")";
		$sql .= " VALUES(" . join(", ", $question) . ")";
		$stmt = Database::$conn->prepare($sql);
		$stmt->execute($arr2);
	}
}
?>