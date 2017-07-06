<?php
session_start();
if (!isset($_SESSION["access"]) || $_SESSION["access"] != 2) {
	header("Location: ../index.php");
	exit;
}

require_once "../lib/Database.php";
require_once "../lib/Dbobject.php";
Database::connect();
$users = new Dbobject("forum_users");
$items = $users->find_all();
Database::disconnect();

require_once "header.php"; 
?>

		<h2>Users</h2>
	</div>
	<table class="u-full-width">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Password</th>
				<th>Access</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($items as $item) { ?>
				<tr>
					<td><?=$item["id"]?></td>
					<td><?=$item["name"]?></td>
					<td><?=$item["pass"]?></td>
					<td><?=$item["access"]?></td>
					<td>
						<a href="del_user.php?id=<?=$item["id"]?>" class="button button-primary">
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
