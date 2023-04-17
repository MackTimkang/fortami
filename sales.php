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
    <title>Sales</title>
</head>
<body>
    <div class="container bg-body-secondary p-2 my-3 shadow">
        <div class="row p-2 g-3">
            <div class="col-12 rounded bg-dark text-center">
                <h2 class="text-light">Sales History</h2>
            </div>
            <div class="col-12">
                <table class="table text-center table-dark table-striped">
                    <tr>
                        <th>Transaction No.</th>
                        <th>Date</th>
                        <th>Recepient</th>
                        <th>Delivery Option</th>
                        <th>Status</th>
                        <th>Confirm</th>
                    </tr>
                    <?php
                        $list = $backend->saleHistory();
                            if (!is_null($list)) {
                                foreach($list as $row){
                        $date = date("M d, Y h:i:s a",strtotime($row['received_datetime']));
                    ?>
                    <tr>
                        <td>2023<?=$row['payTrans_id']?></td>
                        <td><?=$date?></td>
                        <td><?=$row['full_name']?></td>
                        <td><?=$row['delivery_option']?></td>
                        <td><i><?=$row['order_status']?></i></td>
                        <td>
                            <form action="confirmation.php" method="post">
                                <input type="hidden" name="buyer" value="<?=$row['full_name']?>">
                                <input type="hidden" name="buyer_id" value="<?=$row['user_id']?>">
                                <input type="hidden" name="trans_id" value="<?=$row['payTrans_id']?>">
                                <input type="hidden" name="address" value="<?=$row['street'].', '.$row['barangay'].', '.$row['city'].' City'?>">
                                <input type="hidden" name="total_payment" value="<?=$row['pay_amount']?>">
                                <input type="hidden" name="order_date" value="<?=$row['order_datetime']?>">
                                <input type="hidden" name="status" value="<?=$row['order_status']?>">
                                <input type="hidden" name="option" value="<?=$row['delivery_option']?>">
                                <input type="hidden" name="contact" value="<?=$row['contact']?>">
                                <input type="hidden" name="paystats" value="<?=$row['trans_status']?>">
                                <button type="submit" name="receipt" class="btn btn-outline-light"><i class="bi bi-receipt"></i></button>
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