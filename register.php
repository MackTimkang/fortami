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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">    
    <title>Register</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center">
        <form action="" method="post">
        <div class="row g-3 p-5 ">
            <div class="col-12 text-center">
                <h1><i class="bi bi-person-fill-up"></i> Register</h1>
            </div>
            <div class="col-3">
                <label for="role" class="form-label">How do you intend to use Fortami?</label>
                    <select class="form-select" aria-label="role" name="role" required>
                        <option selected disabled>Click to choose...</option>
                        <option value="Buyer">Buy</option>
                        <option value="Seller">Sell</option>
                    </select>
            </div>
            <div class="col-12">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" name="Fname" required>
            </div>
            <div class="col-12">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="Lname" required>
            </div>
            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="col-12">
                <label for="uname" class="form-label">Username</label>
                <input type="text" class="form-control" name="uname" required>
            </div>
            <div class="col-12">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" name="pass" required>
            </div>
            <div class="col-12">
                <label for="pass" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="cpass" required>
            </div>
            <div class="col-12 text-center">
                <button type="submit" name="regbtn" class="btn btn-primary">Register</button>
                <a class="btn btn-secondary" href="index.php" style="background-color:red;border:none">Cancel</a>
            </div>
        </div>
        </form>
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
            $email = $_POST['email'];
            $uname = $_POST['uname'];

            $backend->registerUser($role,$fn,$ln,$email,$uname,$pass);

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>