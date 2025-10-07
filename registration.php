<?php
// Include the database connection file
include 'db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Street Market Registration</title>
  <link rel="stylesheet" href="css/register.css">
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
            <li><a href="login.php">Login</a></li>
            <li><a href="AdminLogin.php">Admin Login</a></li>
        </ul>
    </nav>
  </header>

  <!-- Main Registration Section -->
  <section class="registration-section">
    <div class="registration-container">
      <h2>Create Your Account</h2>
      <form class="registration-form" method="POST" action="">
    <label for="fullname">Full Name</label>
    <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required>

    <label for="phone">Mobile Number</label>
    <input type="tel" id="phone" name="phone" placeholder="Enter your phone" pattern="[0-9]{10}" maxlength="10" required>

    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="Choose a username" required>
    
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Create a password" maxlength="10" required>

    <label for="confirm-password">Confirm Password</label>
    <input type="password" id="confirm-password" name="confirm-password" placeholder="Re-enter your password" maxlength="10" required>

    <label for="address">Address</label>
    <textarea id="address" name="address" placeholder="Enter your address" rows="2" required></textarea>

    <button type="submit">Register</button>
    <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
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
    <form>
        <label for="newsletter">Subscribe for Updates</label>
        <input type="email" id="newsletter" placeholder="Your email" required>
        <button>Subscribe</button>
    </form>
  </footer>
  <script src="script/script.js"></script>
</body>
</html>
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $confirm_password = $_POST['confirm-password'];

    if ($password !== $confirm_password) {
      echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
      exit();  // Stop the script execution if passwords do not match
  }

    // Directly embedding values into the SQL query (Insecure approach)
    $sql = "INSERT INTO users (full_name, email, phone, username, password, address) 
            VALUES ('$full_name', '$email', '$phone', '$username', '$password', '$address')";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful!'); window.location.href = 'login.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.history.back();</script>";
    }

    // Close the connection
    $conn->close();
}
?>
