<?php
if ($_POST["password"] == $_POST["password2"]) {
	require_once '../server/config.php';
	$mysqli->query("INSERT INTO users VALUES (\"".$_POST["username"]."\",\"".password_hash($_POST["password"], PASSWORD_BCRYPT)."\");");
?>
Registered as <?php echo $_POST["username"]?>
<?php
} else {
?>
Passwords don't match
<a href="register">Back to register page</a>
<?php } ?>
