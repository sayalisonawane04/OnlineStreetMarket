<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/html/CITY_STREET_MART/login.php");
    exit;
}

// Include the database connection file
include 'db.php'; 
$userId = $_SESSION['user_id'];
$totalAmount = $_SESSION['totalPrice'];  // The total price from the session
$productId = $_SESSION['productId'];    // The product ID from the session

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);

    // Simple validation for empty fields
    if (empty($name) || empty($address) || empty($phone) || empty($email)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit;
    }

    // Validate phone number format (assumes 10 digits)
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        echo "<script>alert('Invalid phone number format.'); window.history.back();</script>";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email address format.'); window.history.back();</script>";
        exit;
    }

    // Ensure productId and totalPrice are set in session
    if (!isset($_SESSION['productId']) || !isset($_SESSION['totalPrice'])) {
        echo "<script>alert('Product or price information missing.'); window.history.back();</script>";
        exit;
    }

    

    // Insert into orders table
    $orderDate = date('Y-m-d H:i:s');
    $orderStatus = 'Pending';
    $shippedBy = 'Our Delivery Partner'; // Default to null; can be updated later

    // Prepare the SQL query for inserting into the orders table
    $sqlOrder = "INSERT INTO orders (order_date, total_amount, user_id, order_status, shipped_by, product_id) 
                 VALUES (?, ?, ?, ?, ?, ?)";
    $stmtOrder = $conn->prepare($sqlOrder);
    $stmtOrder->bind_param("sdissd", $orderDate, $totalAmount, $userId, $orderStatus, $shippedBy, $productId);

    if ($stmtOrder->execute()) {
        // Retrieve the last inserted order ID
        $orderId = $stmtOrder->insert_id;
        $stmtOrder->close();

        // Insert into payment table
        $paymentDate = date('Y-m-d H:i:s');
        $paymentMethod = "Pay on Delivery"; // Assuming default payment method
        $paymentStatus = "Pending";        // Default status for payment

        // Prepare the SQL query for inserting into the payment table
        $sqlPayment = "INSERT INTO payment (order_id, payment_date, amount, payment_method, payment_status) 
                       VALUES (?, ?, ?, ?, ?)";
        $stmtPayment = $conn->prepare($sqlPayment);
        $stmtPayment->bind_param("isdss", $orderId, $paymentDate, $totalAmount, $paymentMethod, $paymentStatus);

        if ($stmtPayment->execute()) {
            // Order and payment successfully inserted
            echo "<script>
                alert('Order placed successfully!');
                window.location.href = 'success.php';
            </script>";
        } else {
            // Failed to insert payment
            echo "<script>alert('Failed to process payment.'); window.history.back();</script>";
        }
        $stmtPayment->close();
    } else {
        // Failed to insert order
        echo "<script>alert('Failed to place order.'); window.history.back();</script>";
    }
} else {
    // Invalid request method
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}
?>
