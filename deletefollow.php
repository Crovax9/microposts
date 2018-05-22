<?php
session_start();

    $username = "root";
    $password = "";
    $db_host = "localhost"; 
    $db_name = "microposts"; 
    
    $database = mysqli_connect($db_host,$username,$password,$db_name);
    
    mysqli_character_set_name($database);
    mysqli_set_charset($database, "utf8");
    
    $userid = $_SESSION["userid"];
    
    $followid = $_GET["userid"];
        
    mysqli_query($database, "DELETE FROM followtable WHERE followid = '$followid' && userid = '$userid'");

    mysqli_close($database);

    header("Location:./users.php"); 
?>