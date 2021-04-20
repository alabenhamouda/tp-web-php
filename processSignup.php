<?php
include_once 'autoload.php';
session_start();
if (isset($_SESSION['userId'])) {
    header("location: /");
}

$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

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
            $_SESSION['message'] = "Successfully registred!";
            header("location: /");
        }
    }
}
