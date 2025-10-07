<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/html/CITY_STREET_MART/login.php");
    exit;
}

include 'db.php';  // Include the database connection

$user_id = $_SESSION['user_id'];

// Fetch user information
$sql = "SELECT username, email, phone, address FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $phone, $address);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Street Marts</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <i class="fas fa-shopping-basket"></i> City Street Marts
        </div>          
        <nav>
            <ul>
                <li><a href="UserHome.php" data-page="home">Home</a></li>
                <li><a href="UserCarts.php">Your Cart</a></li>
                <li><a href="UserHistory.php">Order History</a></li>
                <li><a href="Notifications.php">Notifications</a></li>
                <li><a href="#" onclick="confirmLogout()">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <main id="content">
    <section class="user-info-card">
        <h2>User Information</h2>
        <div class="user-info">
            <div class="info-item">
                <span class="label">Username:</span>
                <span class="value"><?php echo htmlspecialchars($username); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Email:</span>
                <span class="value"><?php echo htmlspecialchars($email); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Phone:</span>
                <span class="value"><?php echo htmlspecialchars($phone); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Address:</span>
                <span class="value"><?php echo htmlspecialchars($address); ?></span>
            </div>
        </div>
    </section>
</main>
    <footer id="contact">
        <h4>All Rights Reserved..! City Street Market</h4>
    </footer>
    <script src="script/script.js"></script>
</body>
</html>
