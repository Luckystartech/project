<?php
    $localhost = "localhost";
    $username = "root";
    $password = "";
    $database = "jessica2525";
    
    $conn = new mysqli( $localhost, $username, $password, $database);
    
    if (!$conn){
        die();
    }
?>