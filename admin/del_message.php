<?php
require_once "../lib/Database.php";
require_once "../lib/Dbobject.php";

$id = (int)$_GET["id"];

Database::connect();
$comments = new Dbobject("forum_messages");
$comments->del_item($id);
Database::disconnect();

header("Location: messages.php");
exit;
?>