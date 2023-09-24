<?php
if ($_POST["password"] == $_POST["password2"]) {
	require_once '../server/config.php';
	$mysqli->query("INSERT INTO Users (username, password) VALUES (\"".$_POST["username"]."\",\"".password_hash($_POST["password"], PASSWORD_BCRYPT)."\");");
	session_start();
	$_SESSION["username"]=$_POST["username"];

	$result = $mysqli->query("SELECT user_id FROM Users WHERE username=\"".$_SESSION["username"]."\";");
	$row = $result->fetch_assoc();
	$user_id = $row["user_id"];

	$challenge_results = $mysqli->query("SELECT challenge_id FROM Challenges ORDER BY RAND() LIMIT 3");
	while ($challenge_id = $challenge_results->fetch_assoc()) {
		$challenge_id = $challenge_id["challenge_id"];
		$mysqli->query("INSERT INTO User_Challenges (user_id, challenge_id) VALUES ('$user_id', '$challenge_id');");
	}

	header("Location: /");
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
		<p class="text-center">Passwords don't match</p>
		<a class="text-center m-4 px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded" href="/register">Back to register page</a>
		</div>
	</body>
</html>
<?php } ?>
