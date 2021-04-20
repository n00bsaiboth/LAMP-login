<?php
    session_start();

    require_once "__/php/functions.php";
    require_once "__/php/database.php";
    
    // require_once "__/php/config.php";

    require_once "__/php/header.php";

?>

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
    <section class="container" id="welcome">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to PHP-MySQL Login</h1>
            <hr class="my-4">
            <p>Not might be the most bullet proof login system there is, but I'm quite sure it's not the worst there is. </p>
        
        </div>
    </section>

    <?php
      require_once "__/php/footer.php";
    ?>