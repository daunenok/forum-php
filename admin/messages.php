<?php
session_start();
if (!isset($_SESSION["access"]) || $_SESSION["access"] != 2) {
	header("Location: ../index.php");
	exit;
}

require_once "../lib/Database.php";
require_once "../lib/Dbobject.php";
Database::connect();
$messages = new Dbobject("forum_messages");
$items = $messages->find_all();
$themes = new Dbobject("forum_themes");
foreach ($items as $item) {
	$th = $themes->query_one($item["theme_id"]);
	$theme[$item["id"]] = $th["title"];
}
Database::disconnect();

require_once "header.php"; 
?>

		<h2>Messages</h2>
	</div>

	<table class="u-full-width">
		<thead>
			<tr>
				<th>ID</th>
				<th>Theme</th>
				<th>Name</th>
				<th>Content</th>
				<th>Created</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($items as $item) { ?>
				<tr>
					<td><?=$item["id"]?></td>
					<td><?=$theme[$item["id"]]?></td>
					<td><?=$item["name"]?></td>
					<td>
					<?php
					echo substr($item["content"], 0, 50) . "...";
					?>
					</td>
					<td><?=$item["created"]?></td>
					<td>
						<a href="edit_message.php?id=<?=$item["id"]?>" class="button button-primary">
							edit
						</a>
						<a href="del_message.php?id=<?=$item["id"]?>" class="button button-primary">
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


