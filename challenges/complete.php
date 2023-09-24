<?php
include "../server/config.php";
session_start();

$result = $mysqli->query("SELECT user_id FROM Users WHERE username=\"".$_SESSION["username"]."\";");
$row = $result->fetch_assoc();
$user_id = $row["user_id"];

$challenge_id = $_GET["challenge_id"];
$mysqli->query("UPDATE User_Challenges SET status = 'completed' WHERE user_id='$user_id' AND challenge_id='$challenge_id'");
header("Location: /challenges");
?>
