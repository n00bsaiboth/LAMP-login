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

	// get all users (for testing purposes)

	function getAllUsers($dbh = null) {
		$query = "SELECT * FROM `users`";

		$stmt = $dbh->prepare($query);

		$stmt->execute();

		echo "<div class=\"row\">";
		echo "<div class=\"col\"><b>Username</b></div>";
		echo "<div class=\"col\"><b>Password</b></div>";
		echo "</div>";
		


		while($row = $stmt->fetch()) {
			echo "<div class=\"row\">";
			echo "<div class=\"col\"><p>" . validateOutput($row['username']) . "</p></div>";
			echo "<div class=\"col\"><p>" . validateOutput($row['password']) . "</p></div>";
			echo "</div>";
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



	function checkIfUserWithAnIDExists($dbh = null, $id = null) {

		$query = "SELECT * FROM `users` WHERE `id`=:id";

		$stmt = $dbh->prepare($query);

    	$stmt->bindParam('id', $id, PDO::PARAM_STR);

    	$stmt->execute();

    	$count = $stmt->rowCount();
    	$row   = $stmt->fetch(PDO::FETCH_ASSOC);

    	if($count == 1 && !empty($row)) {
        	$_SESSION["error"] = "We found the user with the corresponding ID-number. ";
        
        	header("Location: error.php");
    	} 

	}

	/* Check if User with and ID and Password exists.
	 *
	 * 

	function checkIfUserWithAnIDAndPasswordExists($dbh = null, $id = null) {

		$query = "SELECT * FROM `users` WHERE `id`=:id";

		$stmt = $dbh->prepare($query);

    	$stmt->bindParam('id', $id, PDO::PARAM_STR);

    	$stmt->execute();

    	$count = $stmt->rowCount();
    	$row   = $stmt->fetch(PDO::FETCH_ASSOC);

    	if($count == 1 && !empty($row)) {
			if($_POST["currentpassword"] == $row["password"]) {
				$_SESSION["error"] = "Unfortunately, you entered the wrong password. ";
			} else {

				header("Location: error.php");
			}
        	
        
        	
    	} 

	}

	*/

	// add new user

	function addNewUser($dbh = null, $username = null, $password = null) {

		$query = "INSERT users (username, password) VALUES (:username, :password)";

		$stmt = $dbh->prepare($query);
	
		$stmt->bindParam(":username", $username, PDO::PARAM_STR);
		$stmt->bindParam(":password", $password, PDO::PARAM_STR);
	
		if($stmt->execute()) {
			header("location: index.php");
		} 
	}

	// remove user

	function removeUser($dbh = null, $id = null) {

		$query = "DELETE FROM `users` WHERE id = :id";

		$stmt = $dbh->prepare($query);
	
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);	

		if($stmt->execute()) {
			$_SESSION['id'] = "";

			header("location: index.php");			
		} else {
			$_SESSION["error"] = "Unfortunately, there was some error while removing your user account. We think that the error was, that there was no corresponding ID-number, with your user account. ";
	
			header("Location: error.php");
		}
	}

	// update user password

	function updateUserPassword($dbh = null, $password = null, $id = null) {
		$query = "UPDATE users SET password = :password WHERE id = :id";

		$stmt = $dbh->prepare($query);
	
		$stmt->bindParam(":password", $password, PDO::PARAM_STR);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);	

		if($stmt->execute()) {

			header("location: index.php");			
		} else {
			$_SESSION["error"] = "Unfortunately, something went wrong. ";
	
			header("Location: error.php");
		}

	}

	// login

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

			$validatedPassword = validateUserWhenLoggingIn($password, $row["password"]);

			if ($validatedPassword) {
				// $message2 = "Password is valid. <br />";
	
				// Quite not sure if this works, but try to make the $session_id variable to be integer.    
	
				$_SESSION["id"] = validateINT($row["id"]);
	
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