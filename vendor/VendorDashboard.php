<?php
session_start();
if(!isset($_SESSION['vendor_id'])) 
{
    header("Location:http://localhost/html/CITY_STREET_MART/VendorLogin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">Vendor Dashboard</div>
            <ul class="nav-links">
                <li><a href="#" onclick="showSection('profile')">Profile</a></li>
                <li><a href="#" onclick="showSection('products')">Manage Products</a></li>
                <li><a href="#" onclick="confirmLogout()" >Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="top-bar">
                <h1>Your Product List</h1>
                <div class="product-list" id="product-list">
                    <!-- Products will be loaded here -->
                </div>
            </div>
            <div id="dashboard-content">
            </div>
        </div>
    </div>
    <script src="script/script.js"></script>
</body>
</html>
