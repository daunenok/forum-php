<?php
session_start();
if (!isset($_SESSION["access"]) || $_SESSION["access"] != 2) {
	header("Location: ../index.php");
	exit;
}

require_once "../lib/Database.php";
require_once "../lib/Dbobject.php";
Database::connect();
$users = new Dbobject("forum_categories");
$items = $users->find_all();
Database::disconnect();

require_once "header.php"; 
?>

		<h2>Categories</h2>
	</div>

	<a href="add_cat.php" class="button button-primary">add category</a>

	<table class="u-full-width">
		<thead>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($items as $item) { ?>
				<tr>
					<td><?=$item["id"]?></td>
					<td><?=$item["title"]?></td>
					<td>
						<a href="del_cat.php?id=<?=$item["id"]?>" class="button button-primary">
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
