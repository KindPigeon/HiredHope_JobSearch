<?php  
    session_start();
    require('dbconfig.php');

    $usernameInvalid = "";
    $passwordInvalid = "";

    if (isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * from users where username = '$username' and password = '$password'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);
        if (mysqli_num_rows($result) == 1){
            $_SESSION['username'] = $username;
            $_SESSION['admin_status'] = $row['admin_status'];
            $_SESSION['id'] = $row['id'];
            
            header("Location: home.php");
            exit();
        }
        else {
            $usernameInvalid = "Username or Password is invalid";
            $passwordInvalid = "Username or Password is invalid";
            session_unset();
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inder&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap">
    <title>Hired Hope</title>
</head>

<body>
    <header>
        <div class="logo-container">
            <img src="image/hiredhopelogo.png" alt="Hired Hope Logo">
        </div>
        <h1>Hired Hope</h1>
    </header>
</body>

<div class="login-container">
    <h1>User Login</h1>

    <form id="login-form" method="post" action="login.php" novalidate>
        <label for="username">Username:</label>
        <input type="username" id="username" name="username" class = "logininput" required>
        <span class ="error"><?=$usernameInvalid ?></span>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" class = "logininput" required>
        <span class ="error"><?=$passwordInvalid ?></span>
        <br>
        <button type="submit" class = "loginbutton" name = "login"><b>Login</b></button>
    </form>

    <p class="register-message">Don't have an account yet? <a href="signup.php">Regsiter Now</a></p>
</div>


<footer>
    <div class="contact-us">
        <p>Contact Us | 010 123 5678</p>
    </div>
   <div class="socialmediacontainer">
    <div class="follow-us">
        <h2>Follow Us:</h2>
        <div class="logos">
            <a href="https://www.facebook.com"><img src="image/facebook.png" alt="Facebook"></a>
            <a href="https://www.twitter.com"><img src="image/twitter.png" alt="Twitter"></a>
            <a href="https://www.instagram.com"><img src="image/instagram.png" alt="Instagram"></a>
        </div>
    </div>
   </div> 
</footer>
</html>