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
     
     if (isset($_POST['viewbtn'])) {
        $sendId = $_POST['senderId'];
        $id = $_POST['reportId'];
        $sender = $_POST['sender'];
        $issue = $_POST['issue'];
        $desc = $_POST['description'];
     }
     else {
        $id = "";
        $sender = "";
        $issue = "";
        $desc = "";
     }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
</head>
<body>
    <div class="container">
        <div class="row g-3 p-2">
            <div class="col-12 bg-danger text-light bg-gradient rounded shadow p-2">
                <h2><i class="bi bi-flag-fill"> Reports</i></h2>
            </div>
            <div class="col-12">
                <form action="" method="post">
                    <input type="hidden" name="sender" value="<?=$sendId?>">
                    <input type="hidden" name="id" value=<?=$id?>>
                    <label for="id" class="form-label">Report Id</label>
                    <input type="text" name="idsender" class="form-control mb-1" value="<?=$id?>" disabled>
                    <label for="shopname" class="form-label">Sender</label>
                    <input type="text" class="form-control mb-1" value="<?=$sender?>" disabled>
                    <label for="subject" class="form-label">Issue</label>
                    <input type="text" class="form-control mb-2" name="subject" value="<?=$issue?>" disabled>
                    <label for="description" class="form-label">Description <small class="text-secondary"><i>(Please specify your concern)</i></small></label>
                    <textarea type="text" class="form-control mb-3" name="issuedesc" placeholder="Please describe your issue here..." disabled><?=$desc?></textarea>
                    <button type="submit" name="subbtn" value="1" class="btn btn-success">Solved</button>
                    <a href="report-list.php" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <?php
        if (isset($_POST['subbtn'])) {
           $report_id = $_POST['id'];
           $sender = $_POST['sender'];
           $notify = new Notification;
           $notify->newUserNotif($sender,"Your report with an ID of $report_id has been solved by the admin, thank you for your patience",'Unread');
        }
    ?>
</body>
</html>