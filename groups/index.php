<?php
session_start();
if (!isset($_SESSION["username"])) {
?>Not logged in.<br><a href="/login">Login Page</a><?php
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<form action="create-group.php" method="post">
<label for="name">Name: </label>
<input type="text" name="name"></input>
<br>
<button type="submit">Join or Create Group</button>
</form>
</body>
</html>
<?php
}
?>
