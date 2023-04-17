<?php
session_start();
    class Database{
      public $host = 'localhost';
      public $user = 'root';
      public $pass = '';
      public $db = 'fortami';
      public $conn;

      //database connection

      function __construct(){
        
        $this->conn = new mysqli($this->host,$this->user,$this->pass,$this->db);

        if ($this->conn->connect_error) {
          die("Connection Failed:".$this->conn->connect_error);
        }

      }//end of db construct

      function getConnection(){
        return $this->conn;
      }
      function closeConnection(){
        return $this->conn->close();
      }
    }//end of Class Database
    
    class Account{
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
                    echo "<script>alert('Welcome Back!'); window.location.href = 'product.php'";
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
          $this->userAddress();
        }
        else{
          echo "<script>alert('Please Login First!');window.location.href='login.php';</script>";
        }
      }//checksession end

      function registerUser($role,$pic,$fn,$ln,$em,$un,$pass){
        $sql = "SELECT * from user WHERE user_userName = '$un'";
        $result = mysqli_query($this->con,$sql);
          if($result){
            if ($result->num_rows > 0) {
              echo "User Already Exist!";
            }
            else {
              $hashpass = password_hash($pass,PASSWORD_DEFAULT);
              $query = "INSERT INTO user(user_type,profile_pic,user_fName,user_lName,user_email,user_userName,user_password) 
              values('$role','$pic','$fn','$ln','$em','$un','$hashpass')";
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
      }//end of search user function

      function listSellers(){
        $query = "SELECT * FROM user WHERE user_type = 'Seller'";
        $result = $this->con->query($query);
          if ($result) {
            return $result;
          }
      }//end of list seller function

      function getSellerId(){
        $user = $_SESSION['id'];
        $query = "SELECT food_product.user_id FROM cart JOIN food_product ON food_product.food_id = cart.food_id INNER JOIN user ON user.user_id = food_product.user_id WHERE cart.user_id = $user GROUP BY user_id";
        $result = $this->con->query($query);
          if ($result) {
            return $result;
          }
      }


    }//end of class Account

    class Address extends Account{
        function userAddress(){
          $id = $_SESSION['id'];
          $query = "SELECT * FROM address WHERE user_id = $id";
          $result = $this->con->query($query);
          if ($result) {
              if ($result->num_rows > 0) {
                return $result;
              }
              else {
                echo "<script>alert('Please add an address first!');window.location.href='address.php?user=$id';</script>";
              }
          }//end of search userAddress function
          
        }//end of address function

        function searchaddress($address_id){
          $query = "SELECT * FROM address WHERE address_id = $address_id";
          $result = $this->con->query($query);

          if ($result) {
            return $result;
          }
        }//end of searchaddress function

        function findAddress($user_id){
          $query = "SELECT * FROM address WHERE user_id = $user_id";
          $result = $this->con->query($query);
            if ($result) {
              return $result;
            }
        }

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
          $userSearch = $this->userSearch($user_id);
          $user = mysqli_fetch_assoc($userSearch);
          $role = $user['user_type'];
          $query = "INSERT INTO address(user_id,full_name,address_type,contact,region,province,city,barangay,street,zip,note,label) values($user_id,'$name','$type','$con','$reg','$province','$city','$brgy','$street','$zip','$note','$label')";
          $result = $this->con->query($query);
            if ($result) {
              if ($role === 'Seller') {
                echo "<script>alert('Address saved successfully!');window.location.href = 'product.php';</script>";
              }
              else {
                echo "<script>alert('Address saved successfully!');window.location.href = 'menu.php';</script>";
              }
              }
        }//end of addAddress
    }//end of class Address
    
    class Backend extends Address{
      public $con;

      function __construct(){
        $database = new Database;
        $this->con = $database->getConnection();
      }

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
            echo "<script>alert('Successfuly Saved!');window.location.href='product.php'</script>";
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
          $user = $_SESSION['id'];
          $sql = "SELECT food_id, food_pic,category.category_name,food_name,food_description,preparation,
          food_creation,food_discountedPrice,food_origPrice FROM food_product JOIN category ON food_product.category_id = category.category_id WHERE food_product.user_id = $user ORDER BY food_id";
          $result = $this->con->query($sql);
          return $result;
      }//end of list product function
      
      function getproduct(){
        $query = "SELECT * FROM food_product";
        $result = $this->con->query($query);
        if ($result) {
            return $result;
        }
        else {
          echo "No item found!";
        }
      }//end of get product function

      function productFilter($query){
        $result = $this->con->query($query);
        if ($result) {
            return $result;
        }
        else {
          echo "No item found!";
        }
      }

      function viewProduct($id){
        $query = "SELECT * FROM food_product WHERE user_id = $id";
        $result = $this->con->query($query);
          if ($result) {
            return $result;
          }
      }

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
              echo "<script>alert('Added Successfully');</script>";
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
      }//end of clear cart function

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

      function payment($user,$method,$amount,$opt,$status){
        $query = "INSERT INTO payment_transaction(user_id,paymethod_id,pay_amount,delivery_option,trans_status) values($user,$method,'$amount','$opt','$status')";
        $result = $this->con->query($query);
          if ($result) {
            echo "<script>alert('Payment Successful, Order is being processed');window.location.href='activeorders.php';</script>";
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
        $user = $_SESSION['id'];
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

      function order($food,$address,$payTrans_id,$status,$qty){
        $query = "INSERT into food_order(food_id,address_id,payTrans_id,order_status,quantity) values($food,$address,$payTrans_id,'$status','$qty')";
        $result = $this->con->query($query);

          if ($result) {

          }
      }//end of creating order function

      function countOrder($trans){
        $query = "SELECT sum(quantity) AS count FROM food_order WHERE payTrans_id = $trans AND order_status = 'Pending' OR order_status= 'Preparing'";
        $result = $this->con->query($query);

        if ($result) {
          return $result;
        }
      }//end of count order function

      function activeOrders(){
        $user = $_SESSION['id'];
        $query = "SELECT * FROM food_order
                  JOIN food_product ON food_product.food_id = food_order.food_id
                  INNER JOIN user ON user.user_id = food_product.user_id
                  JOIN payment_transaction ON food_order.payTrans_id = payment_transaction.payTrans_id 
                  WHERE payment_transaction.user_id = $user AND order_status = 'Pending' OR order_status = 'Preparing' OR order_status = 'On The Way' OR order_status = 'Ready' GROUP BY user.user_userName";
        $result = $this->con->query($query);

          if ($result) {
            return $result;
          }

      }//end of buyer view active orders

      function orderStatus($id,$status){
        $query = "UPDATE food_order SET order_status = '$status' WHERE payTrans_id = $id";
        $result = $this->con->query($query);
          if ($result) {
            echo "<script>alert('Order $status');</script>";
          }
      }//end of order status function

      function tranStatus($id,$status){
        $query = "UPDATE payment_transaction SET trans_status = '$status' WHERE payTrans_id = $id";
        $result = $this->con->query($query);
          if ($result) {
            echo "<script>alert('Payment $status');</script>";
          }
      }

      function receivedTime($time,$id){
        $query = "UPDATE food_order SET received_datetime = '$time' WHERE payTrans_id=$id";
        $return = $this->con->query($query);

        if ($return) {
          # code...
        }
      }

      function foodBought($id){
        $query = "SELECT * FROM food_order JOIN food_product ON food_order.food_id = food_product.food_id
                  WHERE food_order.payTrans_id = $id";
        $result = $this->con->query($query);

        if ($result) {
          return $result;
        }
      }//end of shop details function

      function viewHistory(){
        $user = $_SESSION['id'];
        $query = "SELECT * FROM food_order
                  JOIN payment_transaction ON payment_transaction.payTrans_id = food_order.payTrans_id
                  JOIN food_product ON food_product.food_id=food_order.food_id
                  INNER JOIN user ON user.user_id = food_product.user_id 
                  INNER JOIN payment_method ON payment_method.paymethod_id = payment_transaction.paymethod_id 
                  WHERE payment_transaction.user_id = $user 
                  AND order_status = 'Received' OR order_status = 'Cancelled' GROUP BY food_order.payTrans_id ORDER BY food_order.payTrans_id DESC";
        $result = $this->con->query($query);

          if ($result) {
            return $result;
          }
        }//end of list transaction history function

        function sellerOrders(){
          $seller_id = $_SESSION['id'];
          $query = "SELECT * FROM food_order 
                    JOIN food_product ON food_product.food_id = food_order.food_id 
                    JOIN address ON food_order.address_id = address.address_id 
                    JOIN payment_transaction ON payment_transaction.payTrans_id = food_order.payTrans_id 
                    WHERE (SELECT food_product.user_id FROM food_order JOIN food_product ON food_order.food_id = food_product.food_id 
                            INNER JOIN user ON user.user_id = food_product.user_id WHERE order_status = 'Pending' OR order_status= 'Preparing' GROUP BY food_product.user_id) = $seller_id AND order_status = 'Pending' OR order_status = 'Preparing' GROUP BY food_order.payTrans_id";
          $result = $this->con->query($query);
            if ($result) {
              return $result;
            }
        }//end of seller order list

        function waitingList(){
          $seller_id = $_SESSION['id'];
          $query = "SELECT * FROM food_order 
                    JOIN food_product ON food_product.food_id = food_order.food_id 
                    JOIN address ON food_order.address_id = address.address_id 
                    JOIN payment_transaction ON payment_transaction.payTrans_id = food_order.payTrans_id 
                    WHERE (SELECT food_product.user_id FROM food_order JOIN food_product ON food_order.food_id = food_product.food_id 
                            INNER JOIN user ON user.user_id = food_product.user_id WHERE order_status = 'Pending' OR order_status= 'Preparing' GROUP BY food_product.user_id) = $seller_id AND order_status = 'Preparing' OR order_status = 'On The Way' OR order_status = 'Ready' GROUP BY food_order.payTrans_id ORDER BY food_order.payTrans_id DESC";
          $result = $this->con->query($query);
            if ($result) {
              return $result;
            }
        }//end of order waiting list function

        function saleHistory(){
          $seller_id = $_SESSION['id'];
          $query = "SELECT * FROM food_order 
                    JOIN food_product ON food_product.food_id = food_order.food_id 
                    JOIN address ON food_order.address_id = address.address_id 
                    JOIN payment_transaction ON payment_transaction.payTrans_id = food_order.payTrans_id 
                    WHERE (SELECT food_product.user_id FROM food_order JOIN food_product ON food_order.food_id = food_product.food_id 
                            INNER JOIN user ON user.user_id = food_product.user_id WHERE order_status = 'Received' AND food_product.user_id = $seller_id GROUP BY food_product.user_id) = $seller_id AND order_status = 'Received' OR order_status = 'Cancelled' GROUP BY food_order.payTrans_id ORDER BY food_order.payTrans_id DESC";
          $result = $this->con->query($query);
            if ($result) {
              return $result;
            }
        }// end of saleHistory


        function orderAgain($trans_id){
          $foods = $this->foodBought($trans_id);
          $user = $_SESSION['id'];
            foreach ($foods as $row) {
              $food = $row['food_id'];
              $qty = $row['quantity'];
              $total = $row['food_discountedPrice'] * $row['quantity'];
              $query = "INSERT INTO cart values($food,$user,$qty)";
              $result = $this->con->query($query);

              if ($result) {
                echo "<meta http-equiv='refresh' content='0'>";
              }
            }
        }//end of order again function

        function rateOrder($order,$rate,$comment,$trans){
          $query = "INSERT INTO rating(order_id,rating,comment) VALUES($order,'$rate','$comment')";
          $result = $this->con->query($query);
            if ($result) {
              echo "<script>alert('Rated Successfully!');window.location.href='rate.php?trans=$trans';</script>";
            }
        }//end of function Order Rating

        function toRate($trans){
          $query = "SELECT * FROM food_order JOIN food_product ON food_order.food_id = food_product.food_id
                  WHERE food_order.payTrans_id = $trans AND rating_status IS NULL";
          $result = $this->con->query($query);

          if ($result) {
            if ($result->num_rows > 0) {
              return $result;
            }
            else {
              echo "<h1 class='text-center'><i class='bi bi-check-circle-fill'>Done Rating! <br><br> <h3><a class='btn btn-outline-info' href='transactions.php?trans=$trans'>View Receipt</a></h3></i></h1>";
            }
          }
        }//end of function toRate

        function ratingStatus($order){
          $query = "UPDATE food_order SET rating_status = 'Done' WHERE order_id = $order";
          $result = $this->con->query($query);

            if ($result) {
              
            }
            else{
              echo "Error in changing rating status";
            }
        }


        function viewRating($food_id){
          $query = "SELECT AVG(rating) AS rate FROM rating JOIN food_order ON food_order.order_id = rating.order_id
                    INNER JOIN food_product ON food_product.food_id = food_order.food_id WHERE food_order.food_id = $food_id";
          $return = $this->con->query();
            if ($return) {
              return $result;
            }
        }//end of done rating


    }//end of class backend

?>