<?php
require_once "../server/config.php";
$result = $mysqli->query("SELECT username, password FROM users WHERE username=\"".$_POST["username"]."\";");
if ($result->num_rows == 0) { ?>
No such username.<br>
<a href="/login">Retry login</a>
<?php
} else {
$result->data_seek(0);
$row = $result->fetch_row();
if (password_verify($_POST["password"], $row[1])) {
	session_start();
	$_SESSION["username"] = $_POST["username"];
?>
Successfully Logged in!
<a href="/">Go to main page</a>
<?php
} else {
?>
Password Incorrect.
<a href="/login">Retry login</a>
<?php }} ?>
