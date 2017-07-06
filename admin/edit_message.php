<?php
session_start();
if (!isset($_SESSION["access"])) {
	header("Location: ../index.php");
	exit;
}

require_once "../lib/Database.php";
require_once "../lib/Dbobject.php";

Database::connect();
$messages = new Dbobject("forum_messages");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_SERVER["HTTP_HOST"] != parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST) || $_POST["token"] != $_SESSION["token"]) {
		header("Location: ../index.php");
		exit;
	}
	$id = (int)$_POST["id"];
	$theme_id  = (int)$_POST["theme_id"];
	$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	$content = filter_var($_POST["content"], FILTER_SANITIZE_STRING);
	$messages->update($id, "theme_id", $theme_id);
	$messages->update($id, "name", $name);
	$messages->update($id, "content", $content);
	Database::disconnect();
	header("Location: messages.php");
	exit;
} else {
	$id = (int)$_GET["id"];
	$item = $messages->query_one($id);
	Database::disconnect();
}

require_once "header.php"; 
?>

		<h2>Themes</h2>
	</div>
	<form class="edit" action="" method="post">
		<input type="hidden" name="id" value="<?=$id?>">
		<?php  
		$token = uniqid(); 
		$_SESSION["token"] = $token;
		?>
		<input type="hidden" name="token" value="<?=$token?>">
		<label for="theme_id">
			Theme_id
		</label>
		<div>
			<input type="text" name="theme_id" id="theme_id" value="<?=$item["theme_id"]?>">
		</div>
		<label for="name">
			Name
		</label>
		<div>
			<input type="text" name="name" id="name" value="<?=$item["name"]?>">
		</div>
		<label for="content">
			Content
		</label>
		<div>
			<textarea id="content" name="content"><?=$item["content"]?></textarea>
		</div>
		<div>
			<button type="submit" class="button-primary">
				Save
			</button>
		</div>
	</form>
</div>

</body>
</html>