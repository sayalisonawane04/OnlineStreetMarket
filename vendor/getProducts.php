<?php
session_start();

if (!isset($_SESSION['vendor_id'])) {
    echo json_encode(['success' => false, 'message' => 'Vendor not logged in']);
    exit;
}

include 'db.php'; // Ensure you include your database connection

$vendor_id = $_SESSION['vendor_id'];

try {
    // Fetch products for the current vendor from the database
    $stmt = $pdo->prepare("SELECT id, name, description, price, quantity, category, image_url FROM products WHERE vendor_id = :vendor_id");
    $stmt->bindParam(':vendor_id', $vendor_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($products) {
        // Return the products as JSON
        echo json_encode(['success' => true, 'products' => $products]);
    } else {
        // Return an empty array if no products are found
        echo json_encode(['success' => true, 'products' => []]);
    }
} catch (PDOException $e) {
    // Handle any errors and return a generic message
    echo json_encode(['success' => false, 'message' => 'Error fetching products: ' . $e->getMessage()]);
}
?>
