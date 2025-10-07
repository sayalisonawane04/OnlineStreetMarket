<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/html/CITY_STREET_MART/login.php");
    exit;
}

include 'db.php';  // Include the database connection

$user_id = $_SESSION['user_id'];

// Fetch cart data along with product details
$sql = "SELECT c.cart_id, c.quantity, c.total_price, p.id AS product_id, p.name, p.price, p.image_url 
        FROM usercart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = ?";


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
    <title>Your Cart - City Street Marts</title>
    <link rel="stylesheet" href="css/cart.css">
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
                <li><a href="Notifications.php">Notifications</a></li>
                <li><a href="#" onclick="confirmLogout()">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <main id="content">
        <section class="cart-container">
            <h2>Your Cart</h2>
            <div class="cart-items">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="cart-item">
                            <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="product-image">
                            <div class="cart-item-info">
                                <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                                <p>Price: $<?php echo number_format($row['price'], 2); ?></p>
                                <p>Quantity: <?php echo htmlspecialchars($row['quantity']); ?></p>
                                <p>Total: $<?php echo number_format($row['total_price'], 2); ?></p>
                                <p>Product ID : <?php echo number_format($row['product_id']); ?></p>
                                <div class="cart-item-buttons">
                                    <button class="order-btn" 
                                            data-product-id="<?php echo $row['product_id']; ?>" 
                                            data-quantity="<?php echo $row['quantity']; ?>">
                                        Order Now
                                    </button>
                                    <button class="pay-on-delivery-btn" 
                                            data-product-id="<?php echo $row['product_id']; ?>" 
                                            data-quantity="<?php echo $row['quantity']; ?>">
                                        Pay on Delivery
                                    </button>
                                    <button class="delete-cart-btn" 
                                            data-cart-id="<?php echo $row['cart_id']; ?>">
                                        Delete Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Your cart is empty.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer id="contact">
        <h4>All Rights Reserved..! City Street Market</h4>
    </footer>

    <script src="script/cart.js"></script>
</body>
</html>
