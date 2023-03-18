<?php
    include 'backend.php';
    include 'buyerheader.php';
    $backend = new Backend;
    $list= $backend->listproduct();

    if(isset($_POST['addcart'])){
        $food_id = $_POST['food_id'];
            if (isset($_SESSION['id'])) {
                $user_id = $_SESSION['id'];
                $qty = $_POST['qty'];

            $check = $backend->checkcart($food_id,$user_id);
                if ($check->num_rows>0) {
                    echo "<script>alert('Already in cart!');</script>";
                }
                else {
                    $backend->addtocart($food_id,$user_id,$qty);
                    echo "<meta http-equiv='refresh' content='0'>";
                }
            }
            else {
                echo "<script>alert('Please Login First!');window.location.href='login.php';</script>";
            }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>
<body>
    <div class="container">
        <div class="row py-3">
            <div class="col-2">
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="background-color:black;width:50%;padding:10px 0"><i class="bi bi-funnel-fill"></i>Filter</button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasRightLabel"><i class="bi bi-funnel"></i>Filter</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                        <form action="menu.php" method="post">
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                               <option selected disabled>Food Category</option>
                                <?=$backend->categorylist();?>
                                </select>
                            <hr>
                                <label for="pricerange" class="form-label">Price Range</label>
                                    <input type="number" name="min" class="form-control" placeholder="$ Min">
                                    <input type="number" name="max" class="form-control" placeholder="$ Max">
                            <hr>
                                <label for="ratings" class="form-label">Rating</label>
                                    <br>
                                        <button class="btn btn-outline-dark" type="submit"><i class="bi bi-star-fill"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i></button>
                                        <button class="btn btn-outline-dark" type="submit"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i></button>
                                        <button class="btn btn-outline-dark" type="submit"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i><i class="bi bi-star"></i></button>
                                        <button class="btn btn-outline-dark" type="submit"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i></button>
                                        <button class="btn btn-outline-dark" type="submit"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></button>
                            <hr>
                                        <input class="btn btn-outline-dark" type="submit" value="Search">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-center">
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php
            $list = $backend->getproduct();
            if ($list->num_rows > 0) {
                while($row= $list->fetch_assoc()){
        ?>
        <div class='col'>
                    <div class='card h-100'>
                        <img src='./src/Food Menu/<?=$row['food_pic'];?>' class='card-img-top' alt='...' style='max-width:100%;height:250px'>
                      <div class='card-body'>
                        <h5 class='card-title'><?=$row['food_name'];?></h5>
                        <h6>
                          <small><s class='text-secondary'>₱<?=$row['food_origPrice'];?></s></small>
                          <span class='price'>₱<?=$row['food_discountedPrice'];?></span>
                        </h6>
                        <p class='card-text'><?=$row['food_description']?></p>
                      </div>
                      
                      <div class='card-footer'>
                      <div class ='text-center '>
                        <form action='menu.php' method='post'>
                          <input type="number" name="qty" class="form-control text-center" min="1" placeholder="Quantity" style="width:50%;margin:auto;" required>
                          <button type='submit' name='addcart' class='btn btn-warning my-2'>Add to cart <i class='bi bi-bag-heart'></i></button>
                          <input type='hidden' name='food_id' value='<?=$row['food_id'];?>'>
                          </form>
                        </div>
                        <small class='text-muted'>
                            <?php 
                                if($row['food_creation'] == '0000-00-00 00:00:00'){
                                    echo $row['preparation'];
                                }
                                else {
                                    echo "<small class='text-secondary'>(".$row['preparation'].") ".$row['food_creation']."</small>" ;
                                }
                            ?>
                        </small>
                      </div>
                    </div>
                  </div>
            <?php
                    }
                }
            ?>
        </div>  
    </div>
</body>
</html>