<?php
    include 'backend.php';
    include 'buyerheader.php';
    $backend = new Backend;
    if (isset($_POST['delete'])) {
    
    }
    $sum = $backend->total();
        foreach($sum as $row){
            $total = $row['sum'];
            $_SESSION['total'] = $total;
        }
    //quantity
    $qty = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <div class="container-fluid p-2 ">
        <div class="text-secondary text-center">
            <h1>
                <i class="bi bi-cart-fill"></i>Cart
            </h1>
            <?php
                $list = $backend->getcart();
                    while($row = $list->fetch_assoc()){
            ?>
            <form method="post">
        </div>
            <div class="card mb-1 w-100  text-center">
                    <div class="card-header">
                    </div>
                <div class="row row-cols-1 row-cols-md-1 g-1 d-flex align-items-center">
                    <div class="col-md-2 text-center">
                        <img src="./src/Food Menu/<?=$row['food_pic'];?>" class="img-fluid rounded-start" alt="..." style="max-width:50%; height:auto">
                    </div>
                    <div class="col-md-2">
                        <div class="card-body ">
                            <p class="card-text">
                                <h4 class="card-title"><?=$row['food_name'];?></h4>
                            </p>
                            
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card-body">
                            <p class="card-text" style="display: -webkit-box;
                                -webkit-box-orient: vertical;
                                -webkit-line-clamp: 3;
                                overflow: hidden;">
                                <?=$row['food_description'];?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card-body text-center">
                            <p class="card-text">
                                <h4>
                                    <small>
                                        <s class="text-secondary mx-2">
                                        ₱<?=$row['food_origPrice'];?>
                                        </s>
                                    </small>
                                    ₱<?=$row['food_discountedPrice'];?>
                                </h4>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card-body">
                            <p class="card-text">
                                <div class="input-group mb-2">
                                    <button class="btn btn-dark" type="submit" name="minus"><i class="bi bi-dash-lg"></i></button>
                                    <input type="text" class="form-control text-center" placeholder="Qty" aria-label="Quantity" name="qty" value="<?=$qty;?>">
                                    <button class="btn btn-dark" type="submit" name="add"><i class="bi bi-plus-lg"></i></button>
                                </div>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card-body">
                            <p class="card-text text-center">
                                    <input type="hidden" name="cart_id" value="<?=$row['food_id'],$_SESSION['id'];?>">
                                    <button class="btn btn-danger" type="submit" name="delete"><i class="bi bi-trash3"></i></button>
                            </p>
                        </div>
                    </div>
                </div>
            </form> 
        <?php
            }
        ?>
        </div>

        <div class="card mb-1 w-100  text-center">
            <div class="row row-cols-1 row-cols-md-1 g-1 d-flex align-items-center">
            <div class="col-md-2">
                    <div class="card-body">
                        <p class="card-text" >
                            <h3></h3>
                        </p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card-body">
                        <p class="card-text" >
                            <h3></h3>
                        </p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card-body">
                        <p class="card-text" >
                            <h3>Subtotal: </h3>
                        </p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card-body">
                        <p class="card-text" >
                            <small clas="text-secondary">
                            <h3>
                                <?php
                                    echo "₱".number_format((float)$_SESSION['total'], 2, '.', '');
                                ?>
                            </h3>
                            </small>
                        </p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card-body">
                        <p class="card-text" >
                            <a href="" class="btn btn-dark" style="max-width:100%;height:auto"><i class="bi bi-bag-check"></i> Checkout</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card-body">
                        <p class="card-text" >
                        <a href="" class="btn btn-danger" style="max-width:100%;height:auto"><i class="bi bi-bag-x"></i> Clear Cart</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>