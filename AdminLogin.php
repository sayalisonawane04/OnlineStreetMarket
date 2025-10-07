<?php
// Include the database connection file
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Street Market Login</title>
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

  <!-- Header Section -->
  <header>
    <div class="logo">
        <i class="fas fa-shopping-basket"></i> City Street Marts
    </div>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About Us</a></li>
        </ul>
    </nav>
  </header>

  <!-- Main Login Section -->
  <section class="login-section">
    <div class="login-container">
      <h2>ADMIN LOGIN</h2>
      <form class="login-form" method="POST" action="">
        <label for="username">Admin Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
        
        <label for="password">Admin Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" maxlength="10" required>
        <p id="password-error" style="color: red;"></p>

        <button type="submit" onclick="return validatePassword()">Login</button>
        
      </form>
    </div>
  </section>

  <!-- Footer Section -->
  <footer>
    <div>About Us | Privacy Policy | Terms of Service</div>
    <div class="social-media">Follow us:
        <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
    </div>
    <div>Contact Us: 8975591487 / 7796430667</div>
</footer>
<script src="script/script.js"></script>
</body>
</html>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to find the admin in the admin table
    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Fetch user data and set session variables if needed
        $admin = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];

        // Redirect to the admin dashboard
        header("Location: admin/AdminDashboard.php");
        exit();
    } else {
        // Login failed, show an error message
        echo "<p style='color:red;'>Invalid username or password</p>";
    }
}
?>