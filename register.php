<?php
include 'header.php';
include 'backend.php';
$backend = new Backend;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div class="main-cont">
        <div class="reg-cont">
            <form action="register.php" method="post">
                <label for="buyorsell">Please select your role:</label>
                <input type="radio" name="role" value="Buyer" required>
                <label for="buyer">Buyer</label>
                <input type="radio" name="role" value="Seller" required>
                <label for="seller">Seller</label>
                <br><br>
                <input type="text" name="Fname" placeholder="First Name" required >
                <input type="text" name="Lname" placeholder="Last Name" required>
                <input type="text" name="address" placeholder="Address" required>
                <input type="text" name="email" placeholder="Email" required>
                <input type="text" name="contact" placeholder="Contact Number" required>
                <input type="text" name="uname" placeholder="Username" required>
                <input type="password" name="pass" placeholder="Password" required>
                <input type="password" name="cpass" placeholder="Confirm Password" required>
                <input type="submit" name="regbtn" value="Register" >
            </form>
        </div>
    </div>
    <?php
       if(isset($_POST['regbtn'])){
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];
        $len = strlen($pass);
        //check if password length is more than 8
         if ($len >= 8 ) {
            //check if password and confirm password is equal
           if ( $pass == $cpass) {
            $role = $_POST['role'];
            $fn = $_POST['Fname'];
            $ln = $_POST['Lname'];
            $ad = $_POST['address'];
            $email = $_POST['email'];
            $cnum = $_POST['contact'];
            $uname = $_POST['uname'];

            $backend->registerUser($role,$fn,$ln,$ad,$email,$cnum,$uname,$pass);

            //call register function
           }
           else{
                echo "Please confirm your password! Password not equal.";
           }
         }
         else{
            echo "<p>Password must have 8 characters or more!</p>";
         }
       }
    ?>
</body>
</html>