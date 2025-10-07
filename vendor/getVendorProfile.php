<?php
session_start();
include 'db.php';

if(!isset($_SESSION['vendor_id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$vendor_id = $_SESSION['vendor_id']; // Get vendor ID from the session

header('Content-Type: application/json');

try {
    // Fetch vendor details from the database
    $stmt = $pdo->prepare("SELECT full_name, email,store_name,category FROM vendor WHERE id = :vendor_id");
    $stmt->execute(['vendor_id' => $vendor_id]);

    $vendor = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($vendor) {
        echo json_encode($vendor);
    } else {
        echo json_encode(['error' => 'Vendor not found']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
