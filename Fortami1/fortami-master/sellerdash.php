<?php

@include 'backend.php';

if(isset($_POST['add_product'])){

   $user_id = $_POST['user_id'];
   $category_id = $_POST['category_id'];
   $food_name = $_POST['food_name'];
   $food_description = $_POST['food_description'];
   $food_creation = $_POST['food_creation'];
   $food_origPrice = $_POST['food_origPrice'];
  // $discountedPrice = $_POST['food_discountedPrice'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'uploaded_img/'.$p_image;

   $insert_query = $this->con->query( "INSERT INTO `food_product`(user_id, category_id, food_name, food_description, food_creation, food_origPrice, food_pic) VALUES('$user_id', '$category_id','$food_name', '$food_description', '$food_creation', '$food_origPrice','$p_image')") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'product add succesfully';
   }else{
      $message[] = 'could not add the product';
   }
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($con, "DELETE FROM `products` WHERE food_id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:sellerdash.php');
      $message[] = 'product has been deleted';
   }else{
      header('location:sellerdash.php');
      $message[] = 'product could not be deleted';
   };
};

if(isset($_POST['update_product'])){
   $food_id = $_POST['food_id'];
   $user_id = $_POST['user_id'];
   $category_id = $_POST['category_id'];
   $food_name = $_POST['food_name'];
   $food_description = $_POST['food_description'];
   $food_creation = $_POST['food_creation'];
   $food_discountedPrice = $_POST['food_discountedPrice'];
   $food_origPrice = $_POST['food_origPrice'];
   $update_p_image = $_FILES['update_p_image']['food_name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/'.$update_p_image;

   $update_query = mysqli_query($con, "UPDATE `products` SET food_id = '$food_id', user_id = '$user_id', category_id = '$category_id' food_pic = '$update_p_image', food_name = '$food_name' ,food_description = '$food_description',food_creation = '$food_creation',food_discountedPrice = '$food_discountedPrice',food_origPrice = '$food_origPrice'  WHERE food_id = '$food_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'product updated succesfully';
      header('location:sellerdash.php');
   }else{
      $message[] = 'product could not be updated';
      header('location:sellerdash.php');
   }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/dashboard.css">
    <link rel="stylesheet" href="./Styles/product.css">
    <title>Seller Dash Board</title>
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

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>Add New Product</h3>
    <input type="number" name="food_id" placeholder="Enter the Food ID" class="box" required>
    <input type="tenumberxt" name="user_id" placeholder="Enter the User ID" class="box" required>
    <input type="number" name="category_id" placeholder="Enter the Category ID" class="box" required>
    <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
    <input type="text" name="food_name" placeholder="Enter the Food Name" class="box" required>
    <input type="text" name="food_description" placeholder="Enter the Food Description" class="box" required>
    <input type="date" name="food_creation" placeholder="Enter the Food Creation" class="box" required>
    <input type="number" name="food_discountPrice" placeholder="Enter the Discount Price" class="box" required>
    <input type="number" name="food_origPrice" placeholder="Enter the Original Price" class="box" required>
    <input type="submit" value="add the product" name="add_product" class="btn">
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
         <th>product image</th>
         <th>product name</th>
         <th>product description</th>
         <th>product creation</th>
         <th>product discount price</th>
         <th>product price</th>
         <th>action</th>
      </thead>

      <tbody>
         <?php
         
            $select_products = mysqli_query($con, "SELECT * FROM `food_product`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['food_name']; ?></td>
            <td><?php echo $row['food_description']; ?></td>
            <td><?php echo $row['food_creation']; ?></td>
            <td>₱<?php echo $row['food_discountPrice']; ?></td>
            <td>₱<?php echo $row['food_origPrice']; ?></td>

            <td>
               <a href="sellerdash.php?delete=<?php echo $row['food_id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="sellerdash.php?edit=<?php echo $row['food_id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no product added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($con, "SELECT * FROM `products` WHERE food_id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" name="food_id" value="<?php echo $fetch_edit['food_id']; ?>">
      <input type="hidden" name="user_id" value="<?php echo $fetch_edit['user_id']; ?>">
      <input type="hidden" name="category_id" value="<?php echo $fetch_edit['category_id']; ?>">
      <input type="text" class="box" required name="food_name" value="<?php echo $fetch_edit['food_name']; ?>">
      <input type="text" class="box" required name="food_description" value="<?php echo $fetch_edit['food_description']; ?>">
      <input type="number" min="0" class="box" required name="food_discountPrice" value="<?php echo $fetch_edit['food_discountPrice']; ?>">
      <input type="number" min="0" class="box" required name="food_origPrice" value="<?php echo $fetch_edit['food_origPrice']; ?>">
      <input type="submit" value="update the prodcut" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-edit" class="option-btn">
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

</div>
</body>
</html>