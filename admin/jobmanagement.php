<?php
session_start();
$host = 'localhost';
$dbname = 'hopedb';
$user = 'root';
$password = '';
$attr = "mysql:host=$host;dbname=$dbname";
$table = 'hopejobs';

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
$jobs = [];
if ($isAdmin) {
    try {
        // If the user is an admin, fetch user data from the job database
        $stmt = $db->prepare("SELECT JobID, JobName, Company, Description, Address, DatePosted, SalaryMonth FROM hopejobs");
        $stmt->execute();
        $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching jobs: " . $e->getMessage();
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Management</title>
    <link rel="stylesheet" href="jobmanagementstyle.css"> 
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
    echo "<h1>Job Management</h1>";
    // Same Function as shown in user management but for retrieving Job attributes
    echo "<table>";
    echo "<tr><th>JobID</th><th>JobName</th><th>Company</th><th>Description</th><th>Address</th><th>DatePosted</th><th>SalaryMonth</th><th>Action</th></tr>";

    foreach ($jobs as $job) {
        echo "<tr>";
        echo "<td>{$job['JobID']}</td>";
        echo "<td>{$job['JobName']}</td>";
        echo "<td>{$job['Company']}</td>";
        echo "<td>{$job['Description']}</td>";
        echo "<td>{$job['Address']}</td>";
        echo "<td>{$job['DatePosted']}</td>";
        echo "<td>{$job['SalaryMonth']}</td>";
        echo "<td><a href='editjob.php?id={$job['JobID']}'>Edit</a> | <a href='deletejob.php?id={$job['JobID']}' onclick='return confirm(\"Are you sure you want to delete this job?\")'>Delete</a></td>";
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
