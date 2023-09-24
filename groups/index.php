<?php
session_start();
if (!isset($_SESSION["username"])) {
	?>Not logged in.<br><a href="/login">Login Page</a><?php
} else {
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Konserva</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1, width=device-width" />
		<script src="https://cdn.tailwindcss.com"></script>
	</head>
	<body>
		<nav class="flex item-center justify-between p-4" style="background: #3AC971;">
			<div class="flex items-center">
				<a href="/">
					<img src="/assets/leaf.svg" />
				</a>
			</div>
			<div class="flex items-center">
				<a href="/login">
					<img src="/assets/profile.svg" />
				</a>
			</div>
		</nav>
		<main clsas="flex flex-col justify-center item-center">
			<form action="create-group.php" method="post">
				<div class="mb-4 max-w-md">
					<label class="block" for="name">Name: </label>
					<input class="w-full border rounded px-3 py-2" type="text" name="name"></input>
				</div>
				<div class="mb-4 max-w-md">
					<button class="py-2 px-4 bg-blue-500 hover:bg-blue-500 rounded" type="submit">Join or Create Group</button>
				</div>
			</form>
		</main>
	</body>
</html>
<?php } ?>
