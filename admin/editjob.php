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

$jobID = $_GET['id'];
try {
    $stmt = $db->prepare("SELECT JobID, JobName, Company, Description, Address, DatePosted, SalaryMonth FROM hopejobs WHERE JobID = :id");
    $stmt->bindParam(':id', $jobID);
    $stmt->execute();
    $job = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$job) {
        echo "<p>Job not found.</p>";
        exit;
    }
} catch (PDOException $e) {
    echo "Error fetching job: " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $db->prepare("UPDATE hopejobs SET JobName = :jobName, Company = :company, Description = :description, Address = :address, DatePosted = :datePosted, SalaryMonth = :salaryMonth WHERE JobID = :id");
        $stmt->bindParam(':jobName', $_POST['jobName']);
        $stmt->bindParam(':company', $_POST['company']);
        $stmt->bindParam(':description', $_POST['description']);
        $stmt->bindParam(':address', $_POST['address']);
        $stmt->bindParam(':datePosted', $_POST['datePosted']);
        $stmt->bindParam(':salaryMonth', $_POST['salaryMonth']);
        $stmt->bindParam(':id', $jobID);
        $stmt->execute();

        echo "<p>Job information updated successfully!</p>";
    } catch (PDOException $e) {
        echo "Error updating job information: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Job</title>
    <link rel="stylesheet" href="editjobstyle.css">
</head>
<body>
<div class="banner">
    <div class="navbar">
        <a href="../home.php">
        <img src="image/logo.png" class="logo" alt="Logo"></a>
    </div>
</div>
<h1>Edit Job</h1>

<form method="post">
    <label for="jobName">Job Name:</label>
    <input type="text" id="jobName" name="jobName" value="<?php echo $job['JobName']; ?>" required><br>

    <label for="company">Company:</label>
    <input type="text" id="company" name="company" value="<?php echo $job['Company']; ?>" required><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required><?php echo $job['Description']; ?></textarea><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo $job['Address']; ?>" required><br>

    <label for="datePosted">Date Posted:</label>
    <input type="date" id="datePosted" name="datePosted" value="<?php echo $job['DatePosted']; ?>" required><br>

    <label for="salaryMonth">Salary/Month:</label>
    <input type="text" id="salaryMonth" name="salaryMonth" value="<?php echo $job['SalaryMonth']; ?>" required><br>

    <button type="submit">Update Job</button>
</form>
<button class='back-button'>
<a href="jobmanagement.php">Back to Job Management</a></button>

</body>
</html>
