<?php
session_start();
    class Backend{
      public $host = 'localhost';
      public $user = 'root';
      public $pass = '';
      public $db = 'fortami1';
      public $con;

      //database connection

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
      }//end of __construct function


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

          echo "<table class = 'product-cont'>";
            echo "<tr>";
            echo "<th>Photo</th>";
            echo "<th>Category</th>";
            echo "<th>Food</th>";
            echo "<th>Description</th>";
            echo "<th>Creation</th>";
            echo "<th>Price</th>";
            echo "<th>Action</th>";
            echo "</tr>";
          if($result){
              if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                  echo "<tr>";
                  echo "<td><img src='".$row['food_pic']."'</td>";
                  echo "<td>".$row['category_name']."</td>";
                  echo "<td>".$row['food_name']."</td>";
                  echo "<td>".$row['food_description']."</td>";
                  echo "<td>".$row['food_creation']."</td>";
                  echo "<td>".$row['food_discountedPrice']."</td>";
                  echo "<td>
                  <a class='editbtn' href='/fortami/edit.php?id=".$row['food_id']."'>Edit</a>
                    <form action='product.php' method='post'>
                      <input type='hidden' name='food_id' value='".$row['food_id']."'>
                      <input type='submit' name='delbtn' class='delbtn' value='Delete' style='border:none;color:white; width:60px'>
                    </form>
                  </td>";
                  echo "</tr>";
                }  
              }
              else{
                
              }
              
          }
          else{
            echo "Error in $this->sql".$this->con->error;
          }
            echo "<tr>";
            echo "<td><a href='/fortami/add.php' style='margin:0;background-color:green;
            border-radius:30px;font-size:2vmin;padding:0 10px;font-weight:semi-bold;'>Add Food</a></td>";
            echo "</tr>"; 
            echo "</table>";
      }//end of list product function

      //end of food management
    

    }//end of backend class
?>