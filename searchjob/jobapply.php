<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <link rel="stylesheet" href="jobapplystyle.css">

    <script>
        function validateForm() {
            // Retrieve values from form fields.
            var firstName = document.getElementById("first_name").value;
            var lastName = document.getElementById("last_name").value;
            var address = document.getElementById("address").value;
            var gender = document.getElementById("gender").value;
            var dob = document.getElementById("dob").value;
            var contactNumber = document.getElementById("contact_number").value;
            var civilStatus = document.getElementById("civil_status").value;
            var email = document.getElementById("email").value;
            var qualification = document.getElementById("qualification").value;
            var resume = document.getElementById("resume").value;
            // Check if any field is empty.
            if (firstName === "" || lastName === "" || address === "" || gender === "" || dob === ""
                || contactNumber === "" || civilStatus === "" || email === "" || qualification === "" || resume === "") {
                alert("All fields must be filled out");
                return false;
            }
            // Email Validation
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="banner">
        <div class="navbar">
        <a href="../home.php">
        <img src="image/logo.png" class="logo" alt="Logo"></a>
        <ul>
        <?php
        session_start();
        if (!isset($_SESSION['id'])) {
          header("Location: ../login.php");
          exit();
        }
        if (isset($_SESSION['id'])) {
          echo '<li><a href="../userprofile.php">Profile</a></li>';
          if (isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == 1) {
            echo '<li><a href="../admin/adminpage.php">Admin</a></li>';
          }
          echo '<li><a href="../logout.php">Logout</a></li>';
        } else {
            echo '<li><a href="../login.php">Log In</a></li>';
            echo '<li><a href="../signup.php">Sign Up</a></li>';
          }
        ?>
        </ul>
        </div>
    </div>
    <h2>Job Application Form</h2>
    <div class="container">
        <div class="applicant-form">
            <!-- Form for obtaining applicant's personal details -->
            <h1>Personal Info</h1>
            <form method="post" action="processapplication.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div><br>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
            </div><br>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div><br>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div><br>

            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>
            </div><br>

            <div class="form-group">
                <label for="contact_number">Contact Number:</label>
                <input type="tel" id="contact_number" name="contact_number" required>
            </div><br>

            <div class="form-group">
                <label for="civil_status">Civil Status:</label>
                <select id="civil_status" name="civil_status" required>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                </select>
            </div><br>

            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>
            </div><br>

            <div class="form-group">
                <label for="qualification">Highest Qualification:</label>
                <input type="text" id="qualification" name="qualification" required>
            </div><br>

            <div class="form-group">
                    <label for="resume">Attach Resume:</label>
                    <input type="file" id="resume" name="resume" accept=".pdf, .doc, .docx" required>
                </div>

                <div class="button-container">
                    <a href="home.php">
                        <button type="button">Back</button>
                    </a>
                    <button type="submit" onclick="return validateForm()">Submit Application</button>
                </div>
            </form>
        </div>
        
    <?php
    $con = new PDO("mysql:host=localhost;dbname=hopedb", 'root', '');

    if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    // Fetch job details from the database based on the provided job ID
    $sth = $con->prepare("SELECT * FROM `hopejobs` WHERE JobID = :job_id");
    $sth->bindParam(':job_id', $job_id);
    $sth->execute();

    $row = $sth->fetch(PDO::FETCH_OBJ);
    // Display job details if the job is found
    if ($row) {
        echo "<div class='job-details'>";
        echo "<h1 class='job-title'>{$row->Company} - {$row->JobName}</h1>";
        echo "<p class='job-info'><span>Salary:</span><br><br>&emsp;&emsp;{$row->SalaryMonth}</p>";
        echo "<p class='job-info'><span>Job Description:</span><br><br>&emsp;&emsp;{$row->Description}</p>";
        echo "<p class='job-info'><span>Company:</span><br><br>&emsp;&emsp;{$row->Company}</p>";
        echo "<p class='job-info'><span>Address:</span><br><br>&emsp;&emsp;{$row->Address}</p>";
        echo "<p class='job-info'><span>Date Posted:</span><br><br>&emsp;&emsp;{$row->DatePosted}</p><br>";
        echo "</div>";
    } else {
        echo "Job not found.";
    }
    } else {
        echo "Invalid request. Job ID not specified.";
        }
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = new PDO("mysql:host=localhost;dbname=hopedb", 'root', '');
    // Retrieve applicant information from the submitted form
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];
    $contactNumber = $_POST["contact_number"];
    $civilStatus = $_POST["civil_status"];
    $email = $_POST["email"];
    $qualification = $_POST["qualification"];
    $resume = $_POST["resume"];

    // Insert applicant information into the 'applicants' table in the database
    $sth = $con->prepare("INSERT INTO applicants 
                          (first_name, last_name, address, gender, dob, contact_number, civil_status, email, qualification, resume) 
                          VALUES 
                          (:first_name, :last_name, :address, :gender, :dob, :contact_number, :civil_status, :email, :qualification, :resume)");

    $sth->bindParam(':first_name', $firstName);
    $sth->bindParam(':last_name', $lastName);
    $sth->bindParam(':address', $address);
    $sth->bindParam(':gender', $gender);
    $sth->bindParam(':dob', $dob);
    $sth->bindParam(':contact_number', $contactNumber);
    $sth->bindParam(':civil_status', $civilStatus);
    $sth->bindParam(':email', $email);
    $sth->bindParam(':qualification', $qualification);
    $sth->bindParam(':resume', $resume);

    $sth->execute();
}
?>


    