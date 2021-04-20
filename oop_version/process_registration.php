<?php
    session_start();

    require_once "__/php/functions.php";
    // require_once "__/php/config.php";

    require_once "__/php/user.php";
    require_once "__/php/database.php";

    if(isset($_POST["username"]) && !empty($_POST["username"])) {
        $username = validateString($_POST["username"]);
    } else {
        $_SESSION["error"] = "Unfortunately, it looks like you did not fill the username in the form. ";
        
        header("Location: error.php");
    }

    if(isset($_POST["password"]) && !empty($_POST["password"])) {
        $password = validateString($_POST["password"]);

        // if you need to view the password in plain text, here is your chance.
        // $password_in_plaintext = $password;

        $password = createUserPasswordHash($password);
    } else {
        $_SESSION["error"] = "Unfortunately, it looks like you did not fill the password in the form. ";
        
        header("Location: error.php");
    }

    // check if the username already exists, if it does, then send an error to the user that
    // the username has already been taken.

    $user->checkIfUserExists($database, $username);

    // then run another query, if the username does not exist. 
    // if the statement runs smoothly, the user will be added to the user table, then
    // get redirected to index.php, which is our homepage. 

    $user->addNewUser($database, $username, $password);
?>