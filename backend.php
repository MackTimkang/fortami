<?php
session_start();
    class Backend{
      public $host = 'localhost';
      public $user = 'root';
      public $pass = '';
      public $db = 'fortami';
      public $con;

      //database connection

      function __construct(){
        
        $this->con = new mysqli($this->host,$this->user,$this->pass,$this->db) or die("Connection Error!");

      }//end of db construct

      //Account Management 
      function login($uname,$pw){
        $sql = "SELECT * from user WHERE user_userName = '$uname'";
        $result = mysqli_query($this->con,$sql);
        if ($result) {
          if ($result->num_rows > 0) {
              $row = mysqli_fetch_assoc($result);

              if(password_verify($pw,$row['user_password'])){
                $_SESSION['user'] = $uname;
                $_SESSION['id'] = $row['user_id'];
                $_SESSION['role'] = $row['user_type'];
                  if ($row['user_type'] == 'Seller') {
                    echo "<script>alert('Welcome Back!'); window.location.href = 'sellerdash.php'";
                    echo "</script>";
                  }
                  elseif ($row['user_type'] == 'Buyer') {
                    echo "<script>alert('Welcome Back!'); window.location.href = 'menu.php'";
                    echo "</script>";
                  }
                  else{
                    echo "Error in ".$this->con->error;
                  }
              }
              else {
                echo "<script>alert('Invalid Credentials!');";
                echo "</script>";
              }
                
          }
          else {
            echo "<script>alert('No user found!');";
            echo "</script>";
          }
        }
      }//end of login function

      function checksession(){
        if(isset($_SESSION['user'])){
          //Validate session
        }
        else{
          echo "<script>alert('Please Login First!');window.location.href='index.php';</script>";
        }
      }//checksession end

      function registerUser($role,$fn,$ln,$em,$un,$pass){
        $sql = "SELECT * from user WHERE user_userName = '$un'";
        $result = mysqli_query($this->con,$sql);
          if($result){
            if ($result->num_rows > 0) {
              echo "User Already Exist!";
            }
            else {
              $hashpass = password_hash($pass,PASSWORD_DEFAULT);
              $query = "INSERT INTO user(user_type,user_fName,user_lName,user_email,user_userName,user_password) 
              values('$role','$fn','$ln','$em','$un','$hashpass')";
              $reg = mysqli_query($this->con,$query);
                if($reg){
                  echo "<script>alert('Registered Successfully!');";
                  echo "window.location.href = 'login.php';";
                  echo "</script>";
                }
                else{
                  echo "error in $reg".$this->con->error;
                }
            }
          }
      }//end of register user function

      function usersearch($id){
        $query = "SELECT * FROM user WHERE user_id = $id";
        $result = $this->con->query($query);
          if ($result) {
            return $result;
          }
      }

      function address($id,$label){
        $query = "SELECT * FROM address WHERE user_id = $id AND label= '$label'";
        $result = $this->con->query($query);
        if ($result) {
            if ($result->num_rows > 0) {
              return $result;
            }
            else {
            }
        }
        echo "<meta http-equiv='refresh' content='0'>";
      }//end of address function

      function searchaddress($address_id){
        $query = "SELECT * FROM address WHERE address_id = $address_id";
        $result = $this->con->query($query);

        if ($result) {
          return $result;
        }
      }//end of searchaddress function

      function sellerAddress($seller_id){
        $query = "SELECT * FROM address WHERE user_id = $seller_id";
        $result = $this->con->query($query);

          if ($result) {
            return $result;
          }
      }

      function delAddress($id){
        $query = "DELETE FROM address WHERE address_id = $id";
        $result = $this->con->query($query);
        
        if ($result) {
          echo "<script>alert('Address Deleted successfully!');window.location.href = 'checkout.php';</script>";
        }
      }

      function editAddress($id,$name,$con,$reg,$province,$city,$brgy,$street,$zip,$note,$label){
        $query = "UPDATE address SET full_name = '$name', contact = '$con' , region = '$reg' ,
        province = '$province', city = '$city', barangay = '$brgy', street = '$street', zip = '$zip',note='$note',label='$label' 
        WHERE address_id = $id";
        $result = $this->con->query($query);
        if ($result) {
          echo "<script>alert('Address updated successfully!');window.location.href = 'checkout.php';</script>";
        }
        else {

        }
      }

      function createAddress($user_id,$name,$type,$con,$reg,$province,$city,$brgy,$street,$zip,$note,$label){
        $query = "INSERT INTO address(user_id,full_name,address_type,contact,region,province,city,barangay,street,zip,note,label) values($user_id,'$name','$type','$con','$reg','$province','$city','$brgy','$street','$zip','$note','$label')";
        $result = $this->con->query($query);
          if ($result) {
              echo "<script>alert('Address saved successfully!');window.location.href = 'checkout.php';</script>";
          }
      }//end of addAddress

      //end of Account Management

      //Food Management
      function categorylist(){
        $query = "SELECT * FROM category";
        $result = $this->con->query($query);
          if($result){
            if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
                echo "<option value=".$row['category_id'].">".$row['category_name']."</option>";
              }
            }
          }
      }//end of category list function

      function addproduct($catid,$pic,$foodname,$desc,$preparation,$time,$discount,$price){
        $id = $_SESSION['id'];
        $query = "INSERT INTO food_product(user_id,category_id,food_pic,food_name,food_description,preparation
        ,food_creation,food_discountedPrice,food_origPrice) values('$id','$catid','$pic','$foodname','$desc','$preparation',
        '$time','$discount','$price')";

        $result = $this->con->query($query);

        if ($result) {
          if ($result) {
            echo "<script>alert('Successfuly Saved!');</script>";
          }
          else{
            echo "error in $db".$this->con->error;
          }
        }
        echo "<meta http-equiv='refresh' content='0'>";
      }// end of add product function

      function editproduct($food_id,$catid,$pic,$name,$desc,$prep,$date,$discprice,$origprice){
        $id = $_SESSION['id'];//user_id
        $query = "UPDATE food_product SET category_id ='$catid',food_pic = '$pic', food_name='$name',food_description='$desc',preparation='$prep',food_creation='$date',
        food_discountedPrice = '$discprice', food_origPrice = '$origprice' WHERE user_id = '$id' AND food_id='$food_id'";
        $result = $this->con->query($query);
        if ($result) {
          echo "<script>alert('Updated Successfuly!');window.location.href='product.php';</script>";
        }
        else {
          echo "Error in $query".$this->con->error;
        }
        echo "<meta http-equiv='refresh' content='0'>";
      }// end of edit product function

      function deleteproduct($food_id){
        $query = "DELETE FROM food_product WHERE food_id = $food_id";
        $result = $this->con->query($query);
          if($result){
              echo "<script>alert('Deleted Successfully');</script>";
            }
            else {
              echo "error in $this->db".$this->con->error;
            }
            echo "<meta http-equiv='refresh' content='0'>";
      }//end of delete product function

      function listproduct(){
          $sql = "SELECT food_id, food_pic,category.category_name,food_name,food_description,preparation,
          food_creation,food_discountedPrice,food_origPrice FROM food_product JOIN category ON food_product.category_id = category.category_id ORDER BY food_id";
          $result = $this->con->query($sql);
          return $result;
      }//end of list product function
      
      function getproduct(){
        $query = "SELECT * from food_product";
        $result = $this->con->query($query);
        if ($result) {
            return $result;
        }
        else {
          echo "No item found!";
        }
      }//end of get product function

      //end of food management

      //cart management
      function checkcart($food,$user){
        $query = "SELECT * FROM cart WHERE food_id = $food AND user_id = $user";
        $result = $this->con->query($query);
        if ($result) {
          return $result;
        }
        
      }
      function getcart(){
        $user_id = $_SESSION['id'];
        $query = "SELECT cart.food_id,food_product.food_pic,food_product.food_name,food_product.food_description,food_product.preparation,quantity,
                        food_product.food_creation,food_product.food_discountedPrice,food_product.food_origPrice,user.user_userName,food_product.user_id
                  FROM cart 
                  JOIN food_product 
                  ON food_product.food_id = cart.food_id
                  INNER JOIN user ON food_product.user_id = user.user_id
                  WHERE cart.user_id = $user_id";

        $result = $this->con->query($query);
          if ($result) {
              return $result;
          }
      }//end of get cart function

      function total(){
        $user_id = $_SESSION['id'];
        $query = "SELECT sum(food_product.food_discountedPrice * cart.quantity) AS total FROM cart
                  JOIN food_product ON food_product.food_id = cart.food_id WHERE cart.user_id = $user_id";
        $result = $this->con->query($query);
          if ($result) {
            return $result;
          }
      }
      
      function addtocart($food,$user,$qty){
          $query = "INSERT INTO cart(food_id,user_id,quantity) VALUES('$food','$user','$qty')";
          $result = $this->con->query($query);
            if ($result) {
              echo "<script>alert('Added Successfuly');</script>";
            }
      }//end of add to cart function

      function editcart($food,$user,$qty){
        $query = "UPDATE cart SET quantity = $qty WHERE food_id =$food AND user_id = $user";
        $result = $this->con->query($query);

        if ($result) {
          echo "<script>alert('Quantity Successfully Changed');</script>";
        }
        else {
          echo "Error in $query".$this->con->error;
        }
        echo "<meta http-equiv='refresh' content='0'>";
      }

      function delcart($food,$user){
        $query = "DELETE FROM cart WHERE food_id = $food AND user_id = $user";
        $result = $this->con->query($query);
        if ($result) {
            echo "<script>alert('Deleted Successfully!');</script>";
        }
        else {
          echo "Error in $query".$this->con->error;
        }
        echo "<meta http-equiv='refresh' content='0'>";
      }

      function clearcart(){
        $query = "DELETE FROM cart";
        $result = $this->con->query($query);

          if ($result) {
          }
          echo "<meta http-equiv='refresh' content='0'>";
      }
      function countcart($user_id){
        $query = "SELECT * FROM cart WHERE user_id = $user_id";
        $result = $this->con->query($query);
          if ($result) {
            if ($result->num_rows > 0) {
              $count = $result->num_rows;
            }
            else {
              $count = '0';
            }
          }
          else{
            
          }
          return $count;
      }//end of countcart

      //end of cart management

      //start of payment management

      function payment($user,$method,$amount,$status){
        $query = "INSERT INTO payment_transaction(user_id,paymethod_id,pay_amount,trans_status) values($user,$method,'$amount','$status')";
        $result = $this->con->query($query);
          if ($result) {
            echo "<script>alert('Payment Successful, Order is being processed');window.location.href='receipt.php';</script>";
          }
      }//end of payment

      function transaction(){
        $query = "SELECT payTrans_id,pay_amount,quantity,trans_status,pay_datetime,user.user_userName,address.full_name,address.contact,address.region,address.city,address.barangay,address.street,address.zip,address.label,
                  payment_transaction.food_id,food_product.food_name,food_product.food_discountedPrice,payment_transaction.address_id,payment_method.paymethod_type FROM payment_transaction
                  JOIN food_product ON payment_transaction.food_id = food_product.food_id
                  INNER JOIN user ON food_product.user_id = user.user_id
                  JOIN address ON payment_transaction.address_id = address.address_id
                  JOIN payment_method ON payment_transaction.paymethod_id = payment_method.paymethod_id";
        $result = $this->con->query($query);

          if ($result) {
            return $result;
          }
      }// end of transaction

      function getpayment($user,$time){
        $query = "SELECT * FROM payment_transaction WHERE user_id = $user AND pay_datetime = '$time'";
        $result = $this->con->query($query);

          if ($result) {
            return $result;
          }
      }//end of function getpayment

      function paymentTotal($id){
        $query = "SELECT sum(pay_amount) as total FROM payment_transaction WHERE user_id = $id ";
        $result = $this->con->query($query);
          if ($result) {
            return $result;
          }
      }// end of payment
      
      //end of payment management

      //start of order management

      function order($food,$user,$address,$payTrans_id,$status,$qty){
        $query = "INSERT into food_order(food_id,user_id,address_id,payTrans_id,order_status,quantity) values($food,$user,$address,$payTrans_id,'$status','$qty')";
        $result = $this->con->query($query);

          if ($result) {

          }
      }//end of creating order function

      function orderReceipt(){
        $trans_id = $_SESSION['trans_id'];
        $query = "SELECT * FROM food_order JOIN food_product ON food_order.food_id = food_product.food_id
                  JOIN user ON food_order.user_id = user.user_id
                  JOIN address ON food_order.address_id = address.address_id
                  JOIN payment_transaction on food_order.payTrans_id = payment_transaction.payTrans_id WHERE food_order.payTrans_id = $trans_id";
        $result = $this->con->query($query);

          if ($result) {
            return $result;
          }
      }//end of function order reciept

      function shopName(){
        $trans_id = $_SESSION['trans_id'];
        $query = "SELECT * FROM food_order JOIN food_product ON food_order.food_id = food_product.food_id
                  INNER JOIN user ON user.user_id = food_product.user_id WHERE food_order.payTrans_id = $trans_id";
        $result = $this->con->query($query);

        if ($result) {
          return $result;
        }
      }

    }//end of backend class
?>