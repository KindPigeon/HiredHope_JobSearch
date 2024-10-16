<?php
session_start();
// Database connection parameters.
$host = 'localhost';
$dbname = 'hopedb';
$user = 'root';
$password = '';
$attr = "mysql:host=$host;dbname=$dbname";
$table = 'users';

// Attempt to establish a PDO database connection.
try {
    $db = new PDO($attr, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
// Check if a user session is active; redirect to login if not.
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
// Fetch user information based on the session's user ID.
$userID = $_SESSION['id'];
try {
    $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $userID);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
// If the user is not found, display an error message and exit
    if (!$user) {
        echo "User not found.";
        exit;
    }
    $username = $user['username'];
    $location = $user['location'];
    $email = $user['email'];
} catch (PDOException $e) {
    echo "Error fetching user information: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="userprofilestyle.css">
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
    <!-- Retrieves the user data from table in database based on user ID  -->
    <div class="profile-section"> 
        <div class="bannerprofile">
        <p><b><?php echo $username; ?></b></p>
        <p><?php echo $location; ?><img src="image/profilelocation.png" alt="Map Marker Icon"></p>
        <p><?php echo $email; ?><img src="image/profileemail.png" alt="Envelope Icon"></p>
        </div> 
        <form method="post" action="updateprofile.php">
        <label for="biography">Biography:</label>
        <textarea id="biography" name="biography"><?php echo $user['biography']; ?></textarea>

        <label for="career_history">Career History:</label>
        <textarea id="career_history" name="career_history"><?php echo $user['career_history']; ?></textarea>

        <label for="education">Education:</label>
        <textarea id="education" name="education"><?php echo $user['education']; ?></textarea>

        <label for="certification">Certification:</label>
        <textarea id="certification" name="certification"><?php echo $user['certification']; ?></textarea>

        <label for="skills">Skills:</label>
        <textarea id="skills" name="skills"><?php echo $user['skills']; ?></textarea>

        <label for="languages">Languages:</label>
        <textarea id="languages" name="languages"><?php echo $user['languages']; ?></textarea>

        <div class="form-buttons">
            <a href="home.php">
            <button type="button" class="back-button">Back</button>
            </a>
            <button type="submit">Update Profile</button>
        </div>

        </form>
    </div>
</body>
</html>
