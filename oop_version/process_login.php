<?php
    session_start();

    require_once "__/php/functions.php";

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

    } else {
        $_SESSION["error"] = "Unfortunately, it looks like you did not fill the password in the form. ";
        
        header("Location: error.php");
    }

    $user->login($database, $username, $password);
?>