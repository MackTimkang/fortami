<?php
    include 'backend.php';
    include 'buyerheader.php';
    $backend = new Backend;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity</title>
    <style>
        .star a{
            font-size:5vmin;
            opacity:50%;
        }
        .star:hover a{
            opacity:100%;
        }
        .star a:hover{
            opacity:100%;
        }
        .star a:hover ~ a{
            opacity:50%;
        }
        .star a:active ~ a{
            opacity:100%;
        }

    </style>
</head>
<body>
    <div class="container p-5 ">
        <div class="row g-3 shadow-sm">
            <div class="col-12 p-2 text-center bg-dark">
                <h4 class="text-light">Order Status</h4>
            </div>
            <?php
                $result = $backend->orderReceipt();
                    if ($result->num_rows > 0) {
                        foreach ($result as $row) {
                        
            ?>
            <div class="col-md-6"><h5><small class="text-secondary">Order Id#: 2023<?=$row['order_id']?></small></h5></div>
            <div class="col-md-6"><h5><small class="text-secondary">Payment Id#: 2023<?=$row['payTrans_id']?></small></h5></div>
            <div class="col-md-6"><h5><small class="text-secondary">Date: <?=$row['order_datetime']?></small></h5></div>
            <div class="col-md-6"><h5><small class="text-secondary">Order Status: <?=$row['order_status']?></small></h5></div>

            <?php
                    }
                }
            ?>
             <?php
                $result = $backend->orderReceipt();
                    if ($result->num_rows > 0) {
                        foreach ($result as $row) {
                        
            ?>
            <table class="table table-dark table-striped">
                <tr>
                    <th></th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                <tr>
                    <td><img src="./src/Food Menu/<?=$row['food_pic']?>" class="img-thumbnail" style="max-width:100px;"></td>
                    <td><?=$row['food_name']?></td>
                    <td><?=$row['quantity']?></td>
                    <td><?=$row['food_discountedPrice']?></td>
                    <td><?=$row['food_discountedPrice']*$row['quantity']?></td>
                </tr>
                <tr>
                    <td colspan="4"><h3>Total</h3></td>
                    <td><h3>₱<?=$_SESSION['total']?></h3></td>
                </tr>
            </table>
            <div class="col-12 pb-2 text-center">
                <form action="" method="post">
                    <input type="hidden" name="order_id" value="<?=$row['order_id']?>">
                    <button class="btn btn-danger" type="submit" name="cancelbtn" <?=($row['order_status'] == 'Preparing')?'Disabled':''?>>Cancel Order</button>
                    <!-- <button type="submit" name="receivedbtn" class="btn btn-success">Order Received</button> -->
                    <!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Order Received
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Rate</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="activeorders.php" method="post">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="save" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
                </form>
            </div>
        </div>
        <?php
                    if (isset($_POST['cancelbtn'])) {
                        $status = "Cancelled";
                        $order_id = $_POST['order_id'];
                        $backend->orderStatus($status);
                    }
                    if (isset($_POST['save'])) {
                        $status = "Received";
                        $order_id = $_POST['order_id'];
                        $backend->orderStatus($order_id,$status);
                    }//end of received button function
                    }
                }
            ?>
    </div>
</body>
</html>