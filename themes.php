<?php 
session_start();
require_once "lib/Database.php";
require_once "lib/Dbobject.php";

$id = (int)$_GET["id"]; 
Database::connect();
$cats = new Dbobject("forum_categories");
$cat = $cats->query_one($id);
$themes = new Dbobject("forum_themes");
$items = $themes->query_many("cat_id", $id);
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
	<div class="themes">
		<h3>
			Category: <?=$cat["title"]?>
		</h3>
		<div class="bread">
			<a href="index.php">Home</a>
		</div>

		<a href="add_theme.php?id=<?=$id?>" class="button button-primary">add theme</a>

		<table class="u-full-width">
		<thead>
			<tr>
				<th>Theme</th>
				<th>Author</th>
				<th>Created</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($items as $item) { ?>
				<tr>
					<td>
						<a href="theme.php?id=<?=$item['id']?>">
							<?=$item["title"]?>
						</a>	
					</td>
					<td><?=$item["author"]?></td>
					<td><?=$item["created"]?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	</div>
</div>

</body>
</html>