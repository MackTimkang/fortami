<?php
    include 'backend.php';
    include 'sellerheader.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <div class="container-fluid ">
        <br><br>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-3">
                <a href="product.php"><img src="./src/widget-food.png" alt="Product" class="img-fluid"></a>
                <div class="row"><h1 style="text-align:center">Products</h1></div>
            </div>
            <div class="col-3">
                <img src="./src/vector-checklist-icon.webp" class="img-fluid"style="border-radius:100%" alt="Orders">
                <div class="row"><h1 style="text-align:center;">Orders</h1></div>
            </div>
        </div>
        <br><br>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-3">
                <img src="./src/sales.png" class="img-fluid" alt="Sales">
                <div class="row"><h1 style="text-align:center">Sales</h1></div>
            </div>
            <div class="col-3">
                <img src="./src/transactions.png" class="img-fluid" alt="Transactions">
                <div class="row"><h1 style="text-align:center">Transactions</h1></div>
            </div>
        </div>
    </div>
</body>
</html>