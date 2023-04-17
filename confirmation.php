<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Confirmation</title>
</head>
<body>
<?php
	include 'backend.php';
	$backend = new Backend;

	$backend->checksession();

	if (isset($_POST['receipt'])) {
		$buyer =  $_POST['buyer'];
		$buyer_id = $_POST['buyer_id'];
		$trans_id = $_POST['trans_id'];
		$address = $_POST['address'];
		$total = $_POST['total_payment'];
		$received = $_POST['order_date'];
		$status = $_POST['status'];
		$option = $_POST['option'];
        $paystats = $_POST['paystats'];
        $contact = $_POST['contact'];
		$result = $backend->foodBought($trans_id);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title> Fortami Receipt</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="./Styles/receipt.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	
</head>
<body>
<div class="container">
	<div class="row mb-4">
		<div class="col-md-6">
			<h1>Receipt</h1>
			<p class="font-weight-bold mb-0"><small class="text-secondary">Date:</small> <?=date("M d, Y h:i:s a",strtotime($received))?></p>
			<p class="font-weight-bold mb-0"><small class="text-secondary">Receipt #:</small> 2023<?=$trans_id?> </p>
			<p class="font-weight-bold mb-0"><small class="text-secondary">Delivery Option:</small> <?=$option?> </p>
			<p class="font-weight-bold mb-0"><small class="text-secondary">Order Status:</small> <?=$status?> </p>
			<p class="font-weight-bold"><small class="text-secondary">Payment Status:</small>  <?=$paystats?> </p>
		</div>
		<div class="col-md-6 text-md-right">
			<h2 class="mb-0"><i class="bi bi-person-square"></i> <?=$buyer?></h2>
			<p class="mb-0"><h6><?=$address?></h6></p>
			<p class="mb-0">Contact #: <?=$contact?></p>
			<p class="mb-0">Delivery</p>
		</div>
	</div>
	<hr>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Food</th>
				<th>Qty</th>
				<th>Price</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if (!is_null($result)) {
					foreach ($result as $row) {
			?>
			<tr>
				<td><?=$row['food_name']?></td>
				<td><?=$row['quantity']?></td>
				<td><?=number_format((float)$row['food_discountedPrice'],2,'.',',')?></td>
				<td><?=number_format((float)$row['quantity']*$row['food_discountedPrice'],2,'.',',')?></td>
			</tr>
			<?php
					}
				}
			?>
			<tr>
				<td colspan="3">Total Payment</td>
				<td>₱ <?=$total?></td>
			</tr>
        </tbody>
    </table>
    
            <?php
				if ($status == 'Received') {
					if ($option == 'Delivery') {
						echo "<div class='col-12 bg-success p-3 text-center rounded'>
						    	<h2 class='text-light'>Successfully Delivered</h2>
							  </div>";
					}
					else{
						echo "<div class='col-12 bg-success p-3 text-center rounded'>
						    	<h2 class='text-light'>Successful Pick-up</h2>
							  </div>";
					}
				}
				else {
					echo "<div class='col-12 bg-danger p-3 text-center rounded'>
						    	<h2 class='text-light'>Cancelled</h2>
							  </div>";
				}
			?>

    <div class="col-12 my-2">
		<h4><a href="sales.php"><i class="bi bi-arrow-return-left">Back</i></a></h4>
    </div>

</body>
</html>