<?php
$title = "Signup";
include_once('fragments/header.php');
if(isset($_SESSION['userId'])){
    header("location: index.php");
}
?>
<div class="content">
    <div class="login">
        <div class="head">
            <span>
                create a new account
            </span>
            <a href="/">log in</a>
        </div>
        <form action="/processSignup.php" method="POST">
            <div class="form-group">
                <label for="email">Email address:</label>
                <input required type="email" class="form-control" placeholder="Enter email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input required type="password" class="form-control" placeholder="Enter password" id="pwd" name="password">
            </div>
            <div class="form-group">
                <label for="Confirmpwd">Confirm password:</label>
                <input required type="password" class="form-control" placeholder="Enter password" id="Confirmpwd" name="confirmPassword">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?php
include_once("fragments/footer.php");
?>