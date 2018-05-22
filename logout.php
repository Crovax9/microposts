<?php
    session_start();
    
    session_unset($_SESSION["userid"]);
    
    header("Location:./index.php"); 
?>