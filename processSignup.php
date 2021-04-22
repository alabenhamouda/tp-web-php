<?php
include_once 'autoload.php';
session_start();
if (isset($_SESSION['userId'])) {
    header("location: /");
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

if (empty($email) || empty($password) || empty($confirmPassword)) {
    $_SESSION['ErrorMessage'] = "Please fill in the credentials";
    header("location: signup.php");
    exit();
}

if (strcmp($password, $confirmPassword) != 0) {
    $_SESSION['ErrorMessage'] = "Passwords don't match!";
    header("location: signup.php");
} else {
    $password = password_hash($password, PASSWORD_DEFAULT);

    if (!$password) {
        $_SESSION['ErrorMessage'] = "There was an error";
        header("location: signup.php");
    } else {
        $user = new User();
        if ($user->findByEmail($email)) {
            $_SESSION['ErrorMessage'] = "Email is already registred!";
            header("location: signup.php");
        } else {
            $user->insert(array("email" => $email, "password" => $password));
            $lastId = db::lastInsertId();
            $attr = 'LAST_INSERT_ID()';
            $_SESSION['userId'] = $lastId->$attr;
            $_SESSION['message'] = "Successfully registred!";
            header("location: /");
        }
    }
}
