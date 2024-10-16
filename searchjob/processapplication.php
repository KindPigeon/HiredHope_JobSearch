<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <link rel="stylesheet" href="processapplicationstyle.css">
</head>
<body>
    <div class="banner">
        <div class="navbar">
        <a href="../home.php">
        <img src="image/logo.png" class="logo" alt="Logo"></a>
        <ul>
        <?php
        session_start();
        if (!isset($_SESSION['id'])) {
          header("Location: login.php");
          exit();
        }
        if (isset($_SESSION['id'])) {
          echo '<li><a href="../userprofile.php">Profile</a></li>';
          if (isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == 1) {
            echo '<li><a href="../admin/adminpage.php">Admin</a></li>';
          }
          echo '<li><a href="../logout.php">Logout</a></li>';
        } else {
            echo '<li><a href="../login.php">Log In</a></li>';
            echo '<li><a href="../signup.php">Sign Up</a></li>';
          }
        ?>
        </ul>
        </div>
    </div>
    <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = new PDO("mysql:host=localhost;dbname=hopedb", 'root', '');
    $uploadDir = ""; 
    $uploadFile = $uploadDir . basename($_FILES['resume']['name']);

    if (move_uploaded_file($_FILES['resume']['tmp_name'], $uploadFile)) {
        $con = new PDO("mysql:host=localhost;dbname=hopedb", 'root', '');

        $firstName = $_POST["first_name"];
        $lastName = $_POST["last_name"];
        $address = $_POST["address"];
        $gender = $_POST["gender"];
        $dob = $_POST["dob"];
        $contactNumber = $_POST["contact_number"];
        $civilStatus = $_POST["civil_status"];
        $email = $_POST["email"];
        $qualification = $_POST["qualification"];

        $sth = $con->prepare("INSERT INTO applicants 
                            (first_name, last_name, address, gender, dob, contact_number, civil_status, email, qualification, resume) 
                            VALUES 
                            (:first_name, :last_name, :address, :gender, :dob, :contact_number, :civil_status, :email, :qualification, :resume)");

        $sth->bindParam(':first_name', $firstName);
        $sth->bindParam(':last_name', $lastName);
        $sth->bindParam(':address', $address);
        $sth->bindParam(':gender', $gender);
        $sth->bindParam(':dob', $dob);
        $sth->bindParam(':contact_number', $contactNumber);
        $sth->bindParam(':civil_status', $civilStatus);
        $sth->bindParam(':email', $email);
        $sth->bindParam(':qualification', $qualification);
        $sth->bindParam(':resume', $_FILES['resume']['name']); 

        $sth->execute();
        
        echo "<div class='status-message'>Data inserted successfully.</div>";
    } else {
        echo "<div class='status-message'>Data not inserted.</div>";
    }
}
?>
<div class="back-buttons">
    <a href="searchname.php">
        <button type="button">Back</button>
    </a>
    </div>
    </body>
</html>
