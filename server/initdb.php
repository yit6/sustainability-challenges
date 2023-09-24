<?php
include "config.php";
$mysqli->query("CREATE TABLE IF NOT EXISTS Users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255),
    password VARCHAR(255)
);");

$mysqli->query("CREATE TABLE IF NOT EXISTS Groups (
    group_id INT PRIMARY KEY AUTO_INCREMENT,
    group_name VARCHAR(255),
    created_by_user_id INT,
    FOREIGN KEY (created_by_user_id) REFERENCES Users(user_id) ON DELETE CASCADE
);");

$mysqli->query("CREATE TABLE IF NOT EXISTS Group_Members (
    group_member_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    group_id INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (group_id) REFERENCES Groups(group_id) ON DELETE CASCADE
);");

$mysqli->query("CREATE TABLE IF NOT EXISTS Challenges (
    challenge_id INT PRIMARY KEY AUTO_INCREMENT,
    challenge_name VARCHAR(255),
    description TEXT
);");

$mysqli->query("CREATE TABLE IF NOT EXISTS User_Challenges (
    user_challenge_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    challenge_id INT,
    status VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (challenge_id) REFERENCES Challenges(challenge_id) ON DELETE CASCADE
);");

$mysqli->query("CREATE TABLE IF NOT EXISTS Past_Challenges (
	past_challenge_id INT PRIMARY KEY AUTO_INCREMENT,
	user_id INT,
	challenge_id INT,
	FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
	FOREIGN KEY (challenge_id) REFERENCES Challenges(challenge_id) ON DELETE CASCADE
);");
