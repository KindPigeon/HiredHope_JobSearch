<?php
$isAdmin = true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="adminpagestyle.css">
</head>
<body>
    <div class="banner">
        <div class="navbar">
            <a href="../home.php">
                <img src="image/logo.png" class="logo" alt="Logo">
            </a>
        </div>
    </div>

<?php
    session_start();
    // Check if the user is logged in and is an admin
    if (isset($_SESSION['id']) && isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == 1) {
        $isAdmin = true;
    } else {
        $isAdmin = false;
    }
?>
<?php
    // Display content if admin else show no access message
    if ($isAdmin) {
        echo "<div class='admin-container'>";
        echo "<h1>Welcome, Admin!</h1>";
        echo "<p>To modify any of the following data, please press them!</p><br>";
        echo "<ul>";
        echo "<li><a href='usermanagement.php'>User Management</a></li>";
        echo "<li><a href='jobmanagement.php'>Job Management</a></li>";
        echo "<li><a href='applicationmanagement.php'>Application Management</a></li>";
        echo "</ul>";
        echo "</div>";
    } else {
        echo "<p>You don't have permission to access this page.</p>";
    }
?>
</body>
</html>
