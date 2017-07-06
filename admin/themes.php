<?php
session_start();
if (!isset($_SESSION["access"]) || $_SESSION["access"] != 2) {
	header("Location: ../index.php");
	exit;
}

require_once "../lib/Database.php";
require_once "../lib/Dbobject.php";
Database::connect();
$themes = new Dbobject("forum_themes");
$items = $themes->find_all();
$cats = new Dbobject("forum_categories");
foreach ($items as $item) {
	$cat = $cats->query_one($item["cat_id"]);
	$categ[$item["id"]] = $cat["title"];
}
Database::disconnect();

require_once "header.php"; 
?>

		<h2>Themes</h2>
	</div>

	<table class="u-full-width">
		<thead>
			<tr>
				<th>ID</th>
				<th>Category</th>
				<th>Title</th>
				<th>Content</th>
				<th>Created</th>
				<th>Author</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($items as $item) { ?>
				<tr>
					<td><?=$item["id"]?></td>
					<td><?=$categ[$item["id"]]?></td>
					<td><?=$item["title"]?></td>
					<td>
					<?php
					echo substr($item["content"], 0, 50) . "...";
					?>
					</td>
					<td><?=$item["created"]?></td>
					<td><?=$item["author"]?></td>
					<td>
						<a href="edit_theme.php?id=<?=$item["id"]?>" class="button button-primary">
							edit
						</a>
						<a href="del_theme.php?id=<?=$item["id"]?>" class="button button-primary">
							delete
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

</body>
</html>