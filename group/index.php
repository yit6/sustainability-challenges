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

if ($group_results->num_rows == 0) {
	header("Location: /groups/");
}
$group_id = $group_results->fetch_assoc()["group_id"];

$group_name = $mysqli->query("SELECT group_name FROM Groups where group_id='$group_id';")->fetch_assoc()["group_name"];
echo "<h1>".$group_name."</h1><br>";

$user_results = $mysqli->query(" SELECT Users.username,
COUNT(CASE WHEN User_Challenges.status = 'completed' THEN 1 END) AS num 
FROM Users 
LEFT JOIN Group_Members ON Users.user_id = Group_Members.user_id
LEFT JOIN User_Challenges ON Users.user_id = User_Challenges.user_id
WHERE Group_Members.group_id = '$group_id'
GROUP BY Users.username
ORDER BY num DESC;");
while ($user_result = $user_results->fetch_assoc()) {
	echo $user_result["username"]." has completed ".$user_result["num"]."<br>";
}
?>
<a href="/">Back to main page</a>
<?php
}
?>
