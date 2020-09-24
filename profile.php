<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
require_once "config.php";
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $db->prepare('SELECT `password`, `email` FROM `user` WHERE `id` = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="index.php"><i class="fas fa-user-circle"></i>Index</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="insert.php"><i style="color: white;" class="fas fa-pencil"></i>Insert</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<form action=do.php method="post">
					<input type="hidden" name="profile" value=""/>
					<table>
						<tr>
							<td>Username:</td>
							<td><label for="password"><?=$_SESSION['name']?></label></td>
						</tr>
						<tr>
							<td>Password:</td>
							<td><input type="text" name="password" value="<?=$password?>" /></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><input type="text" name="email" value="<?=$email?>" /></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align: center;"><input  type="submit" value="Update" /></td>
							<td></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>