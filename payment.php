<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row" style="gap:20px;padding: 10px;">
                <div class="col" style="padding:20px 0;">
                    <label for="billing">Billing Details</label>
                    <br><br>
                    <form class="row g-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Email</label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="Street, Barangay">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Address 2</label>
                            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">City</label>
                            <input type="text" class="form-control" id="inputCity">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">State</label>
                            <select id="inputState" class="form-select">
                            <option selected>Choose...</option>
                            <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputZip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="inputZip">
                        </div>
                        
                    
                </div>
                <div class="col" style="background-color: whitesmoke;">
                    <label for="Order">Your Order</label>
                    <table class="table table-dark table-striped">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <td>Burger</td>
                            <td>1</td>
                            <td>$100</td>
                            <td>$100</td>
                        </tr>
                        <tr>
                            <td>Milktea</td>
                            <td>2</td>
                            <td>$100</td>
                            <td>$200</td>
                        </tr>
                        <tr>
                            <td>Halo-halo</td>
                            <td>3</td>
                            <td>$300</td>
                            <td>$900</td>
                        </tr>
                        <tr>
                            <td>Subtotal</td>
                            <td></td>
                            <td></td>
                            <td>$1200</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td></td>
                            <td></td>
                            <td>$1200</td>
                        </tr>
                    </table>
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Credit Card
                            <img src="./src/creditcard.png" class="img-fluid" alt="creditcard" style="max-width:30%;">
                        </label>
                        </div>
                        <br><br>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Paypal
                            <img src="./src/paypal.png" class="img-fluid" alt="paypal" style="max-width:20%; height:auto;">
                        </label>
                        
                    </div>
                        <br>
                        <div class="col-12" style="text-align:center;">
                            <button type="submit" class="btn btn-primary">Check out</button>
                            <a class="btn btn-secondary" href="index.php" style="background-color:red;">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>