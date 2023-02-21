<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <style>
        .logout:hover{
            background-color:none;
        }
    </style>
    <link rel="stylesheet" href="./Styles/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="mainhead">
        <div class="logo">
            <h1 id="logotext">Fortami</h1>
        </div>
        <div class="option">
           <nav>
                <a href="home.php">Home</a>
                <a href="sellerdash.php">Dashboard</a>
           </nav>
        </div>
        <div class="login">
        <?php
                        if(isset($_SESSION['user'])){
                            ?>
                                <form action="" method="post"><input class="input" type='submit' name='logout' value='Logout' style="width:100%; border:none;box-shadow:none; font-size:2.5vmin;" onMouseover></form>
                            <?php
                            
                            if(isset($_POST['logout'])){
                                $backend = new Backend;
                                $backend->logout();
                            }
                        }
                        else {
                            echo '<a href="login.php">Login</a>';
                        }
                    ?>
                </div>
    </div>
    
</body>
</html>