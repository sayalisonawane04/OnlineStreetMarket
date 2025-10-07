<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/html/CITY_STREET_MART/login.php");
    exit;
}

// Include the database connection file
include 'db.php'; 
$productId = isset($_GET['id']) ? $_GET['id'] : 0;
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
// If product ID is not provided or invalid, show an error
if (empty($productId) || !is_numeric($productId)) {
    echo "Invalid product ID.";
    exit;
}

// Prepare SQL statement to get product details using MySQLi
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);

// Bind the productId parameter (i for integer type)
$stmt->bind_param("i", $productId);

// Execute the statement
$stmt->execute();

// Get the result of the query
$result = $stmt->get_result();

// Fetch the product data as an associative array
$row = $result->fetch_assoc();

// Check if product is found
if (!$row) {
    echo "<script>alert('Invalid product.'); window.history.back();</script>";
        exit;
}

// Calculate the total price
$totalPrice = $row['price'] * $quantity;

$_SESSION['totalPrice'] = $totalPrice;
$_SESSION['productId'] = $productId;

// Close the statement
$stmt->close();

// Optional: You can close the database connection after this if no further queries are needed
// $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Now</title>
    <link rel="stylesheet" href="css/orderNow.css"> <!-- Link your CSS file here -->
</head>
<body>
    <div class="order-container">
        <!-- Shipping Information Section -->
        <section class="shipping-info">
            <h2>Shipping Information</h2>
            <form action="processOrder.php" method="POST" id="order-form">
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="address">Shipping Address:</label>
                    <textarea id="address" name="address" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <h3>Product: <?php echo htmlspecialchars($row['name']); ?> (Quantity: <?php echo htmlspecialchars($quantity); ?>)</h3>
                <p>Total Price: $<?php echo number_format($totalPrice, 2); ?></p>

                <!-- Submit Button -->
                <div class="submit-section">
                    <button type="submit" class="btn-submit">Place Order</button>
                </div>
            </form>
        </section>
    </div>
    <script>
document.getElementById('order-form').addEventListener('submit', function(event) {
    // Get form elements
    var name = document.getElementById('name').value;
    var address = document.getElementById('address').value;
    var phone = document.getElementById('phone').value;
    var email = document.getElementById('email').value;
    var phonePattern = /^[0-9]{10}$/; // Simple phone number validation (10 digits)
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Simple email validation pattern

    // Validate Full Name
    if (name.trim() === "") {
        alert("Full Name is required.");
        event.preventDefault(); // Prevent form submission
        return;
    }

    // Validate Shipping Address
    if (address.trim() === "") {
        alert("Shipping Address is required.");
        event.preventDefault();
        return;
    }

    // Validate Phone Number
    if (phone.trim() === "") {
        alert("Phone Number is required.");
        event.preventDefault();
        return;
    } else if (!phone.match(phonePattern)) {
        alert("Please enter a valid phone number (10 digits).");
        event.preventDefault();
        return;
    }

    // Validate Email Address
    if (email.trim() === "") {
        alert("Email Address is required.");
        event.preventDefault();
        return;
    } else if (!email.match(emailPattern)) {
        alert("Please enter a valid email address.");
        event.preventDefault();
        return;
    }

    // If all fields are valid, allow form submission
});
</script>

</body>
</html>
<?php

