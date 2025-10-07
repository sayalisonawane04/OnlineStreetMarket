<?php
session_start();
if(!isset($_SESSION['admin_id'])) 
{
    header("Location:http://localhost/html/CITY_STREET_MART/AdminLogin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar show">
        <button id="close-sidebar" class="close-sidebar">×</button> 
        <div class="logo">Admin</div>
        <ul class="nav-links">
            <li><a href="#" data-target="dashboard">Dashboard</a></li>
            <li><a href="#" data-target="users">Users</a></li>
            <li><a href="#" data-target="content">Content</a></li>
            <li><a href="#" data-target="settings">Settings</a></li>
            <li><a href="#" onclick="confirmLogout()">Log Out</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <button id="toggle-sidebar" class="toggle-sidebar">☰</button>
            <h1>Dashboard</h1>
            <div class="user-profile">
                <img src="img/profile.png" alt="User Avatar">
                <span>Admin</span>
            </div>
        </div>
        
        <!-- Dashboard Stats (Initially Loaded) -->
        <div id="dashboard-stats" class="dashboard-stats">
        <div style="padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); text-align: center;width: 100%;">
            <h3 style="font-size: 24px; color: #333; margin-bottom: 10px;">Welcome To Your Dashboard</h3>
            <p style="font-size: 16px; color: #555; margin-bottom: 20px;">Admin Section</p>
        </div>
        </div>
    </div>

    <script src="script/script.js"></script>
</body>
</html>
