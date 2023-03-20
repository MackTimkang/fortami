<?php
  include 'backend.php';
  $backend = new Backend;
  $shop = $backend->shopName();
  $shopName = mysqli_fetch_assoc($shop);
  $_SESSION['shop_id'] = $shopName['user_id'];
  $receipt = $backend->orderReceipt();
  $seller = $backend->sellerAddress($_SESSION['shop_id']);
  $shopAddress = mysqli_fetch_assoc($seller);
  $receiptnum = mysqli_fetch_assoc($receipt);
  $timestamp = $receiptnum['pay_datetime'];
  $date = date("M d, Y",strtotime($timestamp));
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Fortami Receipt</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="./Styles/receipt.css " />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-6">
          <h1>Receipt</h1>
          <p class="font-weight-bold mb-0">Date: <?=$date?> </p>
          <p class="font-weight-bold">Receipt #: <?=$_SESSION['trans_id']?></p>
          <p class="font-weight-bold">Payment Status: <?=$receiptnum['trans_status']?></p>
        </div>
        <div class="col-md-6 text-md-right">
          <h2 class="mb-0"><?=$shopAddress['full_name']?></h2>
          <p class="mb-0"><?=$shopAddress['street']?></p>
          <p class="mb-0"><?=$shopAddress['barangay'].', '.$shopAddress['city'].' City, '.$shopAddress['province'].', Philippines, '.$shopAddress['zip'];?></p>
          <p class="mb-0">(+63) <?=$shopAddress['contact']?></p>
        </div>
      </div>
      <hr />
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if ($receipt->num_rows > 0) {
              foreach ($receipt as $row) {
          ?>
          <tr>
            <td><?=$row['food_name']?></td>
            <td><?=$row['quantity']?></td>
            <td> <?=$row['food_discountedPrice']?></td>
            <td>₱ <?=$row['food_discountedPrice']*$row['quantity']?></td>
          </tr>
          <?php
            }
          }
          ?>
          <tr>
            <td colspan="3">Total</td>
            <td>₱ <?=$_SESSION['total']?></td>
          </tr>
        </tbody>
      </table>
      <div class="col-12 text-center">
        <h1><a href="activeorders.php" class="btn btn-info">View Order Status here</a></h1>
      </div>
    </div>
  </body>
</html>
