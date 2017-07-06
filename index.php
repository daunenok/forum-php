<?php 
session_start();
require_once "lib/Database.php";
require_once "lib/Dbobject.php";
Database::connect();

$cats = new Dbobject("forum_categories");
$items = $cats->find_all();

Database::disconnect();
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
	<div class="cats">
		<h3>Categories</h3>
		<?php
			foreach ($items as $item) { ?>
				<div class="cat">
					<a href="themes.php?id=<?=$item['id']?>">
						<?=$item["title"]?>
					</a>
				</div>
			<?php } ?>
	</div>
</div>

</body>
</html>