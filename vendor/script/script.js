function showSection(section) 
{
    const content = document.getElementById('dashboard-content');
    
    if (section === 'products') {
        content.innerHTML = `
            <h2>Manage Products</h2>
            <button class="add-btn" onclick="window.location.href='addProduct.php';">Add New Product</button>
            <div id="product-list"></div>
        `;
    } 
    else if (section === 'profile') 
    {
        loadVendorProfile();
    }  
}


// Function to fetch products from the server
function loadProducts() {
    fetch('getProducts.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Clear the product list before adding the new products
                const productList = document.getElementById('dashboard-content');
                productList.innerHTML = '';  // Reset product list before inserting new products

                // Build the product list dynamically
                let productHTML = '';
                data.products.forEach(product => {
                    productHTML += `
                        <div class="product-item" data-product-id="${product.id}">
                            <div class="product-content">
                                <h3>${product.name}</h3>
                                <p>Description: ${product.description}</p>
                                <p>Price: $${product.price}</p>
                                <p>Quantity: ${product.quantity}</p>
                                <p>Category: ${product.category}</p>
                                <div class="product-buttons">
                                    <button class="edit" onclick="window.location.href='edit_product.php?id=${product.id}'">Edit</button>
                                    <button class="delete" onclick="deleteProduct(this)">Delete</button>
                                </div>
                            </div>
                            <div class="product-image">
                                <img src="${product.image_url}" alt="${product.name}" class="product-image-img" />
                            </div>
                        </div>
                    `;
                });

                // Insert all products at once
                productList.innerHTML = productHTML;
            } else {
                alert('Failed to load products: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error fetching products:', error);
            alert('Error fetching products');
        });
}

document.addEventListener('DOMContentLoaded', function() {
    loadProducts();
});

function deleteProduct(button) {
    const productId = button.closest('.product-item').getAttribute('data-product-id');
    
    if (confirm('Are you sure you want to delete this product?')) {
        // Send AJAX request to delete the product
        fetch('deleteProduct.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the product from the DOM
                button.closest('.product-item').remove();
                alert('Product deleted successfully');
            } else {
                alert('Error deleting product');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the product');
        });
    }
}


function loadVendorProfile() {
    fetch('getVendorProfile.php')
        .then(response => response.json())
        .then(vendor => {
            const content = document.getElementById('dashboard-content');
            if (vendor.error) {
                content.innerHTML = `<p>Error: ${vendor.error}</p>`;
            } else {
                content.innerHTML = `
                    <h2>Vendor Profile</h2>
                    <div class="profile-container">
                        <img src="img/profile.png" alt="Vendor Profile Picture" class="profile-img">
                        <div class="profile-info">
                            <p><strong>Name:</strong> ${vendor.full_name}</p>
                            <p><strong>Email:</strong> ${vendor.email}</p>
                            <p><strong>Name:</strong> ${vendor.store_name}</p>
                            <p><strong>Email:</strong> ${vendor.category}</p>
                        </div>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error fetching vendor profile:', error);
        });
}

function confirmLogout() 
  {
    const confirmed = confirm("Are you sure you want to log out?");
    if (confirmed) 
    {
      window.location.href = 'logout.php';
    }
  }