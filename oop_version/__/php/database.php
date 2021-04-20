<?php
    class Database {
        private $host = "";
        private $db   = "";
        private $user = "";
        private $pass = "";
        private $dbh = "";
        private $stmt = "";
        private $count = "";
        private $row = "";
        private $query = "";

        public function __construct() {
            $this->host = "localhost";
            $this->db = "temporary";
            $this->user = "root";
            $this->pass = "mysql";
            $this->dbh = "";
            $this->stmt = "";
            $this->count = "";
            $this->row = "";
            $this->query = "";
        }


        // connect to db

        public function connectToDB() {
            try {
                $dbh = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->user, $this->pass);
                // for testing purposes        
                // echo "<p>You are now connected to the database. </p>";
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $dbh->exec("SET NAMES utf8");

            $this->dbh = $dbh;
        }

        // connect out from db

        public function connectOutFromDB() {
            if(isset($this->dbh) && !empty($this->dbh)) {
                unset($this->dbh);
            }
        
            if(isset($this->stmt) && !empty($this->stmt)) {
                unset($this->stmt);
            } 
        }

        // login 

        public function login($username, $password) {
            $this->query = "SELECT * FROM `users` WHERE `username`=:username";

            $this->stmt = $this->dbh->prepare($this->query);
        
            $this->stmt->bindParam('username', $username, PDO::PARAM_STR);
        
            $this->stmt->execute();
        
            $this->count = $this->stmt->rowCount();
            $this->row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        
            if($this->count == 1 && !empty($this->row)) {
                // $message = "Username was found on the database. <br />";  
                
                $validatedPassword = validateUserWhenLoggingIn($password, $this->row["password"]);

                if ($validatedPassword) {
                    // $message2 = "Password is valid. <br />";
        
                    // Quite not sure if this works, but try to make the $session_id variable to be integer.    
        
                    $_SESSION["id"] = validateINT($this->row["id"]);
        
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

        // check if user exist

        public function checkIfUserExists($username) {
            $this->query = "SELECT * FROM `users` WHERE `username`=:username";

            $this->stmt = $this->dbh->prepare($this->query);
    
            $this->stmt->bindParam('username', $username, PDO::PARAM_STR);
    
            $this->stmt->execute();
    
            $this->count = $this->stmt->rowCount();
            $this->row = $this->stmt->fetch(PDO::FETCH_ASSOC);
    
            if($this->count == 1 && !empty($this->row)) {
                $_SESSION["error"] = "Unfortunately, it looks like the username has already been taken. ";
            
                header("Location: error.php");
            } 
        }

        // add new user

        public function addNewUser($username, $password) {
            $this->query = "INSERT users (username, password) VALUES (:username, :password)";

            $this->stmt = $this->dbh->prepare($this->query);
        
            $this->stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $this->stmt->bindParam(":password", $password, PDO::PARAM_STR);
        
            if($this->stmt->execute()) {
                header("location: index.php");
            } 
        }

    	// remove user

        public function removeUser($id) {
            $this->query = "DELETE FROM `users` WHERE id = :id";

            $this->stmt = $this->dbh->prepare($this->query);
        
            $this->stmt->bindParam(":id", $id, PDO::PARAM_INT);	

            if($this->stmt->execute()) {
                $_SESSION['id'] = "";

                header("location: index.php");			
            } else {
                $_SESSION["error"] = "Unfortunately, there was some error while removing your user account. We think that the error was, that there was no corresponding ID-number, with your user account. ";
        
                header("Location: error.php");
            }
        }

        // update user password

        public function updateUserPassword($id, $password) {
            $this->query = "UPDATE users SET password = :password WHERE id = :id";

            $this->stmt = $this->dbh->prepare($this->query);
        
            $this->stmt->bindParam(":password", $password, PDO::PARAM_STR);
            $this->stmt->bindParam(":id", $id, PDO::PARAM_INT);	

            if($this->stmt->execute()) {

                header("location: index.php");			
            } else {
                $_SESSION["error"] = "Unfortunately, something went wrong. ";
        
                header("Location: error.php");
            }
        }

        // get user details

        public function getProfileDetails($id) {
            $this->query = "SELECT * FROM `users` WHERE `id`=:id";

            $this->stmt = $this->dbh->prepare($this->query);
        
            $this->stmt->bindParam('id', $id, PDO::PARAM_STR);
        
            $this->stmt->execute();
            
            $this->count = $this->stmt->rowCount();
            $this->row   = $this->stmt->fetch(PDO::FETCH_ASSOC);
    
            if($this->count == 1 && !empty($this->row)) {
                return $this->row;
            }
        }

        // for testing purposes

        public function selectUser($username) {
            $this->query = "SELECT * FROM `users` WHERE `username`=:username";

		    $this->stmt = $this->dbh->prepare($this->query);

    	    $this->stmt->bindParam('username', $username, PDO::PARAM_STR);

    	    $this->stmt->execute();

    	    $this->count = $this->stmt->rowCount();
    	    $this->row = $this->stmt->fetch(PDO::FETCH_ASSOC);

    	    if($this->count == 1 && !empty($this->row)) {
        	   echo "<p>" . $this->row["username"] . "</p>";
    	    } 
	
        }


    }

    $database = new Database();

    $database->connectToDB();


?>