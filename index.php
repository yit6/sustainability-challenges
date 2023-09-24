<?php
session_start();
if (!isset($_SESSION["username"])) {
	?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="global.css" />
    <link rel="stylesheet" href="landingPage1.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Font Awesome 5 Brands:wght@400&display=swap"
    />
  </head>
  <body>
    <div class="landing-page">
      <div class="back-green first-card">
        <img
          class="climber-extreme-silhouette-cli-icon"
          alt=""
          src="assets/climber-extreme-silhouette-climbing-wallpaper.jpg"
        />

        <div class="complete-challenges">
          <p class="complete">Complete</p>
          <p class="complete">challenges</p>
        </div>
      </div>
      <div class="back-lightblue second-card">
        <div class="compete-against-your">Compete against your friends</div>
        <img
          class="climber-extreme-silhouette-cli-icon"
          alt=""
          src="assets/pexels-yan-krukau-8199708.jpg"
        />
      </div>
      <div class="back-darkblue third-card">
        <img
          class="climber-extreme-silhouette-cli-icon"
          alt=""
          src="assets/89263.jpg"
        />

        <div class="find-exciting-ways">
          Find exciting ways to save the environment
        </div>
      </div>
      <div class="header">
        <div class="header1"></div>
        <img class="vector-icon" alt="" src="leaf-solid.svg" />

        <div class="sign-up-wrapper" id="groupContainer">
          <div class="sign-up" id="signUpText"><a href="/register">Sign up</a></div>
        </div>
      </div>
      <img
        class="running-person-icon"
        alt=""
        src="assets/Running%20black%20gradient.jpg"
      />

      <div class="landing-page-child"></div>
      <div class="homepage-text-1">
        <div class="saving-the-planet-container">
          <p class="complete">Saving the planet one</p>
          <p class="complete">challenge at a time</p>
        </div>
      </div>
      <div class="footer-parent">
        <div class="footer" id="footer"></div>
        <div class="join-now"><a href="/register">Join now!</a></div>
      </div>
      <div class="landing-page-item"></div>
      <div class="get-started-wrapper">
        <div id="start" class="get-started"><a href="/register">Get started!</a></div>
      </div>
    </div>

    <script>
      var signUpText = document.getElementById("signUpText");
      if (signUpText) {
        signUpText.addEventListener("click", function (e) {
          // Please sync "Sign In" to the project
        });
      }
      
      var groupContainer = document.getElementById("groupContainer");
      if (groupContainer) {
        groupContainer.addEventListener("click", function (e) {
          // Please sync "Sign In" to the project
        });
      }
      
      var start = document.getElementById("start");
      if (start) {
        start.addEventListener("click", function (e) {
          // Please sync "Sign In" to the project
        });
      }
        
      var footer = document.getElementById("footer");
      if (footer) {
        footer.addEventListener("click", function (e) {
          // Please sync "Sign In" to the project
        });
      }
      </script>
  </body>
</html>
<?php
} else {
header("Location: /profile");
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
