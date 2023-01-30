<?php

    class Backend{
      public $host = 'localhost';
      public $user = 'Mack24';
      public $pass = 'Mack.24';
      public $db = 'fortami';
      public $con;

      function __construct(){
        
        $this->con = new mysqli($this->host,$this->user,$this->pass,$this->db) or die("Connection Error!");

      }//end of db construct
      
      function login($uname,$pw){
        $sql = "SELECT * from user WHERE user_userName = '$uname'";
        $result = mysqli_query($this->con,$sql);
        if ($result) {
          if ($result->num_rows > 0) {
              $row = mysqli_fetch_assoc($result);

              if(password_verify($pw,$row['user_password'])){
                
                echo "<script>alert('Welcome Back!'); window.location.href = 'user.php'";
                echo "</script>";
              }
              else {
                echo "Invalid Credentials, please check your username and password!";
              }
                
          }
          else {
            echo "No user found";
          }
        }
      }//end of login function

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

    }//end of backend class
?>