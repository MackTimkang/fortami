<?php
    include 'backend.php';
    $backend = new Backend;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">    
    <title>Receipt</title>
</head>
<body>
    <div class="container w-50 ">
        <div class="row g-3 p-5 bg-light ">
            <div class="col-12 p-2 text-center bg-dark ">
                <h4 class="text-light">Thank you for your purchase!</h4>
            </div>
            <div class="col-12">
                <h6 class="text-secondary">
                    Your order has been placed and is being prepared. Your payment and order details are shown below for your reference:
                </h6>
            </div>
            <div class="col-12">
                <table class="table table-light">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                        <?php
                            $list = $backend->transaction();
                            $user_id = $_SESSION['id'];
                            $result = $backend->paymentTotal($user_id);
                            $total = mysqli_fetch_assoc($result);
                            
                            

                                if ($list->num_rows > 0) {
                                    foreach ($list as $row) {
                                $subtotal = $row['food_discountedPrice']*$row['quantity'];
                                $address = $row['address_id'];
                                $method = $row['paymethod_type'];
                                $trans_id = $row['payTrans_id'];
                        ?>
                        <tr>
                            <td><?=$row['food_name']?></td>
                            <td><?=$row['food_discountedPrice']?></td>
                            <td><?=$row['quantity']?></td>
                            <td><?=$subtotal?></td>
                        </tr>
                        <?php
                            }
                        }        
                        ?>
                        <tr>
                            <td><h5 >Total</h5></td>
                            <td></td>
                            <td></td>
                            <td><h5 >₱ <?=number_format((float)$total['total'],'2','.',',')?> </h5></td>
                        </tr>
                </table>
                <?php
                    $res = $backend->searchaddress($address);
                    $data = mysqli_fetch_assoc($res);

                ?>
            </div>
            <div class="col-6"><h4 class="text-success"><small class="text-secondary"><i>Receipt #:</i></small> fortami<?=$trans_id?> </h4> </div>
            <div class="col-6"><h4 class="text-success"><small class="text-secondary"><i>Status: </i></small>Payment Successful </h4> </div>
            <div class="col-12">
                <h6 class="text-secondary">Note:</h6>
            </div>
            <div class="col-12">
                <h5><i>Customer Details</i></h5>
            </div>
            <div class="col-12">
                <h6 ><small class="text-secondary"><i>Name:</i> </small>  <?=$data['full_name']?></h6>
            </div>
            <div class="col-12">
                <h6 ><small class="text-secondary"><i>Address:</i></small>   <?='<br>'.$data['label'].'<br>'.$data['street'].', '.$data['barangay'].', '.$data['city']
                .', '.$data['province'].',Philippines, '.$data['zip']?> </h6>
            </div>
            <div class="col-12">
                <h6 ><small class="text-secondary"><i>Payment Method:</i></small> <?=$method?></h6>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>