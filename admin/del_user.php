<?php
require_once "../lib/Database.php";
require_once "../lib/Dbobject.php";

$id = (int)$_GET["id"];

Database::connect();
$users = new Dbobject("forum_users");
$users->del_item($id);
Database::disconnect();

header("Location: users.php");
exit;
?>