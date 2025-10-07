<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/html/CITY_STREET_MART/login.php");
    exit;
}

include 'db.php';  // Include the database connection

$user_id = $_SESSION['user_id'];

// SQL Query to get order and payment details
$sql = "SELECT o.order_id, o.order_date, o.total_amount, o.order_status, o.shipped_by,
               p.payment_id, p.payment_date, p.amount AS payment_amount, p.payment_method, p.payment_status
        FROM orders o
        LEFT JOIN payment p ON o.order_id = p.order_id
        WHERE o.user_id = ?";

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
    <title>Your Order History - City Street Marts</title>
    <link rel="stylesheet" href="css/UserHistory.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <i class="fas fa-shopping-basket"></i> City Street Marts
        </div>
        <nav>
            <ul>
                <li><a href="UserHome.php">Home</a></li>
                <li><a href="UserDashboard.php">Dashboard</a></li>
                <li><a href="Notifications.php">Notifications</a></li>
                <li><a href="#" onclick="confirmLogout()">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <main id="content">
        <section class="order-history-container">
            <h2>Your Order History</h2>

            <?php if ($result->num_rows > 0): ?>
                <div class="order-history">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="order-item">
                            <div class="order-details">
                            <?php $string = $row['shipped_by'];?>
                                <h3>Order #<?php echo $row['order_id']; ?></h3>
                                <p>Order Date: <?php echo date('Y-m-d', strtotime($row['order_date'])); ?></p>
                                <p>Total Amount: $<?php echo number_format($row['total_amount'], 2); ?></p>
                                <p>Order Status: <?php echo htmlspecialchars($row['order_status']); ?></p>
                                <p>Shipped By: <?php echo htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>

                            <div class="payment-details">
                                <h4>Payment Information</h4>
                                <?php if ($row['payment_id']): ?>
                                    <p>Payment Date: <?php echo date('Y-m-d', strtotime($row['payment_date'])); ?></p>
                                    <p>Amount Paid: $<?php echo number_format($row['payment_amount'], 2); ?></p>
                                    <p>Payment Method: <?php echo htmlspecialchars($row['payment_method']); ?></p>
                                    <p>Payment Status: <?php echo htmlspecialchars($row['payment_status']); ?></p>
                                <?php else: ?>
                                    <p>No payment information available for this order.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>You have no order history.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer id="contact">
        <h4>All Rights Reserved..! City Street Market</h4>
    </footer>

    <script src="script/script.js"></script>
</body>
</html>
