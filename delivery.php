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
    <title>Delivery</title>
</head>
<body>
    <div class="container bg-body-tertiary p-2 my-3 shadow">
        <div class="row p-2 g-3">
            <div class="col-12 rounded bg-dark text-center">
                <h2 class="text-light">Order Lounge</h2>
            </div>
            <div class="col-12">
                <table class="table text-center table-dark table-striped">
                    <tr>
                        <th>Recepient</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Confirm</th>
                    </tr>
                    <?php
                        $list = $backend->waitingList();
                            if (!is_null($list)) {
                                foreach($list as $row){
                    ?>
                    <tr>
                        <td><?=$row['full_name']?></td>
                        <td><?=$row['street'].', '.$row['barangay'].', '.$row['city'].' City'?></td>
                        <td><i><?=$row['order_status']?></i></td>
                        <td>
                            <form action="confirmation.php" method="post">
                                <input type="hidden" name="buyer" value="<?=$row['full_name']?>">
                                <input type="hidden" name="buyer_id" value="<?=$row['user_id']?>">
                                <input type="hidden" name="trans_id" value="<?=$row['payTrans_id']?>">
                                <input type="hidden" name="address" value="<?=$row['street'].', '.$row['barangay'].', '.$row['city'].' City'?>">
                                <input type="hidden" name="total_payment" value="<?=$row['pay_amount']?>">
                                <input type="hidden" name="received_date" value="<?=$row['received_datetime']?>">
                                <input type="hidden" name="status" value="<?=$row['order_status']?>">
                                <input type="hidden" name="contact" value="<?=$row['contact']?>">
                                <input type="hidden" name="paystats" value="<?=$row['trans_status']?>">
                                
                                <?php
                                    if ($row['order_status'] = 'Received') {
                                        echo "<button type='submit' name='receipt' class='btn btn-outline-light' ><i class='bi bi-receipt'></i></button>";
                                    }
                                    else {
                                        echo "<button type='submit' name='confirm' class='btn btn-success'>On The Way</button>
                                              <button type='submit' name='pickup' class='btn btn-warning'>Picked-up</button>";
                                    }
                                ?>
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