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
    <title>Transactions</title>
</head>
<body>
    <div class="container">
        <div class="row g-3 p-5">
            <div class="col bg-dark text-center p-2"><h2 class="text-light"><i class="bi bi-clock-history"></i> Transaction History</h2></div>
            <div class="col-12">
                <table class="table table-striped">
                    <tr>
                        <th>Transaction Id</th>
                        <th>Shop</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Received Date</th>
                        <th>Receipt</th>
                    </tr>
                    <?php
                        $result = $backend->viewHistory();
                            if (!is_null($result)) {
                                if ($result->num_rows > 0) {
                                    foreach ($result as $row) {
                    ?>
                    <tr>
                        <td>2023<?=$row['payTrans_id']?></td>
                        <td><?=$row['user_userName']?></td>
                        <td>N/A</td>
                        <td><?=$row['order_status']?></td>
                        <td><?=$row['received_datetime']?></td>
                        <td>
                            <form action="receipt.php" method="post">
                                <input type="hidden" name="trans_id" value="<?=$row['payTrans_id']?>">
                                <input type="hidden" name="shop" value="<?=$row['user_userName']?>">
                                <input type="hidden" name="shop_id" value="<?=$row['user_id']?>">
                                <input type="hidden" name="date" value="<?=$row['received_datetime']?>">
                                <input type="hidden" name="status" value="<?=$row['order_status']?>">
                                <input type="hidden" name="total" value="<?=$row['pay_amount']?>">
                                <input type="hidden" name="paystats" value="<?=$row['trans_status']?>">
                                <input type="hidden" name="method" value="<?=$row['paymethod_type']?>">
                                <button type="submit" name="receiptbtn" class="btn btn-outline-dark text-center"><i class="bi bi-receipt"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>