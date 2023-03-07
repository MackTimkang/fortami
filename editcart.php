<?php
include 'backend.php';
$backend = new Backend;

    if(isset($_GET['id'])){
        $food = $_GET['id'];
        $user = $_SESSION['id'];

        if (isset($_POST['saveqty'])) {
            $qty = $POST['qty'];
            $backend->editcart($food,$user,$qty);
            header('location:cart.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quantity</title>
</head>
<body>
    
</body>
</html>