<?php
    require_once 'backend.php';
    $backend = new Backend;
    $backend->checksession();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@600&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div class="main-cont">
        <div class="topspace">
            </div>
            <div class="login">
                <h1>Welcome Back!</h1>
                    <form action="" method="post">
                        <input class="uname" type="text" name="username" placeholder="Username" required>
                        <input class="pw" type="password" name="pword" placeholder="Password" required>
                        <input class="logbtn" type="submit" name="login" value="Login">
                    </form>
                        <a class="forget" href="">forget password?</a>
                        <p>-or Login via-</p>
                        <br>
                            <button><img src="./src/google.png" alt="google"></button>
                            <button><img src="./src/facebook.png" alt="facebook"></button>
                        <p>No account? <a href="./register.php">Register </a>here</p>
            </div>
       <div class="bottomspace">

       </div>
    </div>
   <?php
    //login code
    if(isset($_POST['login'])){
        $uname = $_POST['username'];
        $pass = $_POST['pword'];
        $backend->login($uname,$pass);
    }
   ?>
</body>
</html>