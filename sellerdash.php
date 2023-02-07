<?php
    include('backend.php');
    $backend = new Backend;
    $backend->checksession();
    include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/dashboard.css">
 
    <title>Dashboard</title>
</head>
<body>
    <div class="main-cont">
        <div class="btn-cont">
            <form action="" method="post">
                <input type="submit" name="product" value="Product" >
                <input type="submit" name="order" value="Order" >
                <input type="submit" name="transaction" value="Transaction" >
                <input type="submit" name="sales" value="Sales" >
            </form>
        </div>
    </div>
</body>
</html>