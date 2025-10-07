<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/html/CITY_STREET_MART/login.php");
    exit;
}

include 'db.php';  // Include the database connection

$user_id = $_SESSION['user_id'];

// Fetch notifications for the user
$sql = "SELECT id, title, message, created_at 
        FROM notifications 
        WHERE user_id = ? 
        ORDER BY created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Notifications - City Street Marts</title>
    <link rel="stylesheet" href="css/Notifications.css">
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
                <li><a href="UserDashboard.php" data-page="home">DashBoard</a></li>
                <li><a href="UserHistory.php">Order History</a></li>
                <li><a href="#" onclick="confirmLogout()">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <main id="content">
        <section class="notifications-container">
            <h2>Your Notifications</h2>
            <div class="notifications-items">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="notification-item">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p><?php echo htmlspecialchars($row['message']); ?></p>
                            <span class="notification-date">
                                <?php echo htmlspecialchars(date('F j, Y, g:i a', strtotime($row['created_at']))); ?>
                            </span>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No new notifications.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer id="contact">
        <h4>All Rights Reserved..! City Street Market</h4>
    </footer>

    <script src="script/script.js"></script>
</body>
</html>
