<?php
// Include the database connection
include('db_connection.php'); // Update the path as needed

// Get the product ID from the URL query string (e.g., ?id=123)
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id === 0) {
    echo "Invalid product ID!";
    exit;
}

// Fetch the product details from the database
$query = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $product_id);
$stmt->execute();
$product_result = $stmt->get_result();

if ($product_result->num_rows === 0) {
    echo "Product not found!";
    exit;
}

$product = $product_result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="css/editProduct.css">
</head>
<body>
    <h1>Edit Product</h1>

    <!-- Display the product in a form for editing -->
    <form action="update_product.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($product['category']); ?>" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" step="0.01" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description"><?php echo htmlspecialchars($product['description']); ?></textarea>

        <label for="image_url">Image URL:</label>
        <input type="text" id="image_url" name="image_url" value="<?php echo htmlspecialchars($product['image_url']); ?>">

        <button type="submit">Update Product</button>
    </form>

    <a href="VendorDashboard.php">Back to Product List</a>
</body>
</html>
