<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>LAMP-login</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">LAMP-login</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <?php 
                if(isset($_SESSION["id"]) && !empty($_SESSION["id"])) {  
                    echo "<a class=\"nav-link\" href=\"" . validateURL("logout.php") . "\">Logout</a>";
                } else {
                    echo "<a class=\"nav-link\" href=\"" . validateURL("login.php") . "\">Login</a>";
                }
            ?>  
            </li>
            <li class="nav-item">
            <?php 
                if(empty($_SESSION["id"])) {  
                    echo "<a class=\"nav-link\" href=\"" . validateURL("register.php") . "\">Register</a>";
                } 
            ?>         
            </li>
            <li class="nav-item">
            <?php 
                if(isset($_SESSION["id"]) && !empty($_SESSION["id"])) {  
                    echo "<a class=\"nav-link\" href=\"" . validateURL("profile.php") . "\">Profile</a>";
                } 
            ?>         
            </li>
        </div>
    </nav>