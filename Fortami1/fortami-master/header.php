<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image" href="./src/FortamiLogo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fortami</title>
    <link rel="stylesheet" href="./Styles/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="mainhead">
        <div class="logo">
        <a href="buyerdash.php" <h1 id="logotext">Fortami</a></h1>
        </div>
        <div class="option">
           <nav>
                <a href="index.php">Home</a>
                <a href="sellerdash.php">Food Shops</a>
                <a href="#">FAQs</a> 
                <a href="#">About us</a>
                <a href="#">Contact Us</a> 
                
           </nav>
        </div>
        <div class="login">
                    <?php
                        if(isset($_SESSION['user'])){
                            ?>
                                <form action="" method="post"><input class='logout' type='submit' name='logout' value='Logout'></form>
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