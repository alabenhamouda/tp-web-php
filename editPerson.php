<?php
include_once('autoload.php');
$title = "Edit Person";
include_once('fragments/header.php');
$id=$_GET['id'];
if(!isset($id))
{
    $_SESSION['ErrorMessage'] = "id is not set";
    header("location: editPerson.php?id=".$id);
    exit();
}

    $people =new People();
    $moudir=$people->findById($id);
    
    $name=$moudir->name;
    $cin=$moudir->cin;
    $photo=$moudir->photo;
    
    


?>
<div class="content">
    <div class="login">
        <div class="head">
            <span>
               edit a person
            </span>
            <a href="index.php">Home</a>
        </div>
        <form action="/processEditPerson.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="form-group">
                <label for="name">Person name:</label>
                <input required type="text" class="form-control" placeholder="Enter name" id="name" name="name" value="<?=$name?>">
            </div>
            <div class="form-group">
                <label for="cin">National Identity Card:</label>
                <input required type="text" class="form-control" placeholder="Enter cin" id="cin" name="cin"  value="<?=$cin?>"  pattern="\d{8}">
            </div>
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input required type="file" class="form-control"  id="photo" name="photo">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?php
include_once("fragments/footer.php");
?>
