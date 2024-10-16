<html>
  <head>
    <title>About Us</title>
    <meta charset="utf-8">
    <meta name = "viewport" content = "width=device-width, intiial-scale=1.0">
    <link rel="stylesheet" href="aboutstyle.css">
  </head>
  <body>
     <div class = "navbar">
     <a href="home.php">
        <img src="image/logo.png" class="logo" alt="Logo"></a>
        <ul>
        <?php
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
    <div class="heading">
      <h1>About Us</h1>
      <p>Homelessness is a pressing issue characterized by individuals lacking stable and adequate shelter.</p>
    </div>
    <div class="container">
      <section class = "about">
        <div class="about-image">
          <img src = "image/sdg.jpg">
        </div>
        <div class="about-content">
        <h2>In Support of SDG 11</h2>
        <p>Welcome to Hired Hope, a dedicated platform committed to transforming lives through employment opportunities. 
        At Hired Hope, we believe in the power of meaningful work to uplift individuals and communities. 
        Our mission aligns with the principles of Sustainable Development Goal 11, as we strive to create a world 
        where everyone has access to safe and affordable housing. 
        By connecting job seekers, especially those facing homelessness, with employment opportunities, 
        we aim to break the cycle of poverty and contribute to building resilient and inclusive urban spaces. 
        Join us in making a positive impact, one job at a time, and let's work together towards a future where every 
        individual has the chance to thrive.</p>
        <a href ="" class="read-more">Read More</a>
        </div>
      </section>
    </div>

</html>