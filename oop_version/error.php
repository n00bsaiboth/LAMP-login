<?php
    session_start();

    require_once "__/php/functions.php";
    require_once "__/php/database.php";
    require_once "__/php/config.php";

    if(isset($_SESSION["error"]) && !empty($_SESSION["error"])) {
        $error = validateString($_SESSION["error"]);
    }

    require_once "__/php/header.php";

?>

    <section class="container" id="error">
        <div class="jumbotron">
        <h1 class="display-4">Oops, something went wrong!</h1>
        <hr class="my-4">
        <p>
        <?php
            if(isset($error) && !empty($error)) {
                echo validateOutput($error);
            }          
        ?>
        </p>
        <p class="lead"><a href="index.php">Return to frontpage</a></p>
        </div>
    </section>

    <?php
        require_once "__/php/footer.php";
    ?>