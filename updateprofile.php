<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="updateprofilestyle.css">
</head>
<body>
    <div class="banner">
        <div class="navbar">
            <a href="home.php">
                <img src="image/logo.png" class="logo" alt="Logo">
            </a>
            <ul>
        <?php
        if (!isset($_SESSION['id'])) {
          header("Location: login.php");
          exit();
        }
        if (isset($_SESSION['id'])) {
          echo '<li><a href="userprofile.php">Profile</a></li>';
          if (isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == 1) {
            echo '<li><a href="admin/adminpage.php">Admin</a></li>';
          }
          echo '<li><a href="logout.php">Logout</a></li>';
        } else {
            echo '<li><a href="login.php">Log In</a></li>';
            echo '<li><a href="signup.php">Sign Up</a></li>';
          }
        ?>
        </ul>
        </div>
    </div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $host = 'localhost';
    $dbname = 'hopedb';
    $user = 'root';
    $password = '';
    $attr = "mysql:host=$host;dbname=$dbname";
    $table = 'users';

    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit;
    }
    $userID = $_SESSION['id'];
 // Prepare and execute an SQL UPDATE statement to modify user profile information.
    try {
        $stmt = $db->prepare("UPDATE users SET 
    biography = :biography,
    career_history = :career_history,
    education = :education,
    certification = :certification,
    skills = :skills,
    languages = :languages,
    resume_path = :resume_path
    WHERE id = :id");
// Bind form data to SQL parameters.
    $stmt->bindParam(':biography', $_POST['biography']);
    $stmt->bindParam(':career_history', $_POST['career_history']);
    $stmt->bindParam(':education', $_POST['education']);
    $stmt->bindParam(':certification', $_POST['certification']);
    $stmt->bindParam(':skills', $_POST['skills']);
    $stmt->bindParam(':languages', $_POST['languages']);
    $stmt->bindParam(':resume_path', $_POST['resume_path']);
    $stmt->bindParam(':id', $userID);

// Execute
        $stmt->execute();

        echo "<div class='success-message'>Profile updated successfully!</div>";

    } catch (PDOException $e) {
        echo "Error updating user profile: " . $e->getMessage();
    }
}
?>
<div class="back-buttons">
    <a href="userprofile.php">
        <button type="button">Back</button>
    </a>
    </div>
    </body>
</html>
