<?php
require_once "../lib/Database.php";
require_once "../lib/Dbobject.php";

$id = (int)$_GET["id"];

Database::connect();
$comments = new Dbobject("forum_themes");
$comments->del_item($id);
Database::disconnect();

header("Location: themes.php");
exit;
?>