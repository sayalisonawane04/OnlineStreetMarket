function confirmLogout() {
    const confirmed = confirm("Are you sure you want to log out?");
    if (confirmed) {
        window.location.href = 'logout.php'; // Adjust to your logout script
    }
}

document.querySelectorAll('.order-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Retrieve data attributes
        const productId = this.getAttribute('data-product-id');
        const quantity = this.getAttribute('data-quantity');
        
        // Check if the attributes exist
        if (productId && quantity) {
            // Redirect to ordernow.php with the product_id and quantity
            window.location.href = `orderNow.php?id=${productId}&quantity=${quantity}`;
        } else {
            console.error("Product ID or Quantity not found.");
            alert("An error occurred. Please try again.");
        }
    });
});


document.querySelectorAll('.pay-on-delivery-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Retrieve data attributes
        const productId = this.getAttribute('data-product-id');
        const quantity = this.getAttribute('data-quantity');
        
        // Redirect to payOnDelivery.php with the product_id and quantity
        window.location.href = `payOnDelivery.php?id=${productId}&quantity=${quantity}`;
    });
});

document.querySelectorAll('.delete-cart-btn').forEach(button => {
    button.addEventListener('click', function() {
        const cartId = this.getAttribute('data-cart-id');
        
        // Ask for confirmation before deleting
        const confirmDelete = confirm("Are you sure you want to delete this item from your cart?");
        
        if (confirmDelete) {
            // Use Fetch API to send the request to DeleteCart.php
            fetch(`DeleteCart.php?cart_id=${cartId}`, {
                method: 'GET', // You can use POST if you prefer
            })
            .then(response => response.json()) // Parse the response as JSON
            .then(data => {
                if (data.status === "success") {
                    // Show success message as an alert
                    alert(data.message); 
                    // Optionally, reload the page or remove the deleted item from the DOM
                    window.location.reload(); // Reload the page to reflect changes
                } else {
                    // Show error message as an alert
                    alert(data.message); 
                }
            })
            .catch(error => {
                console.error('Error deleting cart:', error);
                alert('There was an error while deleting the cart item.');
            });
        }
    });
});

