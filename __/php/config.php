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

	// check if username exists

	function checkIfUserExists($dbh = null, $username = null) {

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
	}

	// add new user

	function addNewUser($dbh = null, $username = null, $password = null) {
		$sql = "INSERT users (username, password) VALUES (:username, :password)";

		$stmt = $dbh->prepare($sql);
	
		$stmt->bindParam(":username", $username, PDO::PARAM_STR);
		$stmt->bindParam(":password", $password, PDO::PARAM_STR);
	
		if($stmt->execute()) {
			header("location: index.php");
		} 
	}

	function login($dbh = null, $username = null, $password = null) {

		// Searching the username from the database

		$query = "SELECT * FROM `users` WHERE `username`=:username";

		$stmt = $dbh->prepare($query);
	
		$stmt->bindParam('username', $username, PDO::PARAM_STR);
	
		$stmt->execute();
	
		$count = $stmt->rowCount();
		$row   = $stmt->fetch(PDO::FETCH_ASSOC);
	
		if($count == 1 && !empty($row)) {
			// $message = "Username was found on the database. <br />";     
			if (password_verify($password, $row["password"])) {
				// $message2 = "Password is valid. <br />";
	
				// Quite not sure if this works, but try to make the $session_id variable to be integer.    
	
				$_SESSION["id"] = filter_var($row["id"], FILTER_VALIDATE_INT);
	
				header('location:index.php');
			} else {
				$_SESSION["error"] = "Unfortunately, it looks like you have the wrong password. ";
	
				header("Location: error.php");
			}
		} else {
			$_SESSION["error"] = "Unfortunately, it looks like we can't find the username from our database. ";
	
			header("Location: error.php");
			// echo "username or password invalid.";
		}
	}
?>