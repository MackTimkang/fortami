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
    <title>Add</title>
</head>
<body>
<div class="container-fluid" style="padding:30px;">
<form class="row g-3"style="padding:30px;" action="product.php" method="post">
    <h1>Add Food Listing</h1>
    <div class="input-group" style="width:1000px;">
        <label class="input-group-text" for="inputGroupFile01">Upload Food Image</label>
        <input type="file" class="form-control" id="inputGroupFile01" name="foodpic" required>
    </div>
    <div class="input-group" style="width:1000px;">
        <select class="form-select" aria-label="Default select example" name="category" required>
            <option selected>Select Food Category</option>
            <?php $backend->categorylist();?>
        </select>
    </div>
    <div class="col-md-10" >
            <label for="food name" class="form-label">Food Name</label>
            <input type="text" class="form-control" id="foodname" name="foodname" required>
    </div>
    <div class="col-10">
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="fooddesc"required></textarea>
            <label for="floatingTextarea">Food Details</label>
        </div>
    </div>
    <div class="col-md-10">
        <label for="datetime" class="form-label">Date & Time of Creation</label>
        <input type="datetime-local" class="form-control" id="inputAddress" name="creation" required>
    </div>
    <div class="col-md-5">
        <label for="inputState" class="form-label">Discounted Price</label>
        <input type="number" class="form-control" name="disprice" id="disprice"required>
    </div>
    <div class="col-md-5">
        <label for="inputZip" class="form-label">Original Price</label>
        <input type="number" class="form-control" name="origprice" id="origprice" required>
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