<?php
session_start();
include 'db.php';

if(!isset($_SESSION['vendor_id'])) {
    header("Location:http://localhost/html/CITY_STREET_MART/VendorLogin.php");
    exit;
}

$vendor_id = $_SESSION['vendor_id'];

// Fetch all images from the folder
$uploadDir = 'img/products/';
$images = array_diff(scandir($uploadDir), array('..', '.')); // Get all files, excluding . and ..

// Form submission logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form submission
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    // Handle the image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Get the uploaded file details
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageType = $_FILES['image']['type'];

        // Validate image (basic check)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Modify if you allow more image types
        if (!in_array($imageType, $allowedTypes)) {
            echo "<script>alert('Invalid image format. Only JPG, PNG, and GIF are allowed.');</script>";
            exit();
        }

        // Construct the full path to the target image file
        $targetPath = $uploadDir . basename($imageName);

        // Move the uploaded file to the final destination
        if (move_uploaded_file($imageTmpPath, $targetPath)) {
            // Image was successfully uploaded, continue with the database insert
            try {
                $stmt = $pdo->prepare("INSERT INTO products (name, category, price, quantity, description, image_url, vendor_id, created_at) 
                                       VALUES (:name, :category, :price, :quantity, :description, :image_url, :vendor_id, NOW())");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':quantity', $quantity);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':image_url', $targetPath);
                $stmt->bindParam(':vendor_id', $vendor_id);

                $stmt->execute();

                echo "<script>alert('Product added successfully'); window.location.href='VendorDashboard.php';</script>";
            } catch (PDOException $e) {
                echo "<script>alert('Error adding product: " . $e->getMessage() . "');</script>";
            }
        } else {
            echo "<script>alert('Error uploading image. Please try again.');</script>";
            exit();
        }
    } else {
        echo "<script>alert('Please select a valid image file.');</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="css/addproduct.css">
</head>
<body>
    <h2>Add New Product</h2>

    <form action="addProduct.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category" required>
                <option value="" disabled selected>Select category</option>
                <option value="Vegetables">Vegetables</option>
                <option value="Food & Drinks">Food & Drinks</option>
                <option value="Crafts & Handmade">Crafts & Handmade</option>
                <option value="Clothing & Accessories">Clothing & Accessories</option>
                <option value="Art & Decors">Art & Decors</option>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
        </div>

        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" name="image" id="image" accept="image/*" required>
        </div>

        <div class="form-group">
            <button type="submit">Add Product</button>
        </div>
    </form>
</body>
</html>
