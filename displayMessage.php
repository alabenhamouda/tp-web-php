<?php
session_start();

if (isset($_SESSION['ErrorMessage'])) {
?>
    <div class="alert alert-danger">
        <?= $_SESSION['ErrorMessage'] ?>
    </div>
<?php
    unset($_SESSION['ErrorMessage']);
} else if (isset($_SESSION['message'])) {
?>
    <div class="alert alert-success">
        <?= $_SESSION['message'] ?>
    </div>
<?php
    unset($_SESSION['message']);
}
?>