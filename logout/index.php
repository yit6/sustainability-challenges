<?php
session_start();
unset($_SESSION["username"]);
session_destroy();
?>
Logged Out.
<a href="/">Back to main page</a>
