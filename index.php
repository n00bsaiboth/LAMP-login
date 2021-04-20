<?php
    session_start();

    include("__/php/functions.php");
    include("__/php/config.php");

    include("__/php/header.php");

?>

    <section class="container" id="welcome">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to PHP-MySQL Login</h1>
            <hr class="my-4">
            <p>Not might be the most bullet proof login system there is, but I'm quite sure it's not the worst there is. </p>
        
        </div>
    </section>

    <?php
      include("__/php/footer.php");
    ?>