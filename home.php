<html>
  <head>
    <title>Hired Hope</title>
    <link rel="stylesheet" href="homestyle.css">
  </head>
  <body>
    <div class="banner">
      <div class = "navbar">
      <a href="home.php">
        <img src="image/logo.png" class="logo" alt="Logo"></a>
        <ul>
        <?php //Navigationbar/Header where if user is admin adds an extra link to admin and if not does not show link
        session_start();
        if (!isset($_SESSION['id'])) {
          header("Location: login.php");
          exit();
        }
        if (isset($_SESSION['id'])) {
          echo '<li><a href="userprofile.php">Profile</a></li>';
          if (isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == 1) {
            echo '<li><a href="admin/adminpage.php">Admin</a></li>';
          }
          echo '<li><a href="logout.php">Logout</a></li>';
        } else {
            echo '<li><a href="login.php">Log In</a></li>';
            echo '<li><a href="signup.php">Sign Up</a></li>';
          }
        ?>
        </ul>
      </div>
    <div class="part1">
      <h1>Seek a Job with us Today</hi>
      <p>A Job Seeking Platform Inclusive and <br>Supporting People Suffering Homelessness</p>
      <div class="jobButton">
      <a href="searchjob/searchname.php">
        <button type = "button"><span>Find Job</span></button></a>
      <a href="about.php">
        <button type = "button"><span>About Us</span ></button></a>
      <a href="socialnetworking.html">
        <button type = "button"><span>Networking</span ></button></a>
      </div>
    </div>

</html>