<?php
// Replace the following with your database credentials
$host = 'localhost';
$username = 'root';
$password = 'vishal';
$dbname = 'citystreetmart';

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
