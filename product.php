<?php
include 'backend.php';
include 'sellerheader.php';
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>
<body>
    <?php
        $backend = new Backend;
        $list = $backend->listproduct();
    ?>
    <div class="container-fluid p-5" >
        <table class="table table-dark table-striped text-center">
            <tr>
                <th>Photo</th>
                <th>Category</th>
                <th>Food</th>
                <th>Description</th>
                <th>Preparation</th>
                <th>Date Prepared</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php
                foreach($list as $data){
            ?>
            <tr>
                <td><img src="./src/Food Menu/<?=$data['food_pic']?>" class="img-fluid" alt="Food Image" style="max-width:100px"></td>
                <td><?=$data['category_name']?></td>
                <td><?=$data['food_name']?></td>
                <td><?=$data['food_description']?></td>
                <td><?=$data['preparation']?></td>
                <td><?php 
                        if($data['food_creation'] == '0000-00-00 00:00:00'){
                            echo "-";
                        }
                        else {
                            echo $data['food_creation'];
                        }
                    ?>
                </td>
                <td><?="<small><s class='text-secondary'>".$data['food_origPrice']."</s></small>"." ".$data['food_discountedPrice'];?></td>
                <td>
                    <div class="row d-flex align-items-center justify-content-center" >
                        <div class="col-4">
                        <a class="btn btn-primary" href="./edit.php?id=<?=$data['food_id']?>">Edit</a>
                        </div>
                        <div class="col-4">
                            <form action="" method="post">
                                <input type="hidden" name="food_id" value="<?=$data['food_id']?>">
                                <input type="submit" value="Delete" name="delbtn" class="btn btn-secondary">
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
                }
                if (isset($_POST['delbtn'])) {
                    $food_id = $_POST['food_id'];
                    $backend->deleteproduct($food_id);
                }
                if (isset($_POST['savebtn'])) {
                    $catid =$_POST['category'];
                    $pic=$_POST['foodpic'];
                    $foodname=$_POST['foodname'];
                    $desc=$_POST['fooddesc'];
                    $prep = $_POST['prep'];
                    $time=$_POST['creation'];
                    $discount=$_POST['disprice'];
                    $price=$_POST['origprice'];

                    $backend->addproduct($catid,$pic,$foodname,$desc,$prep,$time,$discount,$price);
                }
            ?>
            <tr>
                <td><a class="btn btn-primary" href="./add.php" >Add Product</a></td>
            </tr>
        </table>
    </div>
</body>
</html>