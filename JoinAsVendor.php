<?php
// Include the database connection file
include 'db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vendor Registration Form</title>
  <link rel="stylesheet" href="css/JoinAsVendor.css">
</head>
<body>
  <form id="vendorForm" method="POST" action="">
    <!-- Row 1 -->
    <div class="form-row">
      <div class="form-group">
        <label for="fullName">Full Name</label>
        <input type="text" id="fullName" name="fullName" placeholder="Enter full name" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter email" required>
      </div>
    </div>

    <!-- Row 2 -->
    <div class="form-row">
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter phone number" pattern="[0-9]{10}" maxlength="10" required>
      </div>  
      <div class="form-group">
        <label for="username">Create Username</label>
        <input type="text" id="username" name="username" placeholder="Enter Your username" required>
      </div>   
    </div>

    <!-- Row 2 -->
    <div class="form-row">
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter Your Password" maxlength="10" required>
      </div>  
      <div class="form-group">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Your Password" required>
      </div>   
    </div>
    
    <!-- Row 4 -->
    <div class="form-row">
      <div class="form-group">
        <label for="storeName">Store Name</label>
        <input type="text" id="storeName" name="storeName" placeholder="Enter store name" required>
      </div>
      <div class="form-group">
        <label for="category">Category Of Your Store</label>
        <select id="category" name="category" required>
          <option value="" disabled selected>Select category</option>
          <option value="Vegetables">Vegetables</option>
          <option value="Food & Drinks">Food & Drinks</option>
          <option value="Crafts & Handmade">Crafts & Handmade</option>
          <option value="Clothing & Accessories">Clothing & Accessories</option>
          <option value="Art & Decors">Art & Decors</option>
        </select>
      </div> 
    </div>

    <!-- Row 3 -->
    <div class="form-row">
      <div class="form-group">
        <label for="place">Address ( Must Be Resident Of Nashik )</label>
        <textarea id="description" name="description" placeholder="Enter Your Address" rows="2" required></textarea>
      </div>
    </div>

    <!-- Full-Width Row for Business Description -->
    <div class="form-group full-width">
      <label for="description">Business Description</label>
      <textarea id="description" name="description" placeholder="Describe your business" rows="2" required></textarea>
    </div>

    <!-- Submit Button -->
    <div class="form-actions">
        <button type="submit">Submit</button>
    </div>
  </form>
  <script src="script/script.js"></script>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data directly
    $full_name = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $store_name = $_POST['storeName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $category = $_POST['category'];
    $business_description = $_POST['description'];

    // Directly embedding the values into the SQL query (insecure)
    $sql = "INSERT INTO vendor (full_name, email, phone, store_name, username, password, address, category, business_description)
            VALUES ('$full_name', '$email', '$phone', '$store_name', '$username', '$password', '$address', '$category', '$business_description')";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Vendor successfully added!'); window.location.href = 'VendorLogin.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.history.back();</script>";
    }

    // Close the connection
    $conn->close();
}
?>
