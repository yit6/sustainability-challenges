<?php
include "config.php";

$group_ids = $mysqli->query("SELECT group_id FROM Groups;");
while ($group_row = $group_ids->fetch_assoc()) {
		$group_id = $group_row["group_id"];

		$challenge_results = $mysqli->query("SELECT challenge_id FROM Challenges ORDER BY RAND() LIMIT 3");
		$user_results = $mysqli->query("SELECT user_id FROM Group_Members WHERE group_id='$group_id'");
		while ($user_row = $user_results->fetch_assoc()) {
			$user_id = $user_row["user_id"];
			$mysqli->query("DELETE FROM User_Challenges WHERE user_id='$user_id';");
		}

		while ($challenge_row = $challenge_results->fetch_assoc()) {
			$challenge_id = $challenge_row["challenge_id"];
			echo $challenge_id;

			$user_results = $mysqli->query("SELECT user_id FROM Group_Members WHERE group_id='$group_id'");
			while ($user_row = $user_results->fetch_assoc()) {
				$user_id = $user_row["user_id"];
				$mysqli->query("INSERT INTO User_Challenges (user_id, challenge_id, status) VALUES ('$user_id', '$challenge_id', 'in-progress')");
			}
		}
		echo "\n";
}
?>
