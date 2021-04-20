<?php
    session_start();

    include("__/php/functions.php");
    include("__/php/config.php");

    if(isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
        $id = validateINT($_SESSION["id"]);
    }

    // echo "You're about to remove user with the id of " . $id . ".";

    // checkIfUserWithAnIDExists($dbh, $id);

    removeUser($dbh, $id);

?>