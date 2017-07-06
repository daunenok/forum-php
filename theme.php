<?php
session_start();
require_once "lib/Database.php";
require_once "lib/Dbobject.php";

Database::connect();
$messages = new Dbobject("forum_messages");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_SERVER["HTTP_HOST"] != parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST) || $_POST["token"] != $_SESSION["token"]) {
		header("Location: index.php");
		exit;
	}
	$id = (int)$_POST["id"];
	if (!isset($_SESSION["access"])) {
		$_SESSION["error"] = "You must be logged in to send messsage.";
	} else {
		$message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
		$name = $_SESSION["user_name"];
		$arr1 = ["theme_id", "name", "content"];
		$arr2 = [$id, $name, $message];
		$messages->insert($arr1, $arr2);
	}
} else {
	$id = (int)$_GET["id"];	
}

$themes = new Dbobject("forum_themes");
$theme = $themes->query_one($id);
$cats = new Dbobject("forum_categories");
$cat = $cats->query_one($theme["cat_id"]);
$items = $messages->query_many("theme_id", $id);
Database::disconnect();

require_once "header.php";
if (isset($_SESSION["error"])) {
	echo "<div class='error'>" . $_SESSION["error"] . "</div>";
	unset($_SESSION["error"]);
} 
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
		Theme: <?=$theme["title"]?>
	</h3>
	<div class="bread">
			<a href="index.php">Home</a>&nbsp;&nbsp;&nbsp;>&nbsp;
			<a href="themes.php?id=<?=$cat['id']?>">
				<?=$cat["title"]?>
			</a>
	</div>

	<div class="theme">
		<div><?=$theme['author']?></div>
		<div><?=$theme['created']?></div>
		<div><?=$theme['content']?></div>
	</div>

	<?php
	foreach ($items as $item) { ?>
		<div class="message">
			<div>
				<?=$item['name']?>, 
				<?=$item['created']?>
			</div>
			<div><?=$item['content']?></div>
		</div>
	<?php } ?>
	

	<form class="answer" action="" method="post">
		<input type="hidden" name="id" value="<?=$id?>">
		<?php  
		$token = uniqid(); 
		$_SESSION["token"] = $token;
		?>
		<input type="hidden" name="token" value="<?=$token?>">
		<label for="message">
			Your answer:
		</label>
		<div>
			<textarea rows="10" id="message" name="message"></textarea>
		</div>
		<div>
			<button type="submit" class="button-primary">
				Send answer
			</button>
		</div>
	</form>	
</div>

</body>
</html>