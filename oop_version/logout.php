<?php
    session_start();

    // Unset session variables
    // $_SESSION = array();

    session_unset(); 
 
    // Destroy the session

    session_destroy();

    // If session was destroyed, then redirect to homepage. 
   
    if(empty($_SESSION)) {
        header("location: index.php");
    } else {
        header("location: profile.php");
    }
?>