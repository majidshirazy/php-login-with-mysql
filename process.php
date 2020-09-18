<?php
session_start();

include 'config.php';
$username=$_POST["username"];
$password=$_POST["password"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) and isset($_POST['password'])) {
        if (!empty($_POST['username']) and !empty($_POST['password'])) {
            if (isset($_POST['register'])) {
                # Register User
            } elseif (isset($_POST['login'])) {
                # Login User
            }
        }
    }
}

function isUserExists($username)
{
    $sql = "SELECT * FROM users WHERE username = '$username'";
    if ($db->query($sql) === TRUE) {
        echo "user exist";
    }else{
        echo "error";
    }
}


if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
$sql = "INSERT INTO user (username, password) VALUES ('$username','$password')";
if ($db->query($sql) === TRUE) {
    echo "Sabtenam Anjam shod";
  } else {
    echo "Error: " . $sql . "<br>" . $db->error;
  }
  
  $db->close();
