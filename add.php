<?php
    include 'backend.php';
    $backend = new Backend;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="shortcut icon" type="image" href="./src/FortamiLogo.png">
    <title>Add</title>
</head>
<body>
<div class="container-fluid" style="padding:30px;">
    <form class="row g-3"style="padding:30px;" action="product.php" method="post">
        <h1><i class="bi bi-egg-fried"></i> Add Food Listing</h1>
        <div class="input-group">
            <label class="input-group-text" for="inputGroupFile01">Upload Food Image</label>
            <input type="file" class="form-control" id="inputGroupFile01" name="foodpic" required>
        </div>
        <div class="input-group">
            <select class="form-select" aria-label="Default select example" name="category" required>
                <option selected>Select Food Category</option>
                <?php $backend->categorylist();?>
            </select>
        </div>
        <div class="col-md-6" >
                <label for="food name" class="form-label">Food Name</label>
                <input type="text" class="form-control" id="foodname" name="foodname" required>
        </div>
        <div class="col-md-6">
            <label for="form-label">Food Details</label>
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="fooddesc" required>
                
            </textarea>
        </div>
        <div class="col-md-3">
            <label for="preparation" class="form-label">Preparation</label>
            <select name="prep" id="" class="form-select" required>
                <option value="" selected disabled>Choose....</option>
                <option value="Made to order">Made to order</option>
                <option value="Fresh">Fresh</option>
                <option value="Surplus">Surplus</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="datetime" class="form-label">Creation Time <small class="text-secondary">(applicable for fresh and surplus)</small> </label>
            <input type="datetime-local" class="form-control" id="inputAddress" name="creation">
        </div>
        <div class="col-md-3">
            <label for="inputState" class="form-label">Discounted Price</label>
            <input type="number" class="form-control" placeholder="$" name="disprice" id="disprice"required>
        </div>
        <div class="col-md-3">
            <label for="inputZip" class="form-label">Original Price</label>
            <input type="number" class="form-control" placeholder="$" name="origprice" id="origprice" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary" name="savebtn">Add Product</button>
            <a class="btn btn-secondary" href="product.php" style="background-color:red;">Cancel</a>
        </div>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>