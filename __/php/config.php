<?php
	

    $host = 'localhost';
	$db   = 'temporary';
	$user = 'root';
	$pass = 'mysql';

    try {
	    $dbh = new PDO("mysql:host=" . $host . ";dbname=" . $db, $user, $pass);
	} catch (PDOException $e) {
	    die("Error: " . $e->getMessage());
    }

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbh->exec("SET NAMES utf8");

?>