<?php
    include 'backend.php';
    include 'buyerheader.php';
    $backend = new Backend();
    
    if (isset($_GET['shop_id'])) {
        $id = $_GET['shop_id'];

        $result = $backend->usersearch($id);
        $user = mysqli_fetch_assoc($result);
        $address =$backend->sellerAddress($id);
        $add = mysqli_fetch_assoc($address);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Shop</title>
</head>
<body>
<div class="container my-4">
    <form class="d-flex justify-content-center align-items-center" role="search">
        <a class="btn btn-outline-dark" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
            <i class="bi bi-funnel"></i>
        </a>
            <input class="form-control mx-2 w-50" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <!-- FILTER -->
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filter Setting</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <form action="">
                                <h6>Select filters below:</h6><br>
                                <input type="hidden" name="shop_id" value="<?=$id?>">
                                <select class="form-select" name="food_category" >
                                    <option selected Disabled>Food Category</option>
                                    <option value="any">Any</option>
                                    <?=$backend->categorylist()?>
                                </select>
                                <select class="form-select my-2" name="rating">
                                    <option selected Disabled>Ratings</option>
                                    <option value="any">Any</option>
                                    <option value="1">1 Star</option>
                                    <option value="2">2 Star</option>
                                    <option value="3">3 Star</option>
                                    <option value="4">4 Star</option>
                                    <option value="5">5 Star</option>
                                </select>
                                <select class="form-select my-2" name="location">
                                    <option selected Disabled>Location</option>
                                    <option value="Cebu">Cebu City</option>
                                    <option value="Mandaue">Mandaue City</option>
                                    <option value="Talisay">Talisay City</option>
                                    <option value="Lapulapu">Lapulapu City</option>
                                    <option value="Other">Other</option>
                                </select>
                                <select class="form-select my-2" name="price">
                                    <option selected Disabled>₱rice Range</option>
                                    <option value="any">Any</option>
                                    <option value="250">₱ 0 - 250</option>
                                    <option value="500">₱ 250 - 500</option>
                                    <option value="750">₱ 500 - 750</option>
                                    <option value="1000">₱750 - 1000</option>
                                    <option value="1000+">₱1,000+</option>
                                </select>
                                <select class="form-select my-2" name="preparation">
                                    <option selected Disabled>Food Preparation</option>
                                    <option value="any">Any</option>
                                    <option value="fresh">Fresh</option>
                                    <option value="surplus">Surplus</option>
                                    <option value="madetoorder">Made to order</option>
                                </select>
                                <select class="form-select my-2" name="delivery">
                                    <option selected Disabled>Delivery Option</option>
                                    <option value="any">Any</option>
                                    <option value="pickup">Pick-up</option>
                                    <option value="deliver">Deliver</option>
                                </select>
                            <input type="submit" class="btn btn-warning form-control" name="filterbtn" value="Apply">
                        </form>
                    </div>
                </div>
    <!--END OF FILTER-->
    <h3 class="p-2 bg-warning rounded text-center shadow my-4"><i class="bi bi-shop"> <?=$user['user_userName']?></i></h6>
    <h6><small class="text-secondary">Address:</small><i> <?=$add['street'].''.$add['barangay'].''.$add['city']?></i></h6>
    <h6><small class="text-secondary">Contact #:</small> <i><?=$add['contact']?></i></h5>
    <hr>
    <div class="row row-cols-1 row-cols-md-4 g-4 p-2 text-center">
        <?php
            if (isset($_GET['shop_id'])) {
                $id = $_GET['shop_id'];
                if (isset($_GET['filterbtn'])) {
                    if (isset($_GET['food_category']) && isset($_GET['rating']) && isset($_GET['location']) && isset($_GET['price']) && isset($_GET['preparation']) && isset($_GET['delivery']) && isset($_GET['shop_id'])) {
                        $query = "SELECT * FROM food_product WHERE user_id = $id AND food_category";
                    }
                    else {
                        echo "Please fill all filter";
                        $list = $backend->viewProduct($id);
                    }
                }
                else {
                    $list = $backend->viewProduct($id);
                }
                    if ($list->num_rows > 0) {
                        while($row= $list->fetch_assoc()){
        ?>
        <div class='col'>
                    <div class='card h-100'>
                        <img src='./src/uploads/food_picture/<?=$row['food_pic'];?>' class='card-img-top' alt='...' style='max-width:100%;height:250px'>
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
                        <form action='' method='post'>
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
                }
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
        </div>  
    </div>
</body>
</html>