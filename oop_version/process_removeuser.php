<?php
    session_start();

    require_once "__/php/functions.php";
    // require_once "__/php/config.php";

    require_once "__/php/user.php";
    require_once "__/php/database.php";

    if(isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
        $id = validateINT($_SESSION["id"]);
        
    }

    // echo "You're about to remove user with the id of " . $id . ".";

    // checkIfUserWithAnIDExists($dbh, $id);

    $user->removeUser($database, $id);

?>