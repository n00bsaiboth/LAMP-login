<?php
    session_start();

    include("__/php/functions.php");
    include("__/php/config.php");

    if(isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
        $id = validate($_SESSION["id"]);
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $id = settype($id, "integer");
    }

    
    $query = "SELECT * FROM `users` WHERE `id`=:id";

    $stmt = $dbh->prepare($query);

    $stmt->bindParam('id', $id, PDO::PARAM_STR);

    $stmt->execute();
    
    $count = $stmt->rowCount();
    $row   = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Profile</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php 

    ?>
    <section class="container" id="Profile">
        <h2>Profile</h2>

        <?php 
		    if($count == 1 && !empty($row)) {
			    echo "<p>ID: " . $row["id"] . "</p>";
                echo "<p>Username: " . $row["username"] . "</p>";
                echo "<p>password: " . $row["password"] . "</p>";
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

    <section class="container" id="">

    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>
</html>