<?php
// deleteProduct.php

session_start();

if(!isset($_SESSION['vendor_id'])) 
{
    header("Location:http://localhost/html/CITY_STREET_MART/VendorLogin.php");
    exit;
}

// Include your database connection file
include('db_connection.php'); // Make sure to replace this with your actual database connection

// Check if the product_id is passed
if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    
    // Sanitize the product ID to prevent SQL injection
    $productId = mysqli_real_escape_string($conn, $productId);

    // Prepare the delete query
    $query = "DELETE FROM products WHERE id = '$productId'";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Return success response
        echo json_encode(['success' => true]);
    } else {
        // Return failure response
        echo json_encode(['success' => false, 'message' => 'Failed to delete the product']);
    }
} else {
    // Return error if no product ID is provided
    echo json_encode(['success' => false, 'message' => 'No product ID provided']);
}

// Close the database connection
mysqli_close($conn);
?>

