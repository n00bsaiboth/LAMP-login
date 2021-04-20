<?php
    session_start();

    require_once "__/php/functions.php";

    require_once "__/php/user.php";
    require_once "__/php/database.php";

    if(isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
        $id = validateINT($_SESSION["id"]);
    }

    if(isset($_POST["newpassword"]) && !empty($_POST["newpassword"])) {
        $password = validateString($_POST["newpassword"]);
       
        $password = createUserPasswordHash($password, PASSWORD_DEFAULT);
    }

    // echo "You're about to remove user with the id of " . $id . ".";

    // checkIfUserWithAnIDAndPasswordExists($dbh, $id);

    // samething happened here. Getting an error of: Fatal error: Uncaught Error: Call to a member function on string

    // $user->updateUserPassword($database, $id, $password);

    // but this seems to work. 

    $database->updateUserPassword($id, $password);
?>