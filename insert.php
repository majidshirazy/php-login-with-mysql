<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Insert</title>
		<link rel="stylesheet" href="css/all.css">
		<link href="css/style.css" rel="stylesheet" type="text/css">
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
			<h2>Insert</h2>
            <div>
                <p>Please insert your product informations.</p>
                <form action="do.php" method="post">
                    <table>
                        <tr>
                            <td>Product Name</td>
                            <td><input type="text" name="product" /></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><input type="text" name="price" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2"><input style="text-align=center;" type="submit" value="Insert" name="insert"></td>
                        </tr>
                    </table>
                </form>
            </div>
		</div>
	</body>
</html>