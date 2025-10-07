<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/html/CITY_STREET_MART/login.php");
    exit;
}

require 'db.php'; // Include database connection

// Get the product ID and quantity from the query parameters
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$quantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1;

// Check if the product ID and quantity are valid
if ($product_id <= 0 || $quantity <= 0) {
    echo "Invalid product ID or quantity.";
    exit;
}

// Get the product details from the database
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id); // Bind product ID
$stmt->execute();
$result = $stmt->get_result();

// Check if the product exists
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    // Calculate the total price
    $total_price = $product['price'] * $quantity;

    // Get the logged-in user's ID from the session
    $user_id = $_SESSION['user_id'];

    // Insert the product into the user's cart
    $insert_sql = "INSERT INTO usercart (user_id, product_id, quantity, total_price) 
                   VALUES (?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("iiii", $user_id, $product_id, $quantity, $total_price);

    // Execute the query
    if ($insert_stmt->execute()) {
        // Set a session variable to show success alert on the product description page
        $_SESSION['cart_success'] = "Product successfully added to your cart!";
        
        // Redirect to the product description page with the same product ID and quantity
        header("Location: productdescription.php?id=" . $product_id . "&quantity=" . $quantity);
        exit; // Ensure the script stops after the redirect
    } else {
        echo "Error adding product to the cart. Please try again.";
    }

    $insert_stmt->close();
} else {
    echo "Product not found!";
}

$stmt->close();
?>
