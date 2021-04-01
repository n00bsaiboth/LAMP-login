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
	
	/* functions
	 *
	 */

    // the arguments needs to be null, or else we get an error

	function getProfileDetails($dbh = null, $id = null) {
		$query = "SELECT * FROM `users` WHERE `id`=:id";

		$stmt = $dbh->prepare($query);
	
		$stmt->bindParam('id', $id, PDO::PARAM_STR);
	
		$stmt->execute();
		
		$count = $stmt->rowCount();
		$row   = $stmt->fetch(PDO::FETCH_ASSOC);

		if($count == 1 && !empty($row)) {
			return $row;
		}
	}
?>