<?php
    include 'backend.php';
    include 'buyerheader.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Payment</title>
</head>
<body>
    <div class="container text-center p-5 d-flex justify-content-center">
        <div class="row g-3 p-2 shadow rounded">
                <h1 class="text-primary">E-Wallet Payment</h1>
            <form action="">
                <div class="col-12">
                    <select class="form-control" name="wallet" required>
                        <option selected disabled>- Choose your e-wallet -</option>
                        <option value="1">Gcash</option>
                        <option value="2">Maya</option>
                        <option value="3">Coinsph</option>
                    </select>
                </div>
                <br>
                <div class="col-12">
                    <h4 class="text-secondary">Shop Wallet Address</h4>
                </div>
                <div class="col-md-3 text-start">
                    <h6 class="text-secondary ">Gcash #: </h6>
                    <h6 class="text-secondary">Account name: </h6>
                </div>
            </form>
        </div>
    </div>
</body>
</html>