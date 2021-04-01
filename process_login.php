<?php
    session_start();

    include("__/php/functions.php");
    include("__/php/config.php");

    if(isset($_POST["username"]) && !empty($_POST["username"])) {
        $username = validate($_POST["username"]);
        $username = filter_var($username, FILTER_SANITIZE_STRING);
    }

    if(isset($_POST["password"]) && !empty($_POST["password"])) {
        $password = validate($_POST["password"]);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
    }

    login($dbh, $username, $password);
?>