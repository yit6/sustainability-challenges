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

$mysqli->query("INSERT INTO Group_Members (user_id, group_id) VALUES ('$user_id', '$group_id');"); header("Location: /");
?>
