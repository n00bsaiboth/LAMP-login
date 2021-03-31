<?php
    session_start();

    include("__/php/functions.php");
    include("__/php/config.php");

    if(isset($_POST["username"]) && !empty($_POST["username"])) {
        $username = $_POST["username"];
        $username = validate($username);
    }

    if(isset($_POST["password"]) && !empty($_POST["password"])) {
        $password = $_POST["password"];
        $password = validate($password);
        // $password_in_plaintext = $password;
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    // check if the username already exists, if it does, then send an error to the user that
    // the username has already been taken.

    $query = "SELECT * FROM `users` WHERE `username`=:username";

	$stmt = $dbh->prepare($query);

    $stmt->bindParam('username', $username, PDO::PARAM_STR);

    $stmt->execute();

    $count = $stmt->rowCount();
    $row   = $stmt->fetch(PDO::FETCH_ASSOC);

    if($count == 1 && !empty($row)) {
        $_SESSION["error"] = "Unfortunately, it looks like the username has already been taken. ";
        
        header("Location: error.php");
    } 

    // then run another query, if the username does not exist. 
    // if the statement runs smoothly, the user will be added to the user table, then
    // get redirected to index.php, which is our homepage. 

    $sql = "INSERT users (username, password) VALUES (:username, :password)";

    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->bindParam(":password", $password, PDO::PARAM_STR);

    if($stmt->execute()) {
        header("location: index.php");
    } 
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>
</html>