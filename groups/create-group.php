<?php
include "../server/config.php";
session_start();

$result = $mysqli->query("SELECT user_id FROM Users WHERE username=\"".$_SESSION["username"]."\";");
$row = $result->fetch_assoc();
$user_id = $row["user_id"];

$new_group = false;

$check_if_group_exists = $mysqli->query("SELECT * FROM Groups WHERE group_name=\"".$_POST["name"]."\";");
if ($check_if_group_exists->num_rows == 0) {
	$mysqli->query("INSERT INTO Groups (group_name, created_by_user_id) VALUES ('".$_POST["name"]."', '$user_id')");
	$new_group = true;
}

$result = $mysqli->query("SELECT group_id FROM Groups WHERE group_name=\"".$_POST["name"]."\";");
$row = $result->fetch_assoc();
$group_id = $row["group_id"];

if ($new_group) {
	$challenge_results = $mysqli->query("SELECT challenge_id FROM Challenges ORDER BY RAND() LIMIT 3");
	while ($challenge_row = $challenge_results->fetch_assoc()) {
		$challenge_id = $challenge_id["challenge_id"];
		$mysqli->query("INSERT INTO User_Challenges (user_id, challenge_id, status) VALUES ('$user_id', '$challenge_id', 'in-progress')");
	}
} else {
	$group_members = $mysqli->query("SELECT user_id FROM Group_Members WHERE group_id='$group_id';");
	$group_member_id = $group_members->fetch_assoc()["user_id"];

	$challenge_results = $mysqli->query("SELECT challenge_id FROM User_Challenges WHERE user_id='$group_member_id';");
	while ($challenge_id = $challenge_results->fetch_assoc()) {
		$challenge_id = $challenge_id["challenge_id"];
		$mysqli->query("INSERT INTO User_Challenges (user_id, challenge_id, status) VALUES ('$user_id', '$challenge_id', 'in-progress');");
	}
}

$mysqli->query("INSERT INTO Group_Members (user_id, group_id) VALUES ('$user_id', '$group_id');");
header("Location: /");
?>
