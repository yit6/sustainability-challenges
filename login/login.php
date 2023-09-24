<?php
require_once "../server/config.php";
$result = $mysqli->query("SELECT username, password FROM Users WHERE username=\"".$_POST["username"]."\";");
if ($result->num_rows == 0) { ?>
No such username.<br>
<a href="/login">Retry login</a>
<?php
} else {
$result->data_seek(0);
$row = $result->fetch_row();
if (password_verify($_POST["password"], $row[1])) {
	session_start();
	$_SESSION["username"] = $_POST["username"];
header("Location: /");
?>
<?php
} else {
?>
<html>
	<head>
		<title>Create Konserva Account</title>
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
			<div class="text-center">
				<h1 class="text-white text-3xl font-bold mt-3">KONSERVA</h1>
			</div>
			<div class="flex items-center">
				<a href="/login">
					<img src="/assets/profile.svg" />
				</a>
			</div>
		</nav>
		<div class="flex flex-col items-center">
		<p class="text-center">Password Incorrect.</p>
		<a class="text-center m-4 px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded" href="/login">Retry login</a>
		</div>
	</body>
</html>
<?php }} ?>
