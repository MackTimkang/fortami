<?php
    include 'backend.php';
    
    if (isset( $_SESSION['role'])) {
        if ($_SESSION['role'] == 'Seller') {
            include 'sellerheader.php';
        }
        else {
            include 'buyerheader.php';
        }
    }
    else {
        echo "<script>alert('Please Login First!');
        window.location.href = 'login.php';
        </script>";
    }
    $backend = new Backend;
    $list = $backend->usersearch($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center">
        <div class="row g-3 p-5 w-50 text-center">
            <?php   
                if ($list->num_rows > 0) {
                    foreach($list as $row){
            ?>
            <div class="col-12">
            <img src="./src/userlogoblue.png" class="rounded mx-auto d-block" alt="...">
            </div>
            <div class="col-12">
                <h3><?=$row['user_type'];?></h3>
            </div>
            <div class="col-12">
                <h3><?=$row['user_fName']." ".$row['user_lName'];?></h3>
            </div>
            <div class="col-12">
                <h3><?=$row['user_userName'];?></h3>
            </div>
            
            <?php
                }
            }
            ?>
        </div>
    </div>
</body>
</html>