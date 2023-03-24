<?php
    include 'backend.php';
    include 'sellerheader.php';

    $backend = new Backend;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
</head>
<body>
    <div class="container p-5">
        <div class="row g-3">
            <div class="col-12 text-center bg-dark rounded shadow">
                <h2 class="text-light">
                    <i class="bi bi-card-list"> 
                        Incoming Orders
                    </i>
                </h2>
            </div>
            <div class="col-12">
                <table class="table table-dark text-center table-striped">
                    <tr>
                        <th>Recepient</th>
                        <th>Address</th>
                        <th>Option</th>
                        <th>Details</th>
                    </tr>
                    <?php
                        $result = $backend->sellerOrders();
                            if (!is_null($result)) {
                                foreach ($result as $order) {
                    ?>
                    <tr>
                        <td><?=$order['full_name']?></td>
                        <td><?=$order['street'].', '.$order['barangay'].', '.$order['city'].' City'?></td>
                        <td>Delivery</td>
                        <td class="w-25">
                            <form action="order-details.php" method="post">
                                <input type="hidden" name="address" value="<?=$order['street'].', '.$order['barangay'].', '.$order['city'].' City'?>">
                                <input type="hidden" name="trans_id" value="<?=$order['payTrans_id']?>">
                                <input type="hidden" name="buyer" value="<?=$order['full_name']?>">
                                <input type="hidden" name="total" value="<?=$order['pay_amount']?>">
                                <button type="submit" name="decline" class="btn btn-danger">Decline</button>
                                <button type="submit" name="accept" class="btn btn-success">Accept</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                </table>
            </div>
        
        </div>
    </div>
</body>
</html>