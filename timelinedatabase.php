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
    
    if($_POST["content"])
    {
        $content = $_POST["content"];
        mysqli_query($database, "INSERT INTO timeline (userid, word) VALUES ('$userid','$content')");
    
        mysqli_close($database);
        
        header("Location:./timeline.php"); 
    }
    else
    {
        mysqli_close($database);
        header("Location:./timeline.php");     
    }
?>

