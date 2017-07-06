<?php
session_start();

if (isset($_SESSION["access"]))
	unset($_SESSION["access"]);
if (isset($_SESSION["user_name"]))
	unset($_SESSION["user_name"]);

header("Location: index.php");
exit;
?>