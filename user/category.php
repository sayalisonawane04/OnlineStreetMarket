<?php
session_start();
if(!isset($_SESSION['user_id'])) 
{
    header("Location:http://localhost/html/CITY_STREET_MART/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Section</title>
    <link rel="stylesheet" href="css/category.css">
</head>
<body>
<?php
// Include the database connection file
include 'db.php';

// Get the category from the URL
$category = isset($_GET['category']) ? $_GET['category'] : '';

// SQL query to get products in the selected category
$sql = "SELECT * FROM products WHERE category = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Products in " . htmlspecialchars($category, ENT_QUOTES) . "</h2>";
echo "<div class='product-list'>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='product'>
            <a href='productdescription.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES) . "'>
                <img src='" . htmlspecialchars($row['image_url'], ENT_QUOTES) . "' alt='" . htmlspecialchars($row['image_url'], ENT_QUOTES) . "' />
                <h3>" . htmlspecialchars($row['name'], ENT_QUOTES) . "</h3>
                <p>" . htmlspecialchars($row['description'], ENT_QUOTES) . "</p>
                <p>Price: $" . htmlspecialchars($row['price'], ENT_QUOTES) . "</p>
            </a>
        </div>";
    }
} else {
    echo "<p>No products found in this category.</p>";
}

echo "</div>";

// Close the connection
$conn->close();
?>
</body>
</html>

