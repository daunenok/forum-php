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
	$access = $user->login();
	if ($access[1]) {
		$_SESSION["access"] = $access[1];
		$_SESSION["user_name"] = $access[0];
		header("Location: index.php");
		exit;
	} else {
		$_SESSION["message"] = "Wrong name/password";
	}
}

require_once "header.php"; 
?>

	
	<?php if (isset($_SESSION["message"])) { ?>
	<div class="error">
		<?php 
		echo $_SESSION["message"];
		unset($_SESSION["message"]);
		?>
	</div>
	<?php } ?>
	<h1>Log In</h1>
	
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
				Login
			</button>
		</div>
	</form>	
</div>

</body>
</html>