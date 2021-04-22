<?php
session_start();
include_once('autoload.php');
if (isset($_SESSION['userId'])) {
    header("location: /");
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email) || empty($password)) {
    $_SESSION['ErrorMessage'] = "Please fill in the credentials";
    header("location: login.php");
    exit();
}

$userTable = new User();
$user = $userTable->findByEmail($email);

// echo "<pre>" . print_r($user, true) . "</pre><br>";
// echo "<pre>" . print_r($user->password, true) . "</pre>";
// echo "<pre>" . print_r($password, true) . "</pre>";

function reject()
{
    $_SESSION['ErrorMessage'] = 'inavlid email or password';
    header("location: login.php");
}

if ($user) {
    if (password_verify($password, $user->password)) {
        $_SESSION['message'] = 'Successfully logged in!';
        $_SESSION['userId'] = $user->id;
        header("location: /");
    } else {
        reject();
    }
} else {
    reject();
}
