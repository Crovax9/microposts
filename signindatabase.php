<?php
    session_start();
    
    $username = "root";
    $password = "";
    $db_host = "localhost"; 
    $db_name = "microposts"; 
    $database = mysqli_connect($db_host,$username,$password,$db_name);
  
    mysqli_character_set_name($database);
    mysqli_set_charset($database, "utf8");
    
    if($_POST["signup"])
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $passwd = $_POST["password"];
        $confirm = $_POST["password_confirmation"];
 
        if($passwd != $confirm)
        {
            mysqli_close($database);
            header("Location:./signup.php");
            exit;
        }
        
        $result = mysqli_query($database, "SELECT email FROM signup WHERE email = '$email'");
        $rows_cnt = mysqli_num_rows($result);
        if($rows_cnt > 0)
        {
            mysqli_close($database);
            header("Location:./signup.php");
            exit;
        }
        else 
        {
            mysqli_query($database,"INSERT INTO signup (name, email, password) VALUES ('$name','$email', '$passwd')");

            $result = mysqli_query($database, "SELECT * FROM signup WHERE email = '$email'");
            $row = mysqli_fetch_row($result);
            
            $_SESSION["userid"] = $row[0];
            
            mysqli_free_result($result);
        }
    }
    else if($_POST["login"])
    {
        $email = $_POST["email"];
        $passwd = $_POST["password"];
        
        $result = mysqli_query($database, "SELECT email FROM signup WHERE email = '$email'");
        $rows_cnt = mysqli_num_rows($result);
        if($rows_cnt == 0)
        {
            mysqli_close($database);
            header("Location:./login.php");
            exit;
        }
        else 
        {
            $result = mysqli_query($database, "SELECT password FROM signup WHERE email = '$email'");
            $row = mysqli_fetch_row($result);
            if($passwd != $row[0])
            {
                mysqli_close($database);
                header("Location:./login.php");
                exit;
            }
            else 
            {
                $result = mysqli_query($database, "SELECT * FROM signup WHERE email = '$email'");
                $row = mysqli_fetch_row($result);
                
                $_SESSION["userid"] = $row[0];
                
                mysqli_free_result($result);
            }
        }
    }
    
    mysqli_free_result($result);
    
    mysqli_close($database);

    header("Location:./timeline.php"); 
?>

