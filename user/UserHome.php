<?php
session_start();
if(!isset($_SESSION['user_id'])) 
{
    header("Location:http://localhost/html/CITY_STREET_MART/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Street Marts</title>
    <link rel="stylesheet" href="css/UserHome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <i class="fas fa-shopping-basket"></i> City Street Marts
        </div>          
        <nav>
            <ul>
                <li><a href="#home" data-page="home">Home</a></li>
                <li><a href="#contact" data-page="contact">Contact</a></li>
                <li><a href="#events" data-page="events">Events</a></li>
                <li><a href="UserDashboard.php">DashBoard</a></li>
                <li><a href="UserCarts.php">Your Cart</a></li>
                <li><a href="UserHistory.php">Order History</a></li>
                <li><a href="Notifications.php">Notifications</a></li>
                <li><a href="#" onclick="confirmLogout()">Log Out</a></li>
            </ul>
        </nav>
    </header>
<main id="content">
<section id="products" class="back">
    <section class="search-bar">
        <input type="text" placeholder="Search for products, vendors, or events..." required>
        <button>Search</button>
    </section>

    <section id="category" class="categories">
    <h2>Shop by Category</h2>
    <div class="category-list">
        <div class="category" onclick="navigateToCategory('FoodDrinks')">
            <img src="img/categories/FOOD&DRINKS.jpg" alt="Food & Drinks" />
            Food & Drinks
        </div>
        <div class="category" onclick="navigateToCategory('CraftsHandmade')">
            <img src="img/categories/CRAFT&HANDMADE.jpg" alt="Crafts & Handmade" />
            Crafts & Handmade
        </div>
        <div class="category" onclick="navigateToCategory('ClothingAccessories')">
            <img src="img/categories/CLOTHINGS&ACCESSORIES.jpg" alt="Clothing & Accessories" />
            Clothing & Accessories
        </div>
        <div class="category" onclick="navigateToCategory('ArtDecor')">
            <img src="img/categories/ART&DECORE.jpg" alt="Art & Decor" />
            Art & Decor
        </div>
        <div class="category" onclick="navigateToCategory('Vegetables')">
            <img src="img/categories/VEGITABLES.jpg" alt="Vegetables" />
            Vegetables
        </div>
    </div>
</section>
    

    <section id="events" class="events">
        <h2>Upcoming Markets & Events</h2>
        <div class="event-card-container">
            <div class="event-card">
                <img src="img/events/event1.png" alt="event1" />
                On Vegetables
            </div>
            <div class="event-card">
                <img src="img/events/event2.png" alt="event2" />
                On Art & Decor
            </div>
            <div class="event-card">
                <img src="img/events/event3.png" alt="event3" />
                On Clothing & Accessories
            </div>
            <div class="event-card">
                <img src="img/events/event4.png" alt="event4" />
                On Crafts & Handmade
            </div>
            <div class="event-card">
                <img src="img/events/event3.png" alt="event5" />
                On Food & Drinks
            </div>
        </div>
    </section>
    
    <?php
require 'db.php'; // Include database connection

// Query to select first 5 vendors from the vendors table
$sql = "SELECT * FROM vendor LIMIT 5";
$result = $conn->query($sql);

echo "<section id='vendors' class='vendors'>";
echo "<h2>Meet Our Vendors</h2>";
echo "<div class='vendor-card-container'>";

// Check if there are vendors
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display each vendor
        echo "
        <div class='vendor-card' onclick='navigateToVendors(" . $row['id'] . ")'>
            <img src='" . htmlspecialchars($row['image_url'], ENT_QUOTES) . "' alt='" . htmlspecialchars($row['full_name'], ENT_QUOTES) . "' />
            <h3>" . htmlspecialchars($row['full_name'], ENT_QUOTES) . "</h3>
            <p>" . htmlspecialchars($row['category'], ENT_QUOTES) . "</p>
        </div>";
    }
} else {
    echo "<p>No vendors found.</p>";
}

echo "</div>"; // Close vendor card container
echo "</section>"; // Close vendors section

$conn->close(); // Close connection
?>

</section>
</main>
    <footer id="contact">
        <div class="social-media">Follow us: 
            <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <form>
            <label for="newsletter">Subscribe for Updates</label>
            <input type="email" id="newsletter" placeholder="Your email" required>
            <button>Subscribe</button>
        </form>
    </footer>
    <script src="script/UserScript.js"></script>
</body>
</html>
