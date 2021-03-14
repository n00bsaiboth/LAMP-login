<?php
    session_start();
    
    $_SESSION['id'] = "";
   
    if(empty($_SESSION['id'])) {
        header("location: index.php");
    }
?>