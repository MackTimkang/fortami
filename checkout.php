<?php
    include 'backend.php';
    $backend = new Backend;
    $result= $backend->total();
    $total = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">    
</head>
<body>
    <div class="container-fluid">
        <div class="row" style="gap:20px;padding: 10px;">
            <?php
                $user_id = $_SESSION['id'];
                $list = $backend->address($user_id);
                $row = mysqli_fetch_assoc($list);
            ?>
                <div class="col">
                    <div class="row g-3 p-5 ">
                        <div class="col-12 text-center">
                            <h1><i class="bi bi-person-fill-up"></i> Delivery Address</h1>
                        </div>
                        <div class="col-md-6">
                            <label for="fname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="fullname" value="<?=$row['user_fName'].' '.$row['user_lName'];?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" name="telnum" required>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="ad" placeholder="street, apartment, studio or floor" required>
                        </div>
                        <div class="col-md-4">
                            <label for="region" class="form-label">Region</label>
                            <input type="text" class="form-control" name="region" required>
                        </div>
                        <div class="col-md-4">
                            <label for="province" class="form-label">Province</label>
                            <input type="text" class="form-control" name="province" required>
                        </div>
                        <div class="col-md-4">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" name="city" required>
                        </div>
                        <div class="col-md-4">
                            <label for="brgy" class="form-label">Barangay</label>
                            <input type="text" class="form-control" name="brgy" required>
                        </div>
                        <div class="col-md-4">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="number" class="form-control" name="zip" required>
                        </div>
                        <div class="col-12">
                            <label for="label" class="form-label">Label Address as: </label>
                                <input class="form-check-input" type="radio" name="label" value="Home" id="flexRadioDefault1"checked>
                                <label class="form-check-label" for="flexRadioDefault1" >
                                    Home
                                </label>
                                <input class="form-check-input" type="radio" value="Work" name="label" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Work
                            </label>
                        </div>
                        <div class="col-12">
                        <label for="type" class="form-label">Save as: </label>
                                <input class="form-check-input" type="radio" name="address_type" value="Default" id="flexRadioDefault1"checked>
                                <label class="form-check-label" for="flexRadioDefault1" >
                                    Default
                                </label>
                                <input class="form-check-input" type="radio" name="address_type" id="flexRadioDefault2" disabled >
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Pick-up address
                                </label>
                        </div>
                    </div>
                    
                </div>
                <div class="col " style="background-color: whitesmoke;">
                    <h4 class="text-primary p-1">Your Order</h4>
                    <table class="table table-dark table-striped ">
                        
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                        </tr>
                        <?php
                            $list = $backend->getcart();
                                if ($list->num_rows > 0) {
                                    foreach ($list as $row) {
                        ?>
                        <tr>
                            <td><?=$row['food_name']?></td>
                            <td class="text-center"><?=$row['quantity']?></td>
                            <td class="text-center"><?=$row['food_discountedPrice']?></td>
                            <td class="text-center"><?=$row['food_discountedPrice']*$row['quantity']?></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                        <tr >
                            <td class="text-warning">Total Payment: </td>
                            <td></td>
                            <td></td>
                            <td class="text-warning text-center">₱ <?=number_format((float)$total['total'], 2, '.', ',')?></td>
                        </tr>
                    </table>
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Credit Card
                            <img src="./src/creditcard.png" class="img-fluid" alt="creditcard" style="max-width:30%;">
                        </label>
                        </div>
                        <br><br>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Paypal
                            <img src="./src/paypal.png" class="img-fluid" alt="paypal" style="max-width:20%; height:auto;">
                        </label>
                        
                    </div>
                        <br>
                        <div class="col-12 p-2" style="text-align:center;">
                            <button type="submit" class="btn btn-primary">Check out</button>
                            <a class="btn btn-secondary" href="index.php" style="background-color:red;">Cancel</a>
                        </div>
                </div>
            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>