<?php

require('dbconfig.php'); 

// Variables and Errors
$usernameInvalid = "";
$username = null;

$emailInvalid = "";
$email = null;

$passwordInvalid = "";
$password = null;

$errorStatus = false;

// Form Validation and Insert User Information into Database

/* Username Validation */
if (isset($_POST['submit'])) {
    if (empty($_POST['username'])) {
        $usernameInvalid = "Username is required.";
        $errorStatus = true;
    } elseif (strlen($_POST['username']) < 3) {
        $usernameInvalid = "Username must be at least 3 characters.";
        $errorStatus = true;
    }
    else {
        $username = $_POST['username'];
    }

/* Password Validation */
    if (strlen(($_POST['password'])) < 8) {
        $passwordInvalid = "Password must at least be 8 characters.";
        $errorStatus = true;
    }
    else {
        $password = $_POST['password'];
    }

/* Email Validation */ 
    $email = $_POST['email'];
    $pattern = '/\S+@\S+\.\S+/';

    if(!preg_match($pattern, $email)){
        $emailInvalid = "Please enter a valid email address.";
        $errorStatus = true;
    }
    
// If No Errors Found, Insert User Info into Database
    if(!$errorStatus){
        $username = stripslashes($_POST['username']);
        $username = mysqli_real_escape_string($conn, $username);
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $date_created = date("Y-m-D");
    
        $query = "INSERT into users (username, password, email, date_created)
        VALUES ('$username','$password','$email','$date_created')";
        mysqli_query($conn, $query);
        header("Location:login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="signupscript.js"></script>
    <link rel="stylesheet" href="signup.css">
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


<div class="bar"></div> 

<div class="image-container">
    <img src="image/SignUpPageBg.png" alt="Sign Up Page Background">
    <div class="text-over-image">Find the perfect job opportunities now</div>
</div>

<div class="signup-container">
    <h1>Sign Up</h1>

    <form id="signup-form" method="POST" action="signup.php" novalidate>

        <label for="username">Username:</lavel>
        <input type="text" id="username" name="username" class="signupinput" value='<?=$username?>' required> 
        <span class="error"><?=$usernameInvalid?></span> 
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" class="signupinput" value='<?=$email?>'required>
        <span class="error"><?=$emailInvalid?></span> 

        <label for="password">Create Password:</label>
        <input type="password" id="password" name="password" class="signupinput" value='<?=$password?>' required>

        <label for="confirm-password">Confirm Password:</label>
        <input type="password" id="confirm-password" name="confirm-password" required>
        <span class="error"><?=$passwordInvalid?></span> 

        <button type = "submit" class = "createAccButton" name='submit'><b>SIGN UP</b></button>
    </form>

    <p class="login-message">Already have an account? <a href="login.php">Login</a></p>
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


