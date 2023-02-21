<?php
    include('backend.php');
    $backend = new Backend;
    $backend->checksession();
    if(isset($_SESSION['role'])){
        if($_SESSION['role'] = 'Seller'){
            include 'sellerheader.php';
        }
        else{
            
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/product.css">
    <title>Product</title>
</head>
<body>
    <div class="main-cont">
        <div class="btn-cont">  
            <?php
                $backend->listproduct();
            ?>
    </div>
        <br><br>
        
    <div class="result">
    
        <?php
                    //functions
                    //add.php form
            if(isset($_POST['savebtn'])){
                if(isset($_POST['category'])){
                    $catid = $_POST['category'];
                    $pic = $_POST['foodpic'];
                    $fn = $_POST['foodname'];
                    $desc =$_POST['fooddesc'];
                    $dtime = $_POST['creation'];
                    $disc = $_POST['disprice'];
                    $price = $_POST['origprice'];
        
                    $backend->addproduct($catid,$pic,$fn,$desc,$dtime,$disc,$price);
                }
                else {
                    echo "ERROR! Please input category...";
                }
            }
            if(isset($_POST['delbtn'])){
                $food_id = $_POST['food_id'];
                $backend->deleteproduct($food_id);
            }
        ?>
        </div>
    </div>
</body>
</html>