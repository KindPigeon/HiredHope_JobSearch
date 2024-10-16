<?php
session_start();
$host = 'localhost';
$dbname = 'hopedb';
$user = 'root';
$password = '';
$attr = "mysql:host=$host;dbname=$dbname";
$table = 'applicants';

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

$applications = [];

if ($isAdmin) {
    try {
        // If the user is an admin, fetch user data from the application database
        $stmt = $db->prepare("SELECT id, first_name, last_name, address, gender, dob, contact_number, civil_status, email, qualification, resume FROM applicants");
        $stmt->execute();
        $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching applications: " . $e->getMessage();
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Management</title>
    <link rel="stylesheet" href="applicationmanagementstyle.css"> 
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
if ($isAdmin) {
    echo "<h1>Application Management</h1>";
    // Same Function as shown in user management but for retrieving Application attributes
    echo "<table>";
    echo "<tr><th>id</th><th>First Name</th><th>Last Name</th><th>Address</th><th>Gender</th><th>Date of Birth</th><th>Contact Number</th><th>Civil Status</th><th>Email</th><th>Qualification</th><th>Resume</th><th>Action</th></tr>";

    foreach ($applications as $application) {
        echo "<tr>";
        echo "<td>{$application['id']}</td>";
        echo "<td>{$application['first_name']}</td>";
        echo "<td>{$application['last_name']}</td>";
        echo "<td>{$application['address']}</td>";
        echo "<td>{$application['gender']}</td>";
        echo "<td>{$application['dob']}</td>";
        echo "<td>{$application['contact_number']}</td>";
        echo "<td>{$application['civil_status']}</td>";
        echo "<td>{$application['email']}</td>";
        echo "<td>{$application['qualification']}</td>";
        echo "<td>{$application['resume']}</td>";
        echo "<td><a href='editapplication.php?id={$application['id']}'>Edit</a> | <a href='deleteapplication.php?id={$application['id']}' onclick='return confirm(\"Are you sure you want to delete this application?\")'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<button class='back-button'><a href='adminpage.php'>Back to Admin Page</a></button>";
} else {
    echo "<p>You don't have permission to access this page.</p>";
}
?>

</body>
</html>
