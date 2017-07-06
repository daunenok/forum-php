<?php
session_start();
if (!isset($_SESSION["access"])) {
	header("Location: ../index.php");
	exit;
}

require_once "../lib/Database.php";
require_once "../lib/Dbobject.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_SERVER["HTTP_HOST"] != parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST) || $_POST["token"] != $_SESSION["token"]) {
		header("Location: ../index.php");
		exit;
	}
	Database::connect();
	$cats = new Dbobject("forum_categories");
	$title = filter_var($_POST["title"], FILTER_SANITIZE_STRING);
	$arr1 = ["title"];
	$arr2 = [$title];
	$cats->insert($arr1, $arr2);
	Database::disconnect();
	header("Location: categories.php");
	exit;
} 

require_once "header.php"; 
?>

		<h2>Categories</h2>
	</div>
	<form class="edit" action="" method="post">
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
		<div>
			<button type="submit" class="button-primary">
				Add
			</button>
		</div>
	</form>
</div>

</body>
</html>