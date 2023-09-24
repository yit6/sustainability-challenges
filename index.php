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
<a href="/logout">Logout</a>
<?php
}
?>
