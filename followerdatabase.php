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
    
    $result = mysqli_query($database, "SELECT * FROM followtable WHERE userid = '$userid' && followid = '$followid'");
        
    $records = mysqli_num_rows($result);
    
    if($records < 1)
    {
        
        mysqli_query($database, "INSERT INTO followtable (userid, followid) VALUES ('$userid','$followid')");
    
        mysqli_close($database);
        
        header("Location:./users.php"); 
    }
    else
    {
        mysqli_close($database);
        header("Location:./users.php");     
    }
?>

