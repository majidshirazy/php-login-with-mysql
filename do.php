<?php
session_start();
require_once "config.php";

if ($_SESSION['name']){
    $posteduser = $_SESSION['name'];
} else {
    $posteduser = $_POST['username'];
}
$postedpass = $_POST['password'];
$postedemail = $_POST['email'];
if ($_SESSION['id']) {
    $id = $_SESSION['id'];
}
$product = $_POST['product'];
$price = $_POST['price'];

if (isset($_POST['loginform'])){
    login($posteduser);  
} elseif (isset($_POST['registerform'])) {
    register($posteduser,$postedpass,$postedemail);
} elseif (isset($_POST['profile'])){
    profile($posteduser,$postedpass,$postedemail);
} elseif (isset($_POST['insert'])){
    insert($product,$price);
}

function userexist($posteduser){
    $sql="SELECT id,username FROM user WHERE username = '$posteduser'";
    $results = mysqli_query($db, $sql);
    if (mysqli_num_rows($results) > 0) {
      echo "User is taken";	
    }else{
      echo 'user is not taken';
    }
    exit();
    }

function register($posteduser,$postedpass,$postedemail){
    global $db;
    $sql = "INSERT INTO user (`username`, `password`,`email`) VALUES ('$posteduser','$postedpass','$postedemail')";
    if ($db->query($sql) === TRUE) {
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $_POST['username'];
        $_SESSION['id'] = $id;
        header('Location: home.php');
      } else {
        echo "Error: " . $sql . "<br>" . $db->error;
      }
      $db->close();
 }

function login($posteduser) {
    global $db;
    if ($query = $db->prepare('SELECT `id`,`password`,`role` FROM `user` WHERE `username` = ?')) {
        $query->bind_param('s', $posteduser);
        $query->execute();
        $query->store_result();

    if ($query->num_rows > 0) {
        $query->bind_result($id, $password,$role);
        $query->fetch();
        echo "id is: ".$id." And the password is: ".$password;
        if ($_POST['password'] === $password) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $_SESSION["ses_time"] = time();
            if ($role === "admin"){
                header('Location: admin.php');
            } else {
                header('Location: home.php');
            }
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
}

function profile($posteduser,$postedpass,$postedemail){
    global $db,$id;
    $sql = "UPDATE `user` SET `username`='$posteduser',`password`='$postedpass',`email`='$postedemail' WHERE id='$id'";
    if ($db->query($sql)) {
        header('Location: index.php');
    } else {
        echo "Error updating record: " . $db->error;
    }
    $db->close();
}

function insert($product,$price){
    global $db;
    $author = $_SESSION['name'];
    $sql = "INSERT INTO products (`name`, `price`,`author`) VALUES ('$product','$price','$author')";
    if ($db->query($sql) === TRUE) {
        sleep(5);
        echo "product is insert by $author";
        header ('location: home.php');
        echo "OK";
      } else {
        echo "Error: " . $sql . "<br>" . $db->error;
      }
      $db->close();
 }