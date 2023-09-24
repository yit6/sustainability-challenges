<?php
session_start();
if (!isset($_SESSION["username"])) {
?>Not logged in.<br><a href="/login">Login Page</a><?php
} else {
?>
<?php
include "../server/config.php";
$ids = array();
$names = array();
$descs = array();
$progs = array();
$user_result = $mysqli->query("SELECT user_id FROM Users WHERE username=\"".$_SESSION["username"]."\";");
$user_id = $user_result->fetch_assoc()["user_id"];
$challenge_results = $mysqli->query("SELECT challenge_id FROM User_Challenges WHERE user_id='$user_id';");
while ($challenge_id = $challenge_results->fetch_assoc()) {
	$challenge_id = $challenge_id["challenge_id"];
	$challenge_name = $mysqli->query("SELECT (challenge_name) FROM Challenges WHERE challenge_id='$challenge_id';")->fetch_assoc()['challenge_name'];
	$challenge_desc = $mysqli->query("SELECT (description) FROM Challenges WHERE challenge_id='$challenge_id';")->fetch_assoc()['description'];
	$challenge_prog = $mysqli->query("SELECT (status) FROM User_Challenges WHERE challenge_id='$challenge_id' AND user_id='$user_id';")->fetch_assoc()['status'];
	array_push($ids, $challenge_id);
	array_push($names, $challenge_name);
	array_push($descs, $challenge_desc);
	array_push($progs, $challenge_prog);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1, width=device-width" />

		<link rel="stylesheet" href="./global.css" />
		<link rel="stylesheet" href="./index.css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Font Awesome 5 Brands:wght@400&display=swap" />
	</head>
	<body>
		<div class="challenges-page">
			<a href='complete.php?challenge_id=<?php echo $ids[0]; ?>'>
				<div style="border-radius: 15px;"class="challenge-3">
					<div style="border-radius: 15px;"class="rectangle-parent">
						<div class="group-child"></div>
							<div style="border-radius: 15px;"class="cut-six-pack-rings">
								<?php echo $names[0]; ?>
								<?php echo "<hr>";    ?>
								<?php echo $descs[0]; ?>
							</div>
						</div>
					<div style="width:<?php if ($progs[0]=="completed") { echo 100; } else { echo 20; } ?>%;" class="challenge-3-child"></div>
				</div>
			</a>
			<a href='complete.php?challenge_id=<?php echo $ids[1]; ?>'>
			<div style="border-radius: 15px;"class="challenge-2">
				<div style="border-radius: 15px;"class="rectangle-parent">
					<div style="border-radius: 15px;"class="group-child"></div>
						<div style="border-radius: 15px;"class="replace-any-old">
							<?php echo $names[1]; ?>
							<?php echo "<hr>";    ?>
							<?php echo $descs[1]; ?>
						</div>
					</div>
				<div style="width:<?php if ($progs[1]=="completed") { echo 100; } else { echo 20; } ?>%;"class="challenge-2-child"></div>
			</div>
			</a>
			<!-- <?php echo$progs[0] ?> --!>
			<a href='complete.php?challenge_id=<?php echo $ids[2]; ?>'>
			<div style="border-radius: 15px;"class="challenge-1">
				<div style="border-radius: 15px;"class="rectangle-parent">
					<div style="border-radius: 15px;"class="group-child"></div>
						<div style="border-radius: 15px;" class="set-up-a-container">
							<?php echo $names[2]; ?>
							<?php echo "<hr>";    ?>
							<?php echo $descs[2]; ?>
						</div>
					</div>
				<div style="width:<?php if ($progs[2]=="completed") { echo 100; } else { echo 20; } ?>%;"class="challenge-1-child"></div>
			</div>
			</a>
		<img id="aaaa" class="footer-icon" alt="" src="./public/footer.svg" />
		
		<div class="header" id="headerContainer">
        <div class="header1"></div>
        <img class="vector-icon" alt="" src="./public/vector.svg" />

        <img class="vector-icon1" alt="" src="./public/vector1.svg" id="vector1" />
	</div>
	<div class="challenges-for-this">Challenges for this week</div>
</div>

    <script>
      var vector1 = document.getElementById("vector1");
      if (vector1) {
        vector1.addEventListener("click", function (e) {
			window.location.href="/profile";
        });
      }
      
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
      var headerContainer = document.getElementById("headerContainer");
      if (headerContainer) {
        headerContainer.addEventListener("click", function (e) {

        });
      }
      </script>
  </body>
</html>
<?php
}
?>
