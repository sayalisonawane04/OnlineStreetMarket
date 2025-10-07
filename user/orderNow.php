<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/html/CITY_STREET_MART/login.php");
    exit;
}
// Include the database connection file
include 'db.php'; 

// Get product ID and quantity from query parameters
$productId = isset($_GET['id']) ? $_GET['id'] : '';
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
    echo "Product not found.";
    exit;
}

// Calculate the total price
$totalPrice = $row['price'] * $quantity;

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
        </section>

        <!-- QR Code Payment Section -->
        <section class="payment-qr">
            <h2>Pay via QR Code</h2>
            <p>Scan the QR code below to complete your payment:</p>
            <div class="qr-code">
                <img src="img/payment/QR.png" alt="QR Code for Payment">
            </div>
            <p>Alternatively, choose another payment method:</p>
        </section>

        <!-- Other Payment Methods -->
        <section class="other-payments">
            <h2>Other Payment Methods</h2>
            <div class="payment-icons">
                <img src="img/payment/googlepay.png" alt="google pay">
                <img src="img/payment/BHIM.png" alt="BHIM">
                <img src="img/payment/paytm.png" alt="paytm">
            </div>
        </section>

        <!-- Submit Button -->
        <div class="submit-section">
            <button type="submit" class="btn-submit">Place Order</button>
        </div>
            </form>
    </div>
</body>
</html>
