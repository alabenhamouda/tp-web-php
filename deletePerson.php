<?php
include_once('autoload.php');
session_start();
if (!isset($_GET['id'])) {
    $_SESSION['ErrorMessage'] = "id is not set";
    header("location: index.php");
    exit();
}
$people = new People();
$person = $people->findById($_GET['id']);
unlink($person->photo);
$people->deleteById($_GET['id']);
$_SESSION['message'] = "Person deleted successefully";
header("location:index.php");
