<?php
    include("__/php/database.php");
    include("__/php/user.php");

    include("__/php/header.php");

    $database = new Database();

    $database->connectToDB();

    $database->selectUser($user->getUsername());

    include("__/php/footer.php");
?>