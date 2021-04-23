<?php
session_start();
include_once 'isAuthenticated.php';

//echo "<pre>" . print_r($_POST, true) . "</pre>";
//echo "<pre>" . var_dump($_POST['submit']) . "</pre>";

if(isset($_POST['submit']) && strcmp($_POST['submit'], "logout") == 0) {
    unset($_SESSION['userId']);
    $_SESSION['message'] = "Successfully logged out";
    header("location: login.php");
} else {
    $_SESSION['ErrorMessage'] = "There was an error";
    header("location: index.php");
}
