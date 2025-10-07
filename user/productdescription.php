<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/html/CITY_STREET_MART/login.php");
    exit;
}
// Include the database connection file
require 'db.php'; 

// Get the product ID and quantity from the query parameters
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$quantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1;

// Fetch product details from the database
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id); 
$stmt->execute();
$result = $stmt->get_result();

// Check if the product exists
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "Product not found!";
    exit;
}

// Check if there's a success message in the session
$cart_success = isset($_SESSION['cart_success']) ? $_SESSION['cart_success'] : '';

// Unset the success message after displaying it once
if ($cart_success) {
    unset($_SESSION['cart_success']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Description</title>
    <link rel="stylesheet" href="css/productdescription.css">
</head>
<body>
    <header>
        <div class="logo">
            <i class="fas fa-shopping-basket"></i> City Street Marts
        </div>
    </header>

    <main class="product-detail">
        <div class="product-container">
            <!-- Product Image -->
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($product['image_url'], ENT_QUOTES); ?>" alt="<?php echo htmlspecialchars($product['name'], ENT_QUOTES); ?>" />
            </div>

            <!-- Product Info -->
            <div class="product-info">
                <h2><?php echo htmlspecialchars($product['name'], ENT_QUOTES); ?></h2>
                
                <div class="product-info-details">
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($product['description'], ENT_QUOTES); ?></p>
                    <p><strong>Price:</strong> $<?php echo htmlspecialchars($product['price'], ENT_QUOTES); ?></p>
                    <p><strong>Category:</strong> <?php echo htmlspecialchars($product['category'], ENT_QUOTES); ?></p>
                    <p><strong>Quantity Available:</strong> <?php echo htmlspecialchars($product['quantity'], ENT_QUOTES); ?></p>
                </div>
                <div class="quantity-selector">
                    <button class="quantity-btn" id="decrease">-</button>
                    <input type="number" id="quantity" value="1" min="1" readonly />
                    <button class="quantity-btn" id="increase">+</button>
                    <p><strong>Price:</strong> $<span id="total-price"><?php echo htmlspecialchars($product['price'], ENT_QUOTES); ?></span></p>
                </div>
                <!-- Buttons -->
                <div class="product-buttons">
                    <a href="orderNow.php?id=<?php echo $product['id']; ?>&quantity=" class="btn order-now" id="order-now-btn">Order Now</a>
                    <a href="payOnDelivery.php?id=<?php echo $product['id']; ?>&quantity=" class="btn pay-on-delivery" id="pay-on-delivery-btn">Pay on Delivery</a>
                    <a href="addToCart.php?id=<?php echo $product['id']; ?>&quantity=" class="btn add-to-cart" id="add-to-cart-btn">Add To Cart</a>
                </div>
            </div>
        </div>
    </main>
    <?php if ($cart_success): ?>
        <script>
            alert("<?php echo $cart_success; ?>");
        </script>
    <?php endif; ?>
    <footer>
        <a href="UserHome.php">Back to Home</a>
    </footer>
    <script>
        // Get references to the buttons, quantity input, and price display
const decreaseBtn = document.getElementById('decrease');
const increaseBtn = document.getElementById('increase');
const quantityInput = document.getElementById('quantity');
const totalPriceDisplay = document.getElementById('total-price');
const orderNowBtn = document.getElementById('order-now-btn');
const payOnDeliveryBtn = document.getElementById('pay-on-delivery-btn');
const addToCartBtn = document.getElementById('add-to-cart-btn');

// Get the unit price from PHP (already echoed into the page)
const unitPrice = <?php echo $product['price']; ?>;

// Function to update the total price
function updateTotalPrice() 
{
    const quantity = parseInt(quantityInput.value, 10);
    const totalPrice = (unitPrice * quantity).toFixed(2); // Calculate total price and format to 2 decimals
    totalPriceDisplay.textContent = totalPrice; // Update price on the page
}

// Decrease button logic
decreaseBtn.addEventListener('click', function() {
    let quantity = parseInt(quantityInput.value, 10);
    if (quantity > 1) {
        quantityInput.value = quantity - 1;
        updateTotalPrice();
    }
});

// Increase button logic
increaseBtn.addEventListener('click', function() {
    let quantity = parseInt(quantityInput.value, 10);
    quantityInput.value = quantity + 1;
    updateTotalPrice();
});

// Initial price update on page load
updateTotalPrice();

// Function to update the href of the buttons with the selected quantity
function updateButtonLinks() 
{
    const quantity = parseInt(quantityInput.value, 10);
    const productId = <?php echo $product['id']; ?>; // Product ID from PHP
    const quantityParam = `quantity=${quantity}`;

    // Update each button's href with the quantity parameter
    orderNowBtn.href = `orderNow.php?id=${productId}&${quantityParam}`;
    payOnDeliveryBtn.href = `payOnDelivery.php?id=${productId}&${quantityParam}`;
    addToCartBtn.href = `addToCart.php?id=${productId}&${quantityParam}`;
}

// Update the button links whenever the quantity changes
quantityInput.addEventListener('input', updateButtonLinks);

// Initialize the links on page load
updateButtonLinks();

// Add event listener to the "Add to Cart" button
addToCartBtn.addEventListener('click', function(event) {
    // Prevent the default behavior (following the link)
    event.preventDefault();

    // Ask for confirmation before adding to cart
    const confirmAddToCart = confirm('Do you want to add this product to your cart?');

    if (confirmAddToCart) {
        // If the user confirms, proceed with adding to cart
        window.location.href = addToCartBtn.href;
    }
});

    </script>

</body>
</html>
