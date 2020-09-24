<?php
session_start();
if (isset($_SESSION['loggedin'])) {
	header('Location: home.php');
}
else 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="css/all.css">
		<link href="css/style.css" rel="stylesheet" type="text/css">

	</head>
	<body>
		<div class="login">
			<h1>Login</h1>
			<form action="do.php" method="post">
                <input type="hidden" name="loginform" value=""/>
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
				<a href="register.php">Register</a>
			</form>
		</div>
	</body>
</html>