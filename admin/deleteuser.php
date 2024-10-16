<?php
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
        $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userID);
        $stmt->execute();

        echo "<p>User deleted successfully!</p>";
    } catch (PDOException $e) {
        echo "Error deleting user: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link rel="stylesheet" href="deleteuserstyle.css">
</head>
<body>
    <div class="banner">
        <div class="navbar">
            <a href="../home.php">
                <img src="image/logo.png" class="logo" alt="Logo">
            </a>
        </div>
    </div>
    <h1>Delete User</h1>

    <form method="post">
        <p>Are you sure you want to delete the user "<?php echo $user['username']; ?>"?</p>
        <button type="submit">Delete User</button>
    </form>

    <div class="button-container">
        <button class="back-button">
            <a href="usermanagement.php">Back to User Management</a>
        </button>
    </div>
</body>
</html>
