<?php

session_start();
include_once 'isAuthenticated.php';
include_once 'autoload.php';

//echo "<pre>" . print_r($_POST, true) . "</pre>";
//echo "<pre>" . print_r($_FILES, true) . "</pre>";

$name = $_POST['name'];
$cin = $_POST['cin'];
$id=$_POST['id'] ;

if (empty($name) || empty($cin) || !isset($_FILES['photo']) || empty($id)) {
    $_SESSION['ErrorMessage'] = "Please fill in all required fields";
    header("location: editPerson.php?id=".$id);
    exit();
}

if (!ctype_digit($cin) || strlen($cin) != 8) {
    $_SESSION['ErrorMessage'] = "cin must be an 8 digit string";
    header("location: editPerson.php?id=".$id);
    exit();
}
$people = new People();
if ($people->findPeoplebyCin2($cin,$id)) {
    $_SESSION['ErrorMessage'] = "Cin is already in use!";
    header("location: editPerson.php?id=".$id);
    exit();
}

if ($_FILES['photo']['error'] != 0) {
    $_SESSION['ErrorMessage'] = "There is an error with the image";
    header("location: editPerson.php?id=".$id);
    exit();
}

$type = explode("/", getimagesize($_FILES['photo']['tmp_name'])['mime']);
$supportedType = array("png", "jpg", "jpeg", "gif");

if ($type[0] != "image" || !in_array($type[1], $supportedType)) {
    $_SESSION['ErrorMessage'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
    header("location: editPerson.php?id=".$id);
    exit();
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
    $_SESSION['ErrorMessage'] = "File is too big (>500KB)";
    header("location: editPerson.php?id=".$id);
    exit();
}

$target_dir = "uploads/";
$target_file = $target_dir . uniqid("user" . $_SESSION['userId'] . "_") . "." . $type[1];

if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
    $peopleTable = new People();
    //$peopleTable->insert(array("name" => $name, "photo" => $target_file, "cin" => $cin, "user_id" => $_SESSION['userId']);
    $peopleTable->update(array("name" => $name, "photo" => $target_file, "cin" => $cin, "id" =>$id));
    $_SESSION['message'] = "Successfully edited a person to your people list";
    header("location: index.php");
    exit();
} else {
    $_SESSION['ErrorMessage'] = "there was an error while uploading your file";
    header("location: editPerson.php?id=".$id);
    exit();
}

