<?php
    include 'backend.php';
    $backend = new Backend;
    $report  = new Report;
    $backend->checksession();
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'Buyer') {
            include 'buyerheader.php';
        }elseif ($_SESSION['role'] == 'Seller') {
            include 'sellerheader.php';
        }elseif($_SESSION['role'] == 'Admin'){
            include 'admin-header.php';
        }
    }

    if (isset($_POST['subbtn'])) {
        $issue = $_POST['issue'];
        $trans = $_POST['trans_id'];
        $shopName =$_POST['shop'];
        $shopId = $_POST['shop_id'];
        $date = $_POST['date'];
        $order = $_POST['order'];
    }
    else{
        $issue = "";
        $trans = "";
        $shopName ="";
        $shopId = "";
        $date = "";
        $order = "";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Support</title>
</head>
<body>
    <div class="container">
        <div class="row rounded shadow g-3 p-2">
            <div class="col-12 bg-danger bg-gradient text-light rounded p-2">
                <h2><i class="bi bi-flag"> Report</i></h2>
            </div>
            <div class="col-12">
                <form action="" method="post">
                    <input type="hidden" name="order" value=<?=$order?>>
                    <input type="hidden" name="trans" value=<?=$trans?>>
                    <input type="hidden" name="sub" value="<?=$issue?>">
                    <label for="shopname" class="form-label">Shop</label>
                    <input type="text" class="form-control mb-1" value="<?=$shopName?>" disabled>
                    <label for="shopname" class="form-label">Date</label>
                    <input type="text" class="form-control mb-1" value="<?=$date?>" disabled>
                    <label for="subject" class="form-label">Issue</label>
                    <input type="text" class="form-control mb-2" name="subject" value="<?=$issue?>" disabled>
                    <label for="description" class="form-label">Description <small class="text-secondary"><i>(Please specify your concern)</i></small></label>
                    <textarea type="text" class="form-control mb-3" name="issuedesc" placeholder="Please describe your issue here..." required></textarea>
                    <button type="submit" name="reportbtn" value="1" class="btn btn-warning">Report</button>
                    <a href="transactions.php" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <?php
        if (isset($_POST['reportbtn'])) {
           $trans = $_POST['trans'];
           $order = $_POST['order'];
           $subject = $_POST['sub'];
           $desc = $_POST['issuedesc'];

           $report->reportTrans($order,$trans,$subject,$desc);
        }
    ?>
</body>
</html>