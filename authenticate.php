<?php
session_start();
require_once "config.php";
if ( !isset($_POST['username'], $_POST['password']) ) {
	exit('Please fill both the username and password fields!');
}
if (isset($_POST['loginform'])){

    if ($stmt = $con->prepare('SELECT id, password FROM user WHERE username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        if ($_POST['password'] === $password) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: home.php');


        } else {
            echo 'Incorrect username and/or password!';

        }
    } else {
        echo 'Incorrect username and/or password! <br />';
        echo "For Register click link below<br />";
        echo "<a href='register.php'>register</a>";
    }
        $stmt->close();
    }
} elseif (isset($_POST['registerform'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql = "INSERT INTO user (username, password) VALUES ('$username','$password')";
    if ($con->query($sql) === TRUE) {
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $_POST['username'];
        $_SESSION['id'] = $id;
        header('Location: home.php');
      } else {
        echo "Error: " . $sql . "<br>" . $con->error;
      }
    
      $db->close();
    
}


?>