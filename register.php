<?php 
session_start();
require_once "lib/Database.php";
require_once "lib/Dbobject.php";
require_once "lib/User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_SERVER["HTTP_HOST"] != parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST) || $_POST["token"] != $_SESSION["token"]) {
		header("Location: index.php");
		exit;
	}
	$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	$pass = filter_var($_POST["pass"], FILTER_SANITIZE_STRING);
	$user = new User($name, $pass);
	$user->register();
	header("Location: login.php");
	exit;
}

require_once "header.php" 
?>

	<h1>Registration</h1>

	<form class="register" action="" method="post">
		<?php  
			$token = uniqid(); 
			$_SESSION["token"] = $token;
		?>
		<input type="hidden" name="token" value="<?=$token?>">
		<label for="name">
			Name
		</label>
		<div>
			<input type="text" id="name" name="name">
		</div>
		<label for="pass">
			Password
		</label>
		<div>
			<input type="password" id="pass" name="pass">
		</div>
		<div>
			<button type="submit" class="button-primary">
				Register
			</button>
		</div>
	</form>	
</div>

</body>
</html>