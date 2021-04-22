<?php
$title = "Login";
include_once('fragments/header.php');
?>
<div class="content">
    <div class="login">
        <div class="head">
            <span>
                Log In To Your Account
            </span>
            <a href="signup.php">Sing Up?</a>
        </div>
        <form action="processLogin.php" method="POST">
            <div class="form-group">
                <label for="email">Email address:</label>
                <input required name="email" type="email" class="form-control" placeholder="Enter email" id="email">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input required name="password" type="password" class="form-control" placeholder="Enter password" id="pwd">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<?php
include_once("fragments/footer.php");
?>