<?php
    session_start();

    include("__/php/functions.php");
    include("__/php/config.php");

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

    login($dbh, $username, $password);
?>