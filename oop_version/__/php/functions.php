<?php
    function validateInput($data) {
        $data = trim($data);
        $data = htmlentities($data);
        $data = stripslashes($data);

        return $data;
    }

    function validateOutput($data) {
        $data = trim($data);
        $data = htmlentities($data);
        $data = stripslashes($data);

        return $data;
    }  

    function validateURL($data) {
        $data = validateInput($data);

        $data = htmlspecialchars($data);
        

        // these doesn't quite work, because it needs an actual url, not just a file name. 

        // $data = filter_var($data, FILTER_SANITIZE_URL);

        // $data = filter_var($data, FILTER_VALIDATE_URL);

        return $data;
    }

    function validateString($data) {
        $data = validateInput($data);

        $data = (string) $data;

        $data = filter_var($data, FILTER_SANITIZE_STRING);

        return $data;
    }

    function validateINT($data) {
        $data = validateInput($data);

        $data = (int) $data;

        $data = filter_var($data, FILTER_VALIDATE_INT);

        return $data;  
    }

    // user and password for logging purposes

    function validateUserWhenLoggingIn($password, $password_hash) {
        if(password_verify($password, $password_hash)) {
            return $password;
        } else {
            $_SESSION["error"] = "Unfortunately, it looks like you have the wrong password. ";
        
            header("Location: error.php");
        }
    }

    function createUserPasswordHash($password) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        return $password;
    }
?>