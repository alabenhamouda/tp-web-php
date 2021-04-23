<?php
include_once('autoload.php');
session_start();
$people = new People();
$people->deleteById($_GET['id']);
$_SESSION['message'] = "Person deleted successefully";
header("location:index.php");
