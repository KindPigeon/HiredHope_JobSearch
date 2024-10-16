<?php
session_start();
// Database connection
$host = 'localhost';
$dbname = 'hopedb';
$user = 'root';
$password = '';
$attr = "mysql:host=$host;dbname=$dbname";
$table = 'users';

try {
    $db = new PDO($attr, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
// Check if the user is logged in and has admin privileges
if (isset($_SESSION['id']) && isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == 1) {
    $isAdmin = true;
} else {
    $isAdmin = false;
}
$users = [];
// If the user is an admin, fetch user data from the user database
if ($isAdmin) {
    try {
        $stmt = $db->prepare("SELECT id, username, email, location FROM users");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching users: " . $e->getMessage();
        exit;
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="usermanagementstyle.css">
</head>
<body>
<div class="banner">
    <div class="navbar">
    <a href="../home.php">
    <img src="image/logo.png" class="logo" alt="Logo"></a>
    </div>
</div>
<?php
if ($isAdmin) {
    echo "<h1>User Management</h1>";
    // HTML to present data taken from table via PHP
    echo "<table>";
    echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Location</th><th>Action</th></tr>";

    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>{$user['id']}</td>";
        echo "<td>{$user['username']}</td>";
        echo "<td>{$user['email']}</td>";
        echo "<td>{$user['location']}</td>";
        // Provide Edit and Delete links with user IDs
        echo "<td><a href='edituser.php?id={$user['id']}'>Edit</a> | <a href='deleteuser.php?id={$user['id']}'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    // Provide a Back button to return to the Admin Page
    echo "<button class='back-button'><a href='adminpage.php'>Back to Admin Page</a></button>";
} else {
    // Display a message if the user doesn't have permission to access this page
    echo "<p>You don't have permission to access this page.</p>";
}
?>

</body>
</html>
