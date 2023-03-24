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
</head>
<body>
    <div class="container  p-5">
        <div class="row shadow g-3">
            <div class="col-12 p-2 bg-dark">
                <h2 class="text-light text-center">Ongoing Orders</h2>
            </div>
            <div class="col-12  text-end">
                <a href="transactions.php" style="text-decoration:none;"><i class="bi bi-clock-history"></i> History</a>
            </div>
                <table class="table  table-striped">
                    <tr>
                        <th>Shop</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    <?php
                        $result = $backend->activeOrders();
                            if (!is_null($result)) {
                                if ($result->num_rows > 0) {
                                    foreach ($result as $row){
                    ?>

                        <tr>
                            <td style="font-weight:bold;font-style:italic;"><?=$row['user_userName']?></td>
                            <td><?=$row['pay_amount']?></td>
                            <td><?=$row['order_status']?></td>
                            <td>
                                <form class="text-center" action="" method="post">
                                    <input type="hidden" name="trans" value="<?=$row['payTrans_id']?>">
                                    <button type="submit" name="cancelbtn" class="btn btn-danger" <?=($row['order_status'] == 'Preparing')? 'disabled':''?>>Cancel</button>
                                    <button type="submit" name="rcvbtn" class="btn btn-success">Received</button>
                                </form>
                            </td>
                        </tr>

                    
            
                <?php
                        }
                    }
                }
                else {
                    echo "<h1 class='text-center'><i class='bi bi-bag-x'></i><br>No Orders Yet!</h1>";
                }
                ?>
                </table>
            </div>  
        </div>
    </div>
    <?php
        if (isset($_POST['rcvbtn'])) {
            $time = date("Y-m-d H:i:s");
            $trans= $_POST['trans'];
            $status = 'Received';
            $backend->orderStatus($trans,$status);
            $backend->receivedTime($time,$trans);
        }
        else {
            
        }
    ?>
</body>
</html>