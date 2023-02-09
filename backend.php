<?php
session_start();
    class Backend{
      public $host = 'localhost';
      public $user = 'root';
      public $pass = '';
      public $db = 'fortami';
      public $con;

      function __construct(){
        
        $this->con = new mysqli($this->host,$this->user,$this->pass,$this->db) or die("Connection Error!");

      }//end of db construct
    
      function logout(){
        if (isset($_POST['logout'])) {
          if (session_destroy()) {
            header('location:index.php');
          }
          else{

          }
        }
      }

      function login($uname,$pw){
        $sql = "SELECT * from user WHERE user_userName = '$uname'";
        $result = mysqli_query($this->con,$sql);
        if ($result) {
          if ($result->num_rows > 0) {
              $row = mysqli_fetch_assoc($result);

              if(password_verify($pw,$row['user_password'])){
                $_SESSION['user'] = $uname;
                $_SESSION['id'] = $row['user_id'];
                  if ($row['user_type'] == 'Seller') {
                    echo "<script>alert('Welcome Back!'); window.location.href = 'sellerdash.php'";
                    echo "</script>";
                  }
                  elseif ($row['user_type'] == 'Buyer') {
                    echo "<script>alert('Welcome Back!'); window.location.href = 'buyerdash.php'";
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
      }//end of check user function
      
      function addproduct($foodid,$catId,$photo,$foodname,$fooddesc,$foodcreation,$fooddisc,$foodprice){
        $query = "INSERT INTO food_product values('$id','$catId','$photo','$foodname','$fooddesc','$foodcreation','$fooddisc','$foodprice') WHERE user_id = $id";
        $result = $this->con->query($query);
         
              }

      function listproduct(){
          $id = $_SESSION['id'];
          $sql = 'SELECT * FROM food_product WHERE user_id = '.$id.'';
          $result = $this->con->query($sql);

          echo "<table class = 'product-cont'>";
            echo "<tr>";
            echo "<th>Photo</th>";
            echo "<th>Name</th>";
            echo "<th>Description</th>";
            echo "<th>Creation</th>";
            echo "<th>Discount</th>";
            echo "<th>Price</th>";
            echo "</tr>";
          if($result){
              if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                  echo "<tr>";
                  echo "<td>coming soon</td>";
                  echo "<td>".$row['food_name']."</td>";
                  echo "<td>".$row['food_description']."</td>";
                  echo "<td>".$row['food_creation']."</td>";
                  echo "<td>".$row['food_discountedPrice']."</td>";
                  echo "<td>".$row['food_origPrice']."</td>";
                  echo "</tr>";
                }
                
              }
              
              else{
                echo "<script>alert('No results found!');</script>";
              }
          }
          else{
            echo "Error in $this->sql".$this->con->error;
          }
          echo "</table>";
      }//end of list product function

    }//end of backend class
?>