<?php
session_start();
if (!isset($_SESSION["username"])) {
	?>Not logged in.<br><a href="/login">Login Page</a><?php
} else {
	include "../server/config.php";

	$names = array();
	$scores = array();

	$result = $mysqli->query("SELECT user_id FROM Users WHERE username=\"".$_SESSION["username"]."\";");
	$row = $result->fetch_assoc();
	$user_id = $row["user_id"];

	$group_results = $mysqli->query("SELECT group_id FROM Group_Members WHERE user_id='$user_id';");

	if ($group_results->num_rows == 0) {
		header("Location: /groups/");
	}
	$group_id = $group_results->fetch_assoc()["group_id"];

	$group_name = $mysqli->query("SELECT group_name FROM Groups where group_id='$group_id';")->fetch_assoc()["group_name"];

	$user_results = $mysqli->query(" SELECT Users.username,
		COUNT(CASE WHEN User_Challenges.status = 'completed' THEN 1 END) AS num 
		FROM Users 
		LEFT JOIN Group_Members ON Users.user_id = Group_Members.user_id
		LEFT JOIN User_Challenges ON Users.user_id = User_Challenges.user_id
		WHERE Group_Members.group_id = '$group_id'
		GROUP BY Users.username
		ORDER BY num;");
	while ($user_result = $user_results->fetch_assoc()) {
		array_push($names, $user_result["username"]);
		array_push($scores, $user_result["num"]);
	}

?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1, width=device-width" />
		<title><?php echo $group_name; ?></title>
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
			<header class="p-6 flex item-center justify-center">
				<h1 class="text-3xl font-bold"><?php echo $group_name; ?></h1>
			</header>
		<main class="flex flex-col items-center">
<?php
	while (count($names) != 0) {
		$name = array_pop($names);
		$score = array_pop($scores);
		echo "<a href='/profile?name=$name'>";
		echo "<div class='p-4 rounded-lg shadow-lg max-w-md'>";
		echo "<h3 class='text-lg font-bold'>$name</h3>";
		echo "<p>Challenges Completed: $score</p>";
		echo "</div></a>";
	}
?>
		</main>
	</body>
</html>
<?php
}
?>
