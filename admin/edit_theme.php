<?php
session_start();
if (!isset($_SESSION["access"])) {
	header("Location: ../index.php");
	exit;
}

require_once "../lib/Database.php";
require_once "../lib/Dbobject.php";

Database::connect();
$themes = new Dbobject("forum_themes");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_SERVER["HTTP_HOST"] != parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST) || $_POST["token"] != $_SESSION["token"]) {
		header("Location: ../index.php");
		exit;
	}
	$id = (int)$_POST["id"];
	$cat_id  = (int)$_POST["cat_id"];
	$title = filter_var($_POST["title"], FILTER_SANITIZE_STRING);
	$content = filter_var($_POST["content"], FILTER_SANITIZE_STRING);
	$author = filter_var($_POST["author"], FILTER_SANITIZE_STRING);
	$themes->update($id, "cat_id", $cat_id);
	$themes->update($id, "title", $title);
	$themes->update($id, "content", $content);
	$themes->update($id, "author", $author);
	Database::disconnect();
	header("Location: themes.php");
	exit;
} else {
	$id = (int)$_GET["id"];
	$item = $themes->query_one($id);
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
		<label for="cat_id">
			Cat_id
		</label>
		<div>
			<input type="text" name="cat_id" id="cat_id" value="<?=$item["cat_id"]?>">
		</div>
		<label for="title">
			Title
		</label>
		<div>
			<input type="text" name="title" id="title" value="<?=$item["title"]?>">
		</div>
		<label for="content">
			Content
		</label>
		<div>
			<textarea id="content" name="content"><?=$item["content"]?></textarea>
		</div>
		<label for="author">
			Author
		</label>
		<div>
			<input type="text" name="author" id="author" value="<?=$item['author']?>">
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