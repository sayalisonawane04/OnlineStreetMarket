<?php
// Database connection parameters
$host = "localhost"; // Change this to your MySQL host
$username = "root"; // Change this to your MySQL username
$password = "vishal"; // Change this to your MySQL password
$database = "citystreetmart"; // Change this to your MySQL database name

// Create a connection to the MySQL database
$conn = new mysqli($host, $username, $password, $database);
//echo"Connection Successfull !!!";

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
