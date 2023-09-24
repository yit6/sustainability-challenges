<?php
session_start();
if (!isset($_SESSION["username"])) {
?>Not logged in.<br><a href="/login">Login Page</a><?php
} else {
?>
Logged in as 
<?php
	echo $_SESSION["username"];
?>
<br>
<a href="/challenges">Check Challenges</a>
<br>
<a href="/logout">Logout</a>
<br>
<?php
include "server/config.php";

$result = $mysqli->query("SELECT user_id FROM Users WHERE username=\"".$_SESSION["username"]."\";");
$row = $result->fetch_assoc();
$user_id = $row["user_id"];

$user_groups = $mysqli->query("SELECT * FROM Group_Members WHERE user_id='$user_id';");
if ($user_groups->num_rows == 0) {?>
	<a href="/groups">Create or Join group</a>
<?php
} else {
?>
	<a href="/group">Check on your group</a>
<?php
}}
?>
