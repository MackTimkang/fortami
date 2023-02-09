<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
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
                <a href="index.php">Home</a>
                <a href="Menu.php">Menu</a>
                <a href="Foodshop.php">Food Shops</a>
                <a href="faq.php">FAQs</a>  
           </nav>
        </div>
        <div class="login">
                    <?php
                        if(isset($_SESSION['user'])){
                            echo "<form action='' method='post'>";
                            echo "<input class='logout' type='submit' name='logout' value='Logout'>";
                            echo "</form>";
                            $backend->logout();
                        }
                        else {
                            echo '<a href="login.php">Login</a>';
                        }
                    ?>
                </div>
    </div>
    
</body>
</html>