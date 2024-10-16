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
if (empty($_GET['id'])) {
    echo "<p>Application ID not provided.</p>";
    exit;
}

$applicationID = $_GET['id'];

try {
    $stmt = $db->prepare("DELETE FROM applicants WHERE id = :id");
    $stmt->bindParam(':id', $applicationID);
    $stmt->execute();

    $message = "Application deleted successfully!";
} catch (PDOException $e) {
    $message = "Error deleting application: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Application</title>
    <link rel="stylesheet" href="deleteapplicationstyle.css">
</head>
<body>
    <div class="banner">
        <div class="navbar">
            <a href="../home.php">
                <img src="image/logo.png" class="logo" alt="Logo">
            </a>
        </div>
    </div>

    <h1>Delete Application</h1>
    
    <div class="message-container">
        <p><?php echo $message; ?></p>
    </div>

    <div class="button-container">
        <button class="back-button">
            <a href="applicationmanagement.php">Back to Application Management</a>
        </button>
    </div>
</body>
</html>
