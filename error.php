<?php
    session_start();

    if(isset($_SESSION["error"]) && !empty($_SESSION["error"])) {
        $error = $_SESSION["error"];
    }
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
    <section class="container" id="error">
        <div class="jumbotron">
        <h1 class="display-4">Oops, something went wrong!</h1>
        <hr class="my-4">
        <p>
        <?php
            if(isset($error) && !empty($error)) {
                echo $error;
            }          
        ?>
        </p>
        <p class="lead"><a href="index.php">Return to frontpage</a></p>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>
</html>