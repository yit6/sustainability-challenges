<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Log in</title>
	</head>
	<body>
		<main>
			<form action="login.php" method="POST">
				<label for="username">Username: </label>
				<input type="text" name="username"></input>
				<br>
				<label for="password">Password: </label>
				<input type="text" name="password"></input>
				<br>
				<button type="submit">Log In</button>
			</form>
			<a href="/register">Register for an account</a>
		</main>
	</body>
</html>
