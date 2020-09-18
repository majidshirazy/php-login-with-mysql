<?php
 session_start();

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) and isset($_POST['password'])) {
        if (!empty($_POST['username']) and !empty($_POST['password'])) {
            if (isset($_POST['register'])) {
                if (register($_POST['username'], $_POST['password'])) {
                    header("location: register.php?s=1");
                    exit;
                } else {
                    header("location: register.php?s=0");
                    exit;
                }
            } elseif (isset($_POST['login'])) {
                if (login($_POST['username'], $_POST['password'])) {
                    header("location: login.php?s=1");
                    exit;
                } else {
                    header("location: register.php");
                    exit;
                }
            }
        }
    }
}

/////////////////////////////////////////////////////////////////////////register
//aval barresi mikonim ke in username sabt sode dar database ya ne

//age bood bayad bere be safheye login
//age nabood bayad registar kone


function isUserExists($username) {
    global $pdo;
    $sql="SELECT * FROM user WHERE username = :username";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([':username'=> $username]);
    return $stmt->rowCount();
}

function register($username, $password)
{
    global $pdo;
    if (isUserExists($username)) {
        return false;
    }
    $sql = "INSERT INTO user (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ ':username' => $username, ':password' => $password]);
    return $stmt->rowCount();
}

///////////////////////////////////////////////////////////////////////////login
// baraye login aval barresi mikonim ke karbar sabte nam karde ya na 
//age karde bood bayad chek konim bebinim user pass ba chizi ke sabt shode yekei?
//age yeki bood etelaate on karbar beriz tooye result va id ro beriz tooye session
// age vojood nadash false bargardoon

function login($username, $password) {
    global $pdo;

    if (!isUserExists($username)) {
        return false;
    }

    $sql="SELECT * FROM user WHERE username = :username AND password = :password";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([':username'=> $username, ':password'=> $password]);
    $result=$stmt->fetch(PDO::FETCH_OBJ);
    $_SESSION['login']=$result->id;
    return true;
}