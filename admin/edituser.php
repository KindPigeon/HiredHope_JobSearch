<?php
session_start();
$host = 'localhost';
$dbname = 'hopedb';
$user = 'root';
$password = '';
$attr = "mysql:host=$host;dbname=$dbname";

try {
    $db = new PDO($attr, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

if (isset($_SESSION['id']) && isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == 1) {
    $isAdmin = true;
} else {
    $isAdmin = false;
}
if (!$isAdmin || empty($_GET['id'])) {
    echo "<p>You don't have permission to access this page.</p>";
    exit;
}

$userID = $_GET['id'];
try {
    $stmt = $db->prepare("SELECT id, username, email FROM users WHERE id = :id");
    $stmt->bindParam(':id', $userID);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "<p>User not found.</p>";
        exit;
    }
} catch (PDOException $e) {
    echo "Error fetching user: " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $db->prepare("UPDATE users SET username = :username, email = :email WHERE id = :id");
        $stmt->bindParam(':username', $_POST['username']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':id', $userID);
        $stmt->execute();

        echo "<p>User information updated successfully!</p>";
    } catch (PDOException $e) {
        echo "Error updating user information: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="edituserstyle.css">
</head>
<body>
<div class="banner">
        <div class="navbar">
        <a href="../home.php">
        <img src="image/logo.png" class="logo" alt="Logo"></a>
        </div>
    </div>
<h1>Edit User</h1>

<form method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br>

    <button type="submit">Update User</button>
</form>
<button class='back-button'>
<a href="usermanagement.php">Back to User Management</a></button>

</body>
</html>
