<?php
session_start();
include "../server/config.php";

$result = $mysqli->query("SELECT user_id FROM Users WHERE username=\"".$_SESSION["username"]."\";");
$row = $result->fetch_assoc();
$user_id = $row["user_id"];

$mysqli->query("DELETE FROM Group_Members WHERE user_id='$user_id';");

header("Location: /profile");
?>
