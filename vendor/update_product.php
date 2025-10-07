<?php
// Include the database connection
include('db_connection.php'); // Update the path as needed

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $image_url = isset($_POST['image_url']) ? $_POST['image_url'] : '';

    // Validate the input
    if (!$id || !$name || !$category || !$price || !$quantity) {
        // If fields are missing, show an alert and return to the previous page
        echo "
        <script type='text/javascript'>
            alert('All fields are required!');
            window.history.back();
        </script>";
        exit; // Stop further execution of the script
    }

    // Prepare the SQL query to update the product
    $query = "UPDATE products SET name = ?, category = ?, price = ?, quantity = ?, description = ?, image_url = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssdiisi', $name, $category, $price, $quantity, $description, $image_url, $id);

    // Execute the query
    if ($stmt->execute()) {
        // Show success alert and then redirect to VendorDashboard.php
        echo "
        <script type='text/javascript'>
            alert('Product updated successfully!');
            window.location.href = 'VendorDashboard.php';
        </script>";
        exit; // Stop further execution of the script
    } else {
        // If update failed, show an error alert
        echo "
        <script type='text/javascript'>
            alert('Failed to update product.');
            window.history.back();
        </script>";
        exit; // Stop further execution of the script
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
