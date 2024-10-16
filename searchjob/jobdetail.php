<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <link rel="stylesheet" href="jobdetailstyle.css">
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

    <?php
    $con = new PDO("mysql:host=localhost;dbname=hopedb", 'root', '');
// Checks and retrieve the job ID from the URL.
    if (isset($_GET['job_id'])) {
        $job_id = $_GET['job_id'];
// Execute a SQL SELECT statement to fetch job details.
        $sth = $con->prepare("SELECT * FROM `hopejobs` WHERE JobID = :job_id");
        $sth->bindParam(':job_id', $job_id);
        $sth->execute();

        $row = $sth->fetch(PDO::FETCH_OBJ);

        if ($row) {
            ?>
            <h2>Job Details</h2>
            <!-- Display job details in HTML format. -->
            <div class="job-details">
                <h1 class="job-title"><?php echo $row->Company . ' - ' . $row->JobName; ?></h1>
                <p class="job-info"><span>Salary:</span><br><br>&emsp;&emsp;$<?php echo $row->SalaryMonth; ?></p>
                <p class="job-info"><span>Job Description:</span><br><br>&emsp;&emsp; <?php echo $row->Description; ?></p>
                <p class="job-info"><span>Company:</span><br><br>&emsp;&emsp; <?php echo $row->Company; ?></p>
                <p class="job-info"><span>Address:</span><br><br>&emsp;&emsp; <?php echo $row->Address; ?></p>
                <p class="job-info"><span>Date Posted:</span><br><br>&emsp;&emsp; <?php echo $row->DatePosted; ?></p><br>
                <a href="jobapply.php?job_id=<?php echo $row->JobID; ?>">
                <button type="button"><span>Apply Now!</span></button></a>

            </div>
            <?php
        } else { // Display a message if the job is not found.
            echo "Job not found.";
        }
    } else { // Display a message for an invalid request.
        echo "Invalid request.";
    }
    ?>
</body>
</html>
