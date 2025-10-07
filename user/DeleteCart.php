<?php
// Start session to retrieve user information
session_start();

// Include database connection
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User is not logged in."]);
    exit;
}

// Get the cart_id from the URL query parameters
if (isset($_GET['cart_id'])) {
    $cart_id = $_GET['cart_id'];
    $user_id = $_SESSION['user_id'];

    // Prepare SQL query to delete the cart item
    $sql = "DELETE FROM usercart WHERE cart_id = ? AND user_id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters to the SQL query
        $stmt->bind_param("ii", $cart_id, $user_id);

        // Execute the query
        if ($stmt->execute()) {
            // Success: Return JSON response
            echo json_encode(["status" => "success", "message" => "Cart item deleted successfully!"]);
        } else {
            // Error: Return JSON response with error message
            echo json_encode(["status" => "error", "message" => "Error deleting cart item: " . $stmt->error]);
        }

        // Close the statement
        $stmt->close();
    } else {
        // Error: Return JSON response with error preparing query
        echo json_encode(["status" => "error", "message" => "Error preparing query: " . $conn->error]);
    }
} else {
    // Error: No cart_id provided
    echo json_encode(["status" => "error", "message" => "Cart ID not provided."]);
}

// Close the database connection
$conn->close();
?>
