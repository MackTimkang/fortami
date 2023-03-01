<?php
    include 'backend.php';
    include 'buyerheader.php';
    $backend = new Backend;
    $list= $backend->listproduct();

    if(isset($_POST['addcart'])){
        $food_id = $_POST['food_id'];
        $user_id = $_SESSION['id'];

        $check = $backend->checkcart($food_id,$user_id);
        if ($check->num_rows>0) {
            echo "<script>alert('Already in cart!');</script>";
        }
        else {
            $backend->addtocart($food_id,$user_id);
            echo "<meta http-equiv='refresh' content='0'>";
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
                $result = $backend->getproduct();
                    while($row=$result->fetch_assoc()){
                        $backend->component($row['food_id'],$row['food_pic'],$row['food_name'],$row['food_description'],$row['food_discountedPrice'],$row['food_origPrice'],$row['food_creation']);
                    }
            ?>
        </div>  
    </div>
</body>
</html>