<?php
    session_start();

    include("__/php/functions.php");
    include("__/php/config.php");

    if(isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
        $id = validate($_SESSION["id"]);
        $id = filter_var($id, FILTER_VALIDATE_INT);
        
        // this settype seems to mess something up, because
        // the id number is not updating into profile file.
        
        // $id = settype($id, "integer");

        // try another way to do it, see if it works

        $id = (int) $id; 
    }

    // calling the getProfileDetails function from the
    // config file, where lies all the rest of the SQL 

    $row = getProfileDetails($dbh, $id);

    include("__/php/header.php");
?>


    <section class="container" id="Profile">
        <h2>Profile</h2>

        <?php 
		    if(isset($row) && !empty($row)) {
                echo "<p>ID: " . $row["id"] . "</p>";
                echo "<p>Username: " . $row["username"] . "</p>";
                echo "<p>Password: " . $row["password"] . "</p>";
            } else {
                $_SESSION["error"] = "Unfortunately, we couldn't find the following profile that matches with the ID-number. Actually we think that there was no ID-number.";

                header("Location: error.php");
            }
        ?>
    </section>

    <section class="container" id="">
    <?php
        echo "<a href=\"" . htmlspecialchars("index.php") . "\">Back to frontpage</a>";
    ?>
    </section>

<?php
    include("__/php/footer.php");
?>