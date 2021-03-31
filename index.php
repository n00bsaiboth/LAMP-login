<?php
    session_start();
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">PHP-MySQL Login</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
        <?php 
            if(isset($_SESSION["id"]) && !empty($_SESSION["id"])) {  
                echo "<a class=\"nav-link\" href=\"" . htmlspecialchars("logout.php") . "\">Logout</a>";
            } else {
                echo "<a class=\"nav-link\" href=\"" . htmlspecialchars("login.php") . "\">Login</a>";
            }
        ?>  
        </li>
        <li class="nav-item">
        <?php 
            if(empty($_SESSION["id"])) {  
                echo "<a class=\"nav-link\" href=\"" . htmlspecialchars("register.php") . "\">Register</a>";
            } 
        ?>  
            
        </li>
    </div>
    </nav>
    <section class="container" id="error">
        <div class="jumbotron">
        <h1 class="display-4">Welcome to PHP-MySQL Login</h1>
        <hr class="my-4">
        <p>
        
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>
</html>