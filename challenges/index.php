<?php
session_start();
if (!isset($_SESSION["username"])) {
?>Not logged in.<br><a href="/login">Login Page</a><?php
} else {
?>
<html>
<head>
</head>
<body>
<?php
include "../server/config.php";
$user_result = $mysqli->query("SELECT user_id FROM Users WHERE username=\"".$_SESSION["username"]."\";");
$user_id = $user_result->fetch_assoc()["user_id"];
$challenge_results = $mysqli->query("SELECT challenge_id FROM User_Challenges WHERE user_id='$user_id';");
while ($challenge_id = $challenge_results->fetch_assoc()) {
	$challenge_id = $challenge_id["challenge_id"];
	$challenge_name = $mysqli->query("SELECT (challenge_name) FROM Challenges WHERE challenge_id='$challenge_id';")->fetch_assoc()['challenge_name'];
	$challenge_desc = $mysqli->query("SELECT (description) FROM Challenges WHERE challenge_id='$challenge_id';")->fetch_assoc()['description'];
	$challenge_prog = $mysqli->query("SELECT (status) FROM User_Challenges WHERE challenge_id='$challenge_id' AND user_id='$user_id';")->fetch_assoc()['status'];
	echo "<div style='border: solid black'>".$challenge_name."<br>".$challenge_desc."<br>".$challenge_prog."<br>";
	echo "<a href='complete.php?challenge_id=".$challenge_id."'>Mark Complete</a>";
	echo "</div>";
}
?>
<a href="/">Back to main page</a>
</body>
</html>
<?php
}
?>
