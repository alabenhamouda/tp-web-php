<?php
session_start();
include_once 'isAuthenticated.php';
include_once 'autoload.php';

//echo "<pre>" . print_r($_POST, true) . "</pre>";
//echo "<pre>" . print_r($_FILES, true) . "</pre>";

$name = $_POST['name'];
$cin = $_POST['cin'];

if(empty($name) || empty($cin) || !isset($_FILES['photo'])){
    $_SESSION['ErrorMessage'] = "Please fill in all required fields";
    header("location: addPerson.php");
    exit();
}

if(!ctype_digit($cin) || strlen($cin) != 8) {
    $_SESSION['ErrorMessage'] = "cin must be an 8 digit string";
    header("location: addPerson.php");
    exit();
}

if($_FILES['photo']['error'] != 0){
    $_SESSION['ErrorMessage'] = "There is an error with the image";
    header("location: addPerson.php");
    exit();
}

$type = explode("/", getimagesize($_FILES['photo']['tmp_name'])['mime']);
$supportedType = array("png", "jpg", "jpeg", "gif");

if($type[0] != "image" || !in_array($type[1], $supportedType)){
    $_SESSION['ErrorMessage'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
    header("location: addPerson.php");
    exit();
}

if($_FILES["fileToUpload"]["size"] > 500000){
    $_SESSION['ErrorMessage'] = "File is too big (>500KB)";
    header("location: addPerson.php");
    exit();
}

$target_dir = "uploads/";
$target_file = $target_dir . uniqid("user" . $_SESSION['userId'] . "_") . "." . $type[1];

if(move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)){
    $peopleTable = new People();
    $peopleTable->insert(array("name" => $name, "photo" => $target_file, "cin" => $cin, "user_id" => $_SESSION['userId']));
    $_SESSION['message'] = "Successfully added a new person to your people list";
    header("location: index.php");
    exit();
} else {
    $_SESSION['ErrorMessage'] = "there was an error while uploading your file";
    header("location: addPerson.php");
    exit();
}

