<?php
    function TimelineContentSearch($id)
    {
        $username = "root";
        $password = "";
        $db_host = "localhost"; 
        $db_name = "microposts"; 
        $database = mysqli_connect($db_host,$username,$password,$db_name);
  
        mysqli_character_set_name($database);
        mysqli_set_charset($database, "utf8");
    
        $result = mysqli_query($database, "SELECT timeline.id, timeline.word, timeline.created_at, signup.name FROM timeline INNER JOIN signup ON timeline.userid = signup.id WHERE timeline.userid = '$id' ORDER BY created_at DESC");
        
        $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        mysqli_free_result($result);
    
        mysqli_close($database);

        return $records;
    }
    
    function TimelineContentSearchAll()
    {
        $username = "root";
        $password = "";
        $db_host = "localhost"; 
        $db_name = "microposts"; 
        $database = mysqli_connect($db_host,$username,$password,$db_name);
  
        mysqli_character_set_name($database);
        mysqli_set_charset($database, "utf8");
    
        $userid = $_SESSION["userid"];
    
        $result = mysqli_query($database, "SELECT timeline.id, timeline.word, timeline.created_at, timeline.userid, signup.name FROM timeline INNER JOIN signup ON timeline.userid = signup.id ORDER BY created_at DESC");
    
        $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        mysqli_free_result($result);
    
        mysqli_close($database);

        return $records;
    }
    
    function UserNameSearch()
    {
        $username = "root";
        $password = "";
        $db_host = "localhost"; 
        $db_name = "microposts"; 
        $database = mysqli_connect($db_host,$username,$password,$db_name);
  
        mysqli_character_set_name($database);
        mysqli_set_charset($database, "utf8");
    
        $userid = $_SESSION["userid"];
    
        $result = mysqli_query($database, "SELECT name FROM signup WHERE id = '$userid' ORDER BY created_at DESC");

        $records = mysqli_fetch_row($result);
        
        mysqli_free_result($result);
    
        mysqli_close($database);

        return $records[0];
    }
    
    function UserSearch()
    {
        $username = "root";
        $password = "";
        $db_host = "localhost"; 
        $db_name = "microposts"; 
        $database = mysqli_connect($db_host,$username,$password,$db_name);
  
        mysqli_character_set_name($database);
        mysqli_set_charset($database, "utf8");
    
        $userid = $_SESSION["userid"];
        
        $result = mysqli_query($database, "SELECT id, name FROM signup WHERE id != '$userid' ORDER BY rand()");
        
        $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        mysqli_free_result($result);
    
        mysqli_close($database);

        return $records;
    }
    
    function ContentDelete($contentid)
    {
        $username = "root";
        $password = "";
        $db_host = "localhost"; 
        $db_name = "microposts"; 
        $database = mysqli_connect($db_host,$username,$password,$db_name);
  
        mysqli_character_set_name($database);
        mysqli_set_charset($database, "utf8");
    
        $userid = $_SESSION["userid"];
        
        mysqli_query($database, "DELETE FROM timeline WHERE id = '$contentid'");

        mysqli_close($database);
    }
    
    function FollowInsert($followid)
    {
        $username = "root";
        $password = "";
        $db_host = "localhost"; 
        $db_name = "microposts"; 
        $database = mysqli_connect($db_host,$username,$password,$db_name);
        
        mysqli_character_set_name($database);
        mysqli_set_charset($database, "utf8");
        
        $userid = $_SESSION["userid"];
        
        $result = mysqli_query($database, "SELECT * FROM followtable WHERE followid = '$followid'");
        
        $records = mysqli_num_fields($result);
        
        mysqli_query($database, "INSERT INTO followtable (userid, followid) VALUES ('$userid','$followid')");
        
        mysqli_close($database);
        
        if($records < 1)
        {
            mysqli_query($database, "INSERT INTO followtable (userid, followid) VALUES ('$userid','$followid')");
        
            mysqli_close($database);
        }
        else
        {
            mysqli_close($database);
        }
            
    }
    
    function FollowSearch($userid)
    {
        $username = "root";
        $password = "";
        $db_host = "localhost"; 
        $db_name = "microposts"; 
        $database = mysqli_connect($db_host,$username,$password,$db_name);
  
        mysqli_character_set_name($database);
        mysqli_set_charset($database, "utf8");
        
        $result = mysqli_query($database, "SELECT signup.name FROM signup INNER JOIN followtable ON followtable.followid = signup.id WHERE followtable.userid = '$userid'");
        
        $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        mysqli_free_result($result);
    
        mysqli_close($database);

        return $records;
    }
    
    function FollowerSearch($userid)
    {
        $username = "root";
        $password = "";
        $db_host = "localhost"; 
        $db_name = "microposts"; 
        $database = mysqli_connect($db_host,$username,$password,$db_name);
  
        mysqli_character_set_name($database);
        mysqli_set_charset($database, "utf8");
    
        $result = mysqli_query($database, "SELECT signup.name FROM signup INNER JOIN followtable ON followtable.userid = signup.id WHERE followtable.followid = '$userid'");
        
        $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        mysqli_free_result($result);
    
        mysqli_close($database);

        return $records;
    }
    
    function FollowInfoSearch($followid)
    {
        $username = "root";
        $password = "";
        $db_host = "localhost"; 
        $db_name = "microposts"; 
        $database = mysqli_connect($db_host,$username,$password,$db_name);
  
        mysqli_character_set_name($database);
        mysqli_set_charset($database, "utf8");
        
        $userid = $_SESSION["userid"];
        
        $result = mysqli_query($database, "SELECT followid, userid FROM followtable WHERE followid = '$followid' && userid = '$userid'");
        
        $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        if(count($records) < 1)
        {
            mysqli_free_result($result);
    
            mysqli_close($database);
            return true;
        }

            mysqli_free_result($result);
    
            mysqli_close($database);
            
            return false;
    }
    
?>

