<?php
require_once "../lib/Database.php";
require_once "../lib/Dbobject.php";

$id = (int)$_GET["id"];

Database::connect();
$cats = new Dbobject("forum_categories");
$cats->del_item($id);
Database::disconnect();

header("Location: categories.php");
exit;
?>