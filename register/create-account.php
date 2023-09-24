<?php
if ($_POST["password"] == $_POST["password2"]) {
	require_once '../server/config.php';
	$mysqli->query("INSERT INTO Users (username, password) VALUES (\"".$_POST["username"]."\",\"".password_hash($_POST["password"], PASSWORD_BCRYPT)."\");");
	session_start();
	$_SESSION["username"]=$_POST["username"];
?>
Registered as <?php echo $_POST["username"]?>
<a href="/">Back to main page</a>
<?php
} else {
?>
Passwords don't match
<a href="register">Back to register page</a>
<?php } ?>
