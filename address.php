<?php
include 'backend.php';
$backend = new Backend;

    if (isset($_POST['regbtn'])) {
        $id = $_SESSION['id'];
        $name = $_POST['fullname'];
        $type = $_POST['address_type'];
        $con = $_POST['telnum'];
        $reg = $_POST['region'];
        $province = $_POST['province'];
        $city = $_POST['city'];
        $brgy = $_POST['brgy'];
        $street = $_POST['street'];
        $zip = $_POST['zip'];
        $note = $_POST['note'];
        $label = $_POST['label'];

        $backend->createAddress($id,$name,$type,$con,$reg,$province,$city,$brgy,$street,$zip,$note,$label);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">    
    <title>Register</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center">
        <form action="" method="post">
        <div class="row g-3 p-5 ">
            <div class="col-12 text-center">
                <h1><i class="bi bi-person-fill-up"></i> Delivery Address</h1>
            </div>
            <div class="col-md-6">
                <label for="fname" class="form-label" value="">Full Name</label>
                <input type="text" class="form-control" name="fullname" required>
            </div>
            <div class="col-md-6">
                <label for="contact" class="form-label">Contact Number</label>
                <input type="tel" class="form-control" name="telnum" required>
            </div>
            <div class="col-12">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="street" placeholder="street, apartment, studio or floor" required>
            </div>
            <div class="col-md-4">
                <label for="region" class="form-label">Region</label>
                <input type="text" class="form-control" name="region" required>
            </div>
            <div class="col-md-4">
                <label for="province" class="form-label">Province</label>
                <input type="text" class="form-control" name="province" required>
            </div>
            <div class="col-md-4">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" name="city" required>
            </div>
            <div class="col-md-4">
                <label for="brgy" class="form-label">Barangay</label>
                <input type="text" class="form-control" name="brgy" required>
            </div>
            <div class="col-md-4">
                <label for="zip" class="form-label">Zip</label>
                <input type="number" class="form-control" name="zip" required>
            </div>
            <div class="col-12">
                <label for="note" class="form-label">Note <small class="text-secondary"><i>(Optional)</i> </small></label>
                <input type="text" class="form-control" name="note">
            </div>
            <div class="col-12">
                <label for="label" class="form-label">Label Address as: </label>
                    <input class="form-check-input" type="radio" name="label" value="Home" id="flexRadioDefault1"checked>
                    <label class="form-check-label" for="flexRadioDefault1" >
                        Home
                    </label>
                    <input class="form-check-input" type="radio" value="Work" name="label" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Work
                </label>
            </div>
            <div class="col-12">
            <label for="type" class="form-label">Save as: </label>
                    <input class="form-check-input" type="radio" name="address_type" value="Default" id="flexRadioDefault1"checked>
                    <label class="form-check-label" for="flexRadioDefault1" >
                        Default
                    </label>
                    <input class="form-check-input" type="radio" name="address_type" id="flexRadioDefault2" disabled >
                    <label class="form-check-label" for="flexRadioDefault2">
                        Pick-up address
                    </label>
            </div>
            <div class="col-12 my-5 text-center">
                <button type="submit" name="regbtn" class="btn btn-primary">Save Address</button>
                <a class="btn btn-secondary" href="index.php" style="background-color:red;border:none">Cancel</a>
            </div>
        </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>