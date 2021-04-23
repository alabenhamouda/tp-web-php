<?php
$title = "Add Person";
include_once('fragments/header.php');
?>
<div class="content">
    <div class="login">
        <div class="head">
            <span>
               Add new person
            </span>
            <a href="index.php">Home</a>
        </div>
        <form action="/processAddPerson.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Person name:</label>
                <input required type="text" class="form-control" placeholder="Enter name" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="pwd">National Identity Card:</label>
                <input required type="text" class="form-control" placeholder="Enter cin" id="cin" name="cin"
                        pattern="\d{8}">
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