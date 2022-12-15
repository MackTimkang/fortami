<?php
include 'backend.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="./Styles/style.css">
</head>
<body>
    <div class="maincont">
        <div class="content1">
            <h1>Cravings?</h1>
            <form action="#" method="post">
                <input type="submit" name="buynow" value="Buy now">
            </form>
        </div>
        <div class="buyer">
            <div class="buyerimg">
                <img src="./src/Food-Delivery-Service-PNG-Photo.png" alt="buyer" >
            </div>  
        </div>
        <div class="content2">
            <h1>Food Shop Owner?</h1>
            <form action="#" method="post">
                <input type="submit" name="sellnow" value="Sell now">
            </form>
        </div>
        <div class="seller">
            <img src="./src/foodshop.png" alt="seller" >
        </div>
    </div>
    <?php
        include 'footer.php';
    ?>
</body>
</html>
