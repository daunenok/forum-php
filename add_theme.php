<?php
session_start();
require_once "lib/Database.php";
require_once "lib/Dbobject.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_SERVER["HTTP_HOST"] != parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST) || $_POST["token"] != $_SESSION["token"]) {
		header("Location: index.php");
		exit;
	}
	Database::connect();
	$cat_id = (int)$_POST["id"];
	$title = filter_var($_POST["title"], FILTER_SANITIZE_STRING);
	$content = filter_var($_POST["content"], FILTER_SANITIZE_STRING);
	$name = $_SESSION["user_name"];
	$arr1 = ["cat_id", "title", "content", "author"];
	$arr2 = [$cat_id, $title, $content, $name];
	$themes = new Dbobject("forum_themes");
	$themes->insert($arr1, $arr2);
	Database::disconnect();
	header("Location: themes.php?id=$cat_id");
	exit;
} else {
	$id = (int)$_GET["id"];
	if (!isset($_SESSION["access"])) {
		$_SESSION["error"] = "You must be logged in to add theme.";
		header("Location: themes.php?id=$id");
		exit;
	}
	Database::connect();
	$cats = new Dbobject("forum_categories");
	$cat = $cats->query_one($id);
	Database::disconnect();	
} 

require_once "header.php"; 
?>
	<div class="login">
		<?php 
		if (!isset($_SESSION["access"])) {
		?>
			<a href="login.php">Login</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="register.php">Register</a>
		<?php } elseif ($_SESSION["access"] == 1) { ?>
			<a href="logout.php">Logout</a>
		<?php } elseif ($_SESSION["access"] == 2) { ?>
			<a href="admin/index.php">Admin Panel</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="logout.php">Logout</a>
		<?php }?>
	</div>
	<h1>Forum</h1>
	<h3>
		Category: <?=$cat["title"]?>
	</h3>
	<div class="bread">
			<a href="index.php">Home</a>&nbsp;&nbsp;&nbsp;>&nbsp;
			<a href="themes.php?id=<?=$cat['id']?>">
				<?=$cat["title"]?>
			</a>
	</div>
	<form class="edit" action="" method="post">
		<input type="hidden" name="id" value="<?=$id?>">
		<?php  
		$token = uniqid(); 
		$_SESSION["token"] = $token;
		?>
		<input type="hidden" name="token" value="<?=$token?>">
		<label for="title">
			Title
		</label>
		<div>
			<input type="text" name="title" id="title">
		</div>
		<label for="content">
			Content
		</label>
		<div>
			<textarea name="content" id="content"></textarea>
		</div>
		<div>
			<button type="submit" class="button-primary">
				Add theme
			</button>
		</div>
	</form>
</div>

</body>
</html>