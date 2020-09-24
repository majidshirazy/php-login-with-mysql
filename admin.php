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
			<h2>Users List</h2>
			<div>				
					<table>
<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
} else {
	$id = $_SESSION['id'];
	$usernmae = $_SESSION['name'];
}
require_once "config.php";

$sql = 'SELECT `username`,`password`,`email` FROM `user` WHERE `role`="user"';
$result = $db->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
?>
						<tr>
							<td>Username:</td>
							<td><?php echo $row["username"]?></td>
						</tr>
						<tr>
							<td>Password:</td>
							<td><?php echo $row["password"]?></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><?php echo $row["email"]?></td>
						</tr>
					<?php
						}
					}
					$db->close();
					?>
					</table>
			</div>
		</div>
	</body>
</html> 