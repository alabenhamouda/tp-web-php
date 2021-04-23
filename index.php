<?php
$title = "Login";
include_once('fragments/header.php');
include_once('isAuthenticated.php');
include_once('autoload.php');
$peopleTable = new People();
$people = $peopleTable->findByUserId($_SESSION['userId']);
//echo "<pre>" . var_dump($people) . "</pre>";
?>
<div class="container">
    <div class="row header-row">
        <h2>List of people you manage</h2>
        <form action="logout.php" method="POST">
            <button type="submit" name="submit" value="logout" class="btn btn-primary">Log Out</button>
        </form>
    </div>
    <div class="row">
        <?php
        foreach($people as $person){
        ?>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
                <div class="card">
                    <img src="<?= $person->photo ?>" alt="Person image" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= $person->name ?></h5>
                        <p class="card-text">
                            Person with the national identity card of number <?= $person->cin ?>
                        </p>
                        <div class="card-foot">
                            <a href="editPerson.php?id=<?= $person->id ?>" class="btn btn-primary">Edit</a>
                            <form action="deletePerson.php?id=<?= $person->id ?>" method="POST">
                                <button type="submit" class="btn btn-danger" name="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
                <a href="addPerson.php" class="add-person">
                    <img src="assets/images/add.png" alt="add Person">
                </a>
        </div>
    </div>
</div>
<?php
include_once("fragments/footer.php");
?>