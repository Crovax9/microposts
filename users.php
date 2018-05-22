<?php
    session_start();
    require"DatabaseFunc.php";
    $username = UserNameSearch();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Microposts</title>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style type="text/css">
            li
            {
                list-style-type:none;    
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-inverse navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/twitter/timeline.php">Microposts</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="users.php">Users</a></li>
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php print htmlspecialchars($username, ENT_QUOTES, 'UTF-8');?><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="information.php">My profile</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>        
        <div class="container">
            <div class="row">
                <?php
                    $content = UserSearch();
                    
                    foreach($content as $contents)
                    {
                ?>
                    <li>
                        <div class="media-body">
                            <div>
                                <p><?php print htmlspecialchars($contents['name'], ENT_QUOTES, 'UTF-8');?></p>
                            </div>
                                <form method="POST" action="viewprofile.php" accept-charset="UTF-8">
                                    <input name="username" type="hidden" value=<?php echo $contents['name'] ?>>
                                    <input name="userid" type="hidden" value=<?php echo $contents['id'] ?>>
                                    <input class="btn btn-danger btn-xs" type="submit" value="ViewProfile">
                                </form>
                                <br/>
                            <br/>
                        </div>
                    </li>
                <?php
                    }
                ?>
            </div>
        </div>
    </body>
</html>
