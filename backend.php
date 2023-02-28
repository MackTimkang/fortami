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

      function registerUser($role,$fn,$ln,$add,$em,$num,$un,$pass){
        $sql = "SELECT * from user WHERE user_userName = '$un'";
        $result = mysqli_query($this->con,$sql);
          if($result){
            if ($result->num_rows > 0) {
              echo "User Already Exist!";
            }
            else {
              $hashpass = password_hash($pass,PASSWORD_DEFAULT);
              $query = "INSERT INTO user(user_type,user_fName,user_lName,user_address,user_email,user_number,user_userName,user_password) 
              values('$role','$fn','$ln','$add','$em','$num','$un','$hashpass')";
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

      function addproduct($catid,$pic,$foodname,$desc,$time,$discount,$price){
        $id = $_SESSION['id'];
        $query = "INSERT INTO food_product(user_id,category_id,food_pic,food_name,food_description
        ,food_creation,food_discountedPrice,food_origPrice) values('$id','$catid','$pic','$foodname','$desc',
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

      function editproduct($food_id,$catid,$pic,$name,$desc,$date,$discprice,$origprice){
        $id = $_SESSION['id'];//user_id
        $query = "UPDATE food_product SET category_id ='$catid',food_pic = '$pic', food_name='$name',food_description='$desc',food_creation='$date',
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
          $id = $_SESSION['id'];
          $sql = "SELECT food_id, food_pic,category.category_name,food_name,food_description,
          food_creation,food_discountedPrice FROM food_product JOIN category ON food_product.category_id = category.category_id WHERE user_id = ".$id." ORDER BY food_id";
          $result = $this->con->query($sql);
          return $result;
      }//end of list product function
      
      function getproduct(){
        $query = "SELECT * from food_product";
        $result = $this->con->query($query);
        if ($result->num_rows > 0) {
            return $result;
        }
        else {
          echo "No item found!";
        }
      }//end of get product function

      function component($pic,$title,$desc,$disc,$orig,$date){
        $element = "<div class='col'>
                    <div class='card h-100'>
                        <img src='./src/Food Menu/$pic' class='card-img-top' alt='...' style='max-width:100%;height:300px'>
                      <div class='card-body'>
                        <h5 class='card-title'>$title</h5>
                        <h6>
                          <small><s class='text-secondary'>$orig</s></small>
                          <span class='price'>$disc</span>
                        </h6>
                        <p class='card-text'>$desc</p>
                      </div>
                      
                      <div class='card-footer'>
                      <div class ='text-center'>
                        <button type='submit' name='addcart' class='btn btn-warning'>Add to cart<i class='bi bi-bag-heart'></i></button>
                      </div>
                      <br>
                        <small class='text-muted'>Prepared on $date</small>
                      </div>
                    </div>
                  </div>";
          echo $element;
      }//end of component function

      //end of food management
    

    }//end of backend class
?>