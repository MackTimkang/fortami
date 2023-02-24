<?php

@include 'backend.php';

if(isset($_POST['add_to_cart'])){

   $food_id = $_POST['food_id'];
   $user_id = $_POST['user_id'];
   $category_id = $_POST['category_id'];
   $food_name = $_POST['food_name'];
   $food_description = $_POST['food_description'];
   $food_creation = $_POST['food_creation'];
   $food_discountedPrice = $_POST['food_discountedPrice'];
   $food_origPrice = $_POST['food_origPrice'];
   $product_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

<div class="container">

<section class="products">

   <h1 class="heading">Latest products</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">₱<?php echo $fetch_product['price']; ?></div>
            <input type="hidden" name="food_id" value="<?php echo $fetch_product['food_id']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $fetch_product['user_id']; ?>">
            <input type="hidden" name="category_id" value="<?php echo $fetch_product['category_id']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['food_pic']; ?>">
            <input type="hidden" name="food_name" value="<?php echo $fetch_product['food_name']; ?>">
            <input type="hidden" name="food_description" value="<?php echo $fetch_product['food_description']; ?>">
            <input type="hidden" name="food_creation" value="<?php echo $fetch_product['food_creation']; ?>">
            <input type="hidden" name="food_discountPrice" value="<?php echo $fetch_product['food_discountPrice']; ?>">
            <input type="hidden" name="food_origPrice" value="<?php echo $fetch_product['food_origPrice']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>