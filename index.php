<?php
session_start();
if (!isset($_SESSION["username"])) {
	?>
<!DOCTYPE html>
<html>
	<head>
		<title>Konserva</title>
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
				<a href="/profile">
					<img src="/assets/profile.svg" />
				</a>
			</div>
		</nav>
		<main>
			<section class="relative">
				<img class="w-full" src="/assets/runner.jpg" alt="Runner taking a step kicking up dirt"/>
				<div class="absolute inset-x-0 bottom-0 flex items-center justify-center h-20 bg-black bg-opacity-50">
					<p class="text-white text-center">Saving the planet one challenge at a time</p>
				</div>
			</section>

			<div class="flex justify-center m-4">
				<a href="/register" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Get Started!</a>
			</div>

			<section class="relative flex justify-center items-center">
				<img src="/assets/climber.jpg" alt="Image" class="max-full-w">
				<div class="absolute inset-y-0 left-0 text-white p-4 flex items-center w-1/3" style="background: #5CD48A;">
					<p class="m-auto">Complete Challenges</p>
				</div>
			</section>
			<section class="relative flex justify-center items-center">
				<img src="/assets/high-five.jpg" alt="Image" class="max-full-w">
				<div class="absolute inset-y-0 right-0 text-white p-4 flex items-center w-1/3" style="background: #58B79B;">
					<p class="m-auto">Compete against your friends</p>
				</div>
			</section>
			<section class="relative flex justify-center items-center">
				<img src="/assets/flower.jpg" alt="Image" class="max-full-w">
				<div class="absolute inset-y-0 left-0 text-white p-4 flex items-center w-1/3" style="background: #479797;">
					<p class="m-auto">Find exciting ways to save the environment</p>
				</div>
			</section>
		</main>
	</body>
</html>
<?php
} else {
header("Location: /profile");
?>
Logged in as 
<?php
	echo $_SESSION["username"];
?>
<br>
<a href="/challenges">Check Challenges</a>
<br>
<a href="/logout">Logout</a>
<br>
<?php
include "server/config.php";

$result = $mysqli->query("SELECT user_id FROM Users WHERE username=\"".$_SESSION["username"]."\";");
$row = $result->fetch_assoc();
$user_id = $row["user_id"];

$user_groups = $mysqli->query("SELECT * FROM Group_Members WHERE user_id='$user_id';");
if ($user_groups->num_rows == 0) {?>
	<a href="/groups">Create or Join group</a>
<?php
} else {
?>
	<a href="/group">Check on your group</a>
<?php
}}
?>
