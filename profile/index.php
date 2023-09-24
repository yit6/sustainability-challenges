<?php
include "../server/config.php";

if (!isset($_GET["name"])) {
	session_start();
	$_GET["name"] = $_SESSION["username"];
}
$user_id_result = $mysqli->query("SELECT user_id FROM Users WHERE username='".$_GET["name"]."';");
$user_id = $user_id_result->fetch_assoc()["user_id"];

$group_result = $mysqli->query("SELECT group_id FROM Group_Members WHERE user_id='$user_id';");
$group_id = $group_result->fetch_assoc()['group_id'];

$group_name = $mysqli->query("SELECT group_name FROM Groups WHERE group_id='$group_id';")->fetch_assoc()["group_name"];
?>
<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8" />
	<meta name="viewport" content="initial-scale=1, width=device-width" />

	<link rel="stylesheet" href="/global.css" />
	<link rel="stylesheet" href="./index.css" />
	<link
	  rel="stylesheet"
	  href="https://fonts.googleapis.com/css2?family=Font Awesome 5 Brands:wght@400&display=swap"
	/>
	<link
	  rel="stylesheet"
	  href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap"
	/>
  </head>
  <body>
	<div class="profile">
	  <img id="aaaa" class="footer-icon" alt="" src="./public/footer.svg" />

	  <div class="profile-photo"></div>
	  <div class="header" id="headerContainer">
		<div class="header1"></div>
		<img class="vector-icon" alt="" src="./public/vector.svg" />

		<img
		  class="vector-icon1"
		  alt=""
		  src="./public/vector1.svg"
		  id="vector1"
		/>
	  </div>
	  <div class="username"><?php echo $_GET["name"]; ?></div>
	  <div class="settings-background"></div>
	  <div class="profile-child"></div>
	  <div class="profile-item"></div>
	  <div class="profile-inner"></div>
	  <div class="line-div"></div>
	  <div class="profile-child1"></div>
	  <div class="change-profile-photo">Change profile photo</div>
	  <div class="change-password">Change password</div>
	  <div class="logout" id="logoutText">Logout</div>
	  <div class="all-time-records">All time records</div>
	  <div class="submit-a-challenge">Submit a challenge</div>
	  <div class="report-a-bug">Report a bug</div>
	</div>

<script>
document.getElementById("aaaa").addEventListener("click", (e) => {
	let x = e.layerX/ document.getElementById("aaaa").width;
	console.log(x);
	if (x > 0.666) {
		window.location.href="/group";
	} else if (x > 0.333) {
		window.location.href="/group";
	} else {
		window.location.href="/challenges";
	}
});
var vector1 = document.getElementById("vector1");
if (vector1) {
	vector1.addEventListener("click", function (e) {
		window.location.href = "/profile";
	});
}

var logoutText = document.getElementById("logoutText");
if (logoutText) {
	logoutText.addEventListener("click", function (e) {
		window.location.href = "/logout";
	});
}
</script>
  </body>
</html>
