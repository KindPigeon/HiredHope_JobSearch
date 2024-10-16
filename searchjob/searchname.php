<!DOCTYPE html>
<html>
<head>
    <title>Search by Job Name</title>
    <link rel="stylesheet" href="searchnamestyle.css">
</head>
<body>
    <div class="banner">
      <div class = "navbar">
        <a href="../home.php">
        <img src="image/logo.png" class="logo" alt="Logo"></a>
        <ul>
        <?php
        session_start();
        if (!isset($_SESSION['id'])) {
          header("Location: login.php");
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
    <div class="search-container">
    <h2>Search by Name</h2>
    <form method="post">
        <div class="input-group">
            <label for="search" class="search-label">SEARCH: </label>
            <input type="text" id="search" name="search" class="search-input">
        </div>
        <br>
        <input type="submit" name="submit" class="submit-button">
    </form>
</div>
</body>
</html>

<?php
$con = new PDO("mysql:host=localhost;dbname=hopedb", 'root', '');
// Check if the form has been submitted and retrives what was searched.
if (isset($_POST["submit"])) {
    $str = $_POST["search"];
// Execute a SQL SELECT statement to search for jobs based on search.
    $sth = $con->prepare("SELECT * FROM `hopejobs` WHERE JobName LIKE :search");
    $sth->bindValue(':search', '%' . $str . '%', PDO::PARAM_STR);

    $sth->setFetchMode(PDO::FETCH_OBJ);
    $sth->execute(); 
// Display results.
    if ($row = $sth->fetch()) {
        ?>
        
            <div class="results-container">
                <?php
                do {
                ?>
                    <div class="result-item">
                        <p><a href="jobdetail.php?job_id=<?php echo $row->JobID; ?>"><?php echo $row->JobName; ?></a></p>
                        <p><a1><?php echo $row->Company; ?></a1></p>
                        <br>
                        <p><?php echo $row->Description; ?></p>
                    </div>
                <?php
                } while ($row = $sth->fetch());
                ?>
            </div>
        
    <?php
    } else { // Display a message when no results are found.
        echo "<p class='no-results'>No results found.</p>";
    }
}
?>