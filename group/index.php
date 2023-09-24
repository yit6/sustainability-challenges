<?php
session_start();
if (!isset($_SESSION["username"])) {
?>Not logged in.<br><a href="/login">Login Page</a><?php
} else {
include "../server/config.php";

$result = $mysqli->query("SELECT user_id FROM Users WHERE username=\"".$_SESSION["username"]."\";");
$row = $result->fetch_assoc();
$user_id = $row["user_id"];

$group_results = $mysqli->query("SELECT group_id FROM Group_Members WHERE user_id='$user_id';");
$group_id = $group_results->fetch_assoc()["group_id"];

$group_name = $mysqli->query("SELECT group_name FROM Groups where group_id='$group_id';")->fetch_assoc()["group_name"];
echo "<h1>".$group_name."</h1><br>";

$user_results = $mysqli->query("SELECT user_id FROM Group_Members WHERE group_id='$group_id';");
while ($user_id = $user_results->fetch_assoc()) {
	$user_id = $user_id["user_id"];
	$groupmate_result = $mysqli->query("SELECT * FROM Users WHERE user_id='$user_id';");
	$groupmate = $groupmate_result->fetch_assoc();
	echo $groupmate["username"]."<br>";
}
?>
<a href="/">Back to main page</a>
<?php
}
?>
