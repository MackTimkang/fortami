<?php
	include 'backend.php';
	$backend = new Backend;

	$backend->checksession();

	if (isset($_POST['receiptbtn'])) {
		$shopname =  $_POST['shop'];
		$trans = $_POST['trans_id'];
		$shopID = $_POST['shop_id'];
		$datetime = $_POST['date'];
		$date = date("M d, Y h:i a",strtotime($datetime));
		$option = $_POST['delivery'];
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
				<p class="font-weight-bold mb-0"><small class="text-secondary">Date:</small>  <?=$date?> </p>
				<p class="font-weight-bold mb-0"><small class="text-secondary">Receipt #:</small> 2023<?=$trans?> </p>
				<p class="font-weight-bold mb-0"><small class="text-secondary">Delivery Option:</small> <?=$option?> </p>
				<p class="font-weight-bold mb-0"><small class="text-secondary">Order Status:</small> <?=$status?> </p>
				<p class="font-weight-bold"><small class="text-secondary">Payment Status:</small> <?=$paystats?> </p>
			</div>
			<div class="col-md-6 text-md-right">
				<h2 class="mb-0"><i class="bi bi-shop"></i> <?=$shopname?></h2>
				<p class="mb-0"><?=$address['street']?></p>
				<p class="mb-0"><?=$address['barangay'].', '.$address['city'].' City, '.$address['zip'];?></p>
				<p class="mb-0">Contact #: <?=$address['contact']?></p>
			</div>
		</div>
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
		<br>
			<h4><a href="checkout.php?trans_id=<?=$trans?>" class="text-center"><i class="bi bi-repeat"> Order Again</i> </a></h4>
		<h4><a href="transactions.php"><i class="bi bi-arrow-return-left">Back</i></a></h4>
	</div>
</body>
</html>

			
