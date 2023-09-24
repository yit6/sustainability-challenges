<?php
session_start();
if (!isset($_SESSION["username"])) {
	?>Not logged in.<br><a href="/login">Login Page</a><?php
} else {
?>
<?php
	include "../server/config.php";
	$ids = array();
	$names = array();
	$descs = array();
	$progs = array();
	$user_result = $mysqli->query("SELECT user_id FROM Users WHERE username=\"".$_SESSION["username"]."\";");
	$user_id = $user_result->fetch_assoc()["user_id"];
	$challenge_results = $mysqli->query("SELECT challenge_id FROM User_Challenges WHERE user_id='$user_id';");
	while ($challenge_id = $challenge_results->fetch_assoc()) {
		$challenge_id = $challenge_id["challenge_id"];
		$challenge_name = $mysqli->query("SELECT (challenge_name) FROM Challenges WHERE challenge_id='$challenge_id';")->fetch_assoc()['challenge_name'];
		$challenge_desc = $mysqli->query("SELECT (description) FROM Challenges WHERE challenge_id='$challenge_id';")->fetch_assoc()['description'];
		$challenge_prog = $mysqli->query("SELECT (status) FROM User_Challenges WHERE challenge_id='$challenge_id' AND user_id='$user_id';")->fetch_assoc()['status'];
		array_push($ids, $challenge_id);
		array_push($names, $challenge_name);
		array_push($descs, $challenge_desc);
		array_push($progs, $challenge_prog);
	}
?>
<html>
	<head>
		<title><?php $_SESSION["usernames"]."'s challenges" ?></title>
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
				<a href="/profile">
					<img src="/assets/profile.svg" />
				</a>
			</div>
		</nav>
<?php
	while (count($ids) != 0) {
		$id = array_pop($ids);
		$name = array_pop($names);
		$desc = array_pop($descs);
		$prog = array_pop($progs);
?>
		<a href='/challenges/complete.php?challenge_id=<?php echo $id; ?>'>
		<div class="p-4 mb-4 rounded-lg shadow-lg">
			<div class="flex justify-between items-center mb-2">
			<h3 class="text-lg font-bold"><?php echo $name; ?></h3>
				<?php if ($prog == "completed") { ?>
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13l4 4L19 7"></path>
                </svg>
				<?php } else { ?>
				<svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
				<?php } ?>
            </div>
			<p class="text-gray-700"><?php echo $desc; ?></p>
        </div></a>
<?php
	}
?>
	</body>
</html>
<?php } ?>
