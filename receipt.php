<?php
	include 'backend.php';
	$backend = new Backend;

	$backend->checksession();

	if (isset($_POST['receiptbtn'])) {
		$shopname =  $_POST['shop'];
		$trans = $_POST['trans_id'];
		$shopID = $_POST['shop_id'];
		$date = $_POST['date'];
		$status = $_POST['status'];
		$total = $_POST['total'];
		$paystats = $_POST['paystats'];
		$method = $_POST['method'];

		$shopAddress = $backend->sellerAddress($shopID);
		$address = mysqli_fetch_assoc($shopAddress);

		$result = $backend->foodBought($trans);
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
			<p class="font-weight-bold mb-0">Date: <?=$date?> </p>
			<p class="font-weight-bold mb-0">Receipt #:2023<?=$trans?> </p>
			<p class="font-weight-bold mb-0">Order Status: <?=$status?> </p>
			<p class="font-weight-bold">Payment Status: <?=$paystats?> </p>
		</div>
		<div class="col-md-6 text-md-right">
			<h2 class="mb-0"><i class="bi bi-shop"></i> <?=$shopname?></h2>
			<p class="mb-0"><?=$address['street']?></p>
			<p class="mb-0"><?=$address['barangay'].', '.$address['city'].' City, '.$address['zip'];?></p>
			<p class="mb-0">Contact #: <?=$address['contact']?></p>
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
			<tr>
			<td colspan="3">Payment Method</td>
			<td><?=$method?></td>
			</tr>
			
