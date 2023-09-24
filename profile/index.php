<?php
include "../server/config.php";

if (!isset($_GET["name"])) {
	session_start();
	$_GET["name"] = $_SESSION["username"];
}
$user_id_result = $mysqli->query("SELECT user_id FROM Users WHERE username='".$_GET["name"]."';");
$user_id = $user_id_result->fetch_assoc()["user_id"];

$past_challenge_result = $mysqli->query("SELECT * FROM Past_Challenges WHERE user_id='$user_id';");
$num = $past_challenge_result->num_rows;

$group_result = $mysqli->query("SELECT group_id FROM Group_Members WHERE user_id='$user_id';");
$group_id = $group_result->fetch_assoc()['group_id'];

$group_name = $mysqli->query("SELECT group_name FROM Groups WHERE group_id='$group_id';")->fetch_assoc()["group_name"];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1, width=device-width" />
		<title><?php echo $_GET["name"]."'s profile"; ?></title>
		<script src="https://cdn.tailwindcss.com"></script>
	</head>
	<body>
		<nav class="flex item-center justify-between p-4" style="background: #3AC971;">
			<div class="flex items-center">
				<a href="/logout">
					<img src="/assets/leaf.svg" />
				</a>
			</div>
			<div class="text-center">
				<h1 class="text-white text-3xl font-bold mt-3">KONSERVA</h1>
			</div>
			<div class="flex items-center">
				<a href="/profile">
					<img src="/assets/profile.svg" />
				</a>
			</div>
		</nav>
		<main>
			<header class="p-6 flex item-center justify-center">
				<h1 class="text-3xl font-bold"><?php echo $_GET["name"]."'s profile"; ?></h1>
			</header>
			<p class="text-center"><?php echo $num; ?> past challenges completed.</p>
			<div class="flex item-center justify-center p-6">
				<a href="/challenges" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-4">Challenges</a>
				<a href="/group" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">My Group</a>
			<?php if ($_GET["name"] == $_SESSION["username"]) { ?>
				<a href="/logout" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Log Out</a>
			<?php } ?>
			</div>
		</main>
	</body>
</html>
