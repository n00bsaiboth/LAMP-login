<?php
    session_start();

    include("__/php/functions.php");
    include("__/php/config.php");

    if(isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
        $id = validateINT($_SESSION["id"]);

    }

    if(isset($_POST["newpassword"]) && !empty($_POST["newpassword"])) {
        $password = validateString($_POST["newpassword"]);
        
        $password = createUserPasswordHash($password);
    }

    // echo "You're about to remove user with the id of " . $id . ".";

    // checkIfUserWithAnIDAndPasswordExists($dbh, $id);

     updateUserPassword($dbh, $password, $id);

?>