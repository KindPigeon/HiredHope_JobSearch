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

$applicantID = $_GET['id'];
try {
    $stmt = $db->prepare("SELECT id, first_name, last_name, address, gender, dob, contact_number, civil_status, email, qualification, resume FROM applicants WHERE id = :id");
    $stmt->bindParam(':id', $applicantID);
    $stmt->execute();
    $applicant = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$applicant) {
        echo "<p>Applicant not found.</p>";
        exit;
    }
} catch (PDOException $e) {
    echo "Error fetching applicant: " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $db->prepare("UPDATE applicants SET 
                            first_name = :first_name, 
                            last_name = :last_name, 
                            address = :address, 
                            gender = :gender, 
                            dob = :dob, 
                            contact_number = :contact_number, 
                            civil_status = :civil_status, 
                            email = :email, 
                            qualification = :qualification, 
                            resume = :resume 
                            WHERE id = :id");

        $stmt->bindParam(':first_name', $_POST['first_name']);
        $stmt->bindParam(':last_name', $_POST['last_name']);
        $stmt->bindParam(':address', $_POST['address']);
        $stmt->bindParam(':gender', $_POST['gender']);
        $stmt->bindParam(':dob', $_POST['dob']);
        $stmt->bindParam(':contact_number', $_POST['contact_number']);
        $stmt->bindParam(':civil_status', $_POST['civil_status']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':qualification', $_POST['qualification']);
        $stmt->bindParam(':resume', $_POST['resume']);
        $stmt->bindParam(':id', $applicantID);
        
        $stmt->execute();

        echo "<p>Applicant information updated successfully!</p>";
    } catch (PDOException $e) {
        echo "Error updating applicant information: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Application</title>
    <link rel="stylesheet" href="editapplicationstyle.css">
</head>
<body>
<div class="banner">
    <div class="navbar">
        <a href="../home.php">
            <img src="image/logo.png" class="logo" alt="Logo">
        </a>
    </div>
</div>

<h1>Edit Application</h1>

<form method="post">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" value="<?php echo $applicant['first_name']; ?>" required><br>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" value="<?php echo $applicant['last_name']; ?>" required><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo $applicant['address']; ?>" required><br>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="male" <?php echo ($applicant['gender'] === 'male') ? 'selected' : ''; ?>>Male</option>
        <option value="female" <?php echo ($applicant['gender'] === 'female') ? 'selected' : ''; ?>>Female</option>
        <option value="other" <?php echo ($applicant['gender'] === 'other') ? 'selected' : ''; ?>>Other</option>
    </select><br>

    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" value="<?php echo $applicant['dob']; ?>" required><br>

    <label for="contact_number">Contact Number:</label>
    <input type="tel" id="contact_number" name="contact_number" value="<?php echo $applicant['contact_number']; ?>" required><br>

    <label for="civil_status">Civil Status:</label>
    <select id="civil_status" name="civil_status" required>
        <option value="single" <?php echo ($applicant['civil_status'] === 'single') ? 'selected' : ''; ?>>Single</option>
        <option value="married" <?php echo ($applicant['civil_status'] === 'married') ? 'selected' : ''; ?>>Married</option>
        <option value="divorced" <?php echo ($applicant['civil_status'] === 'divorced') ? 'selected' : ''; ?>>Divorced</option>
    </select><br>

    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email" value="<?php echo $applicant['email']; ?>" required><br>

    <label for="qualification">Highest Qualification:</label>
    <input type="text" id="qualification" name="qualification" value="<?php echo $applicant['qualification']; ?>" required><br>

    <label for="resume">Attach Resume:</label>
    <input type="file" id="resume" name="resume" accept=".pdf, .doc, .docx" required><br>

    <button type="submit">Update Application</button>
</form>


<button class='back-button'>
    <a href="applicationmanagement.php">Back to Application Management</a>
</button>

</body>
</html>
