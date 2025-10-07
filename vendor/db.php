<?php
// db_connection.php

// Database configuration
$host = 'localhost';      // Database host (e.g., localhost)
$dbname = 'citystreetmart'; // Your database name
$username = 'root';       // Your database username
$password = 'vishal';           // Your database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Set PDO error mode to exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optionally, set the default fetch mode to associative arrays
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // If the connection fails, display an error message
    echo 'Connection failed: ' . $e->getMessage();
    exit; // Exit the script if the database connection fails
}
?>
