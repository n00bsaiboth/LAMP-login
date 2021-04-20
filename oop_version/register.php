<?php
    session_start();

    require_once "__/php/functions.php";
    require_once "__/php/database.php";
    
    // require_once "__/php/config.php";

    require_once "__/php/header.php";
?>


    <section class="container" id="register">
        <h2>Register</h2>

        <form action="<?php echo validateURL("process_registration.php"); ?>" method="post">
            <div class="form-group">
                <label for="username">Username: </label>
                <input type="text" class="form-control" name="username" id="username">      
            </div>

            <div class="form-group">
            <label for="password">Password: </label>
                <input type="password" class="form-control" name="password" id="password">   
            </div>

            <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Register">
        </form>

    </section>


<?php
    require_once "__/php/footer.php";
?>