<?php
    session_start();

    include("__/php/functions.php");
    include("__/php/config.php");

    include("__/php/header.php");
?>

<section class="container" id="all-users">
    <article>
        <?php
                if(isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
                        // calling the getAllUsers function from the
                        // config file, where lies all the rest of the SQL 

                        getAllUsers($dbh);
                } else {
                    echo "<p>You need to be logged in to see all users. </p>";
                }
        ?>
    </article>
</section>

<?php
    include("__/php/footer.php");
?>