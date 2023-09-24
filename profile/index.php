<?php
include "../server/config.php";
$user_id_result = $mysqli->query("SELECT user_id FROM Users WHERE username='".$_GET["name"]."';");
$user_id = $user_id_result->fetch_assoc()["user_id"];
echo "<h1>".$_GET["name"]."</h1>";

$group_result = $mysqli->query("SELECT group_id FROM Group_Members WHERE user_id='$user_id';");
$group_id = $group_result->fetch_assoc()['group_id'];

$group_name = $mysqli->query("SELECT group_name FROM Groups WHERE group_id='$group_id';")->fetch_assoc()["group_name"];
echo "Group: $group_name";
?>
