// Get references to sidebar, main content, and toggle elements
const toggleButton = document.getElementById('toggle-sidebar');
const closeButton = document.getElementById('close-sidebar');
const sidebar = document.querySelector('.sidebar');
const mainContent = document.querySelector('.main-content');

// Initially show the sidebar
document.addEventListener('DOMContentLoaded', () => {
    sidebar.classList.add('show');
    mainContent.style.marginLeft = '250px';
});

// Toggle the sidebar visibility
toggleButton.addEventListener('click', () => {
    sidebar.classList.toggle('show');
    mainContent.style.marginLeft = sidebar.classList.contains('show') ? '250px' : '0';
});

// Close the sidebar
closeButton.addEventListener('click', () => {
    sidebar.classList.remove('show');
    mainContent.style.marginLeft = '0';
});

// Change content dynamically based on sidebar navigation
function changeContent(target) {
    const dashboardStats = document.getElementById('dashboard-stats');
    dashboardStats.innerHTML = '';

    const contentMap = {
        users: `
            <div class="settings-container">
                <div class="card" onclick="showPopup('users')">
                    <h3>Total Users</h3>
                    <p>1,200</p>
                </div>
                <div class="card" onclick="showPopup('vendors')">
                    <h3>Total Vendors</h3>
                    <p>50</p>
                </div>
                <div class="card" onclick="showPopup('products')">
                    <h3>Total Products</h3>
                    <p>10</p>
                </div>
                <div class="card" onclick="showPopup('orders')">
                    <h3>Total Orders</h3>
                    <p>10</p>
                </div>
            </div>

    <!-- Popup Modal -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <!-- Close Button -->
            <span class="close" onclick="closePopup()">×</span>

            <h2 id="popupTitle">List</h2>
            <table id="popupTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will go here -->
                </tbody>
            </table>
        </div>
    </div>`,
        content: `
            <div class="card"><h3>Total Posts</h3><p>320</p></div>
            <div class="card"><h3>Drafts</h3><p>5</p></div>
            <div class="card"><h3>Approved Content</h3><p>310</p></div>`,
        settings: `
            <div class="settings-container">
                <div class="card" onclick="openModal('general')">
                    <h3>General Settings</h3>
                    <p>Site Settings</p>
                </div>
                <div class="card" onclick="openModal('roles')">
                    <h3>User Roles</h3>
                    <p>Manage Permissions</p>
                </div>
                <div class="card" onclick="openModal('backup')">
                    <h3>Backup</h3>
                    <p>Backup Site Data</p>
                </div>
            </div>
            <div id="modal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2 id="modal-title">Settings</h2>
                    <div id="modal-options">
                        <!-- Options will be dynamically injected here -->
                    </div>
                    <button class="toggle-button" onclick="toggleSetting()">Turn On</button>
                </div>
            </div>
            `,
        default: `
            <div class="card"><h3>Total Users</h3><p>1,200</p></div>
            <div class="card"><h3>Total Orders</h3><p>320</p></div>
            <div class="card"><h3>Total Revenue</h3><p>$15,000</p></div>`
    };

    // Dynamically load content based on navigation link
    dashboardStats.innerHTML = contentMap[target] || contentMap.default;
}

// Add event listeners to navigation links to load content
const navLinks = document.querySelectorAll('.nav-links li a');
navLinks.forEach(link => {
    link.addEventListener('click', (event) => {
        const target = event.target.getAttribute('data-target');
        changeContent(target);
        sidebar.classList.remove('show');
        mainContent.style.marginLeft = '0';
    });
});

// Handle logout confirmation
function confirmLogout() {
    const confirmed = confirm("Are you sure you want to log out?");
    if (confirmed) {
        window.location.href = 'logout.php'; // Redirect to logout page
    }
}

// JavaScript for opening and closing the modal
function openModal(settingType) {
    // Update modal title based on the setting clicked
    const modalTitle = document.getElementById('modal-title');
    const modalOptions = document.getElementById('modal-options');
    const toggleButton = document.querySelector('.toggle-button');

    // Set the title and options dynamically based on the setting clicked
    if (settingType === 'general') {
        modalTitle.textContent = "General Settings";
        modalOptions.innerHTML = "<p>Enable or disable site settings.</p>";
    } else if (settingType === 'roles') {
        modalTitle.textContent = "User Roles";
        modalOptions.innerHTML = "<p>Enable or disable user roles management.</p>";
    } else if (settingType === 'backup') {
        modalTitle.textContent = "Backup";
        modalOptions.innerHTML = "<p>Enable or disable site backup.</p>";
    }

    // Show the modal
    document.getElementById('modal').style.display = 'block';
    
    // Reset the toggle button state to "On" initially
    toggleButton.textContent = "Turn On";
    toggleButton.classList.remove("off");
}

function closeModal() {
    // Hide the modal when close button is clicked
    document.getElementById('modal').style.display = 'none';
}

function toggleSetting() {
    const toggleButton = document.querySelector('.toggle-button');

    // Toggle the button text and class based on the current state
    if (toggleButton.classList.contains('off')) {
        toggleButton.textContent = "Turn On";
        toggleButton.classList.remove('off');
    } else {
        toggleButton.textContent = "Turn Off";
        toggleButton.classList.add('off');
    }
}


function showPopup(type) {
    const popup = document.querySelector('.popup');
    const popupTitle = document.querySelector('#popupTitle');
    const popupTable = document.querySelector('.popup table tbody');
    
    // Clear the previous data
    popupTable.innerHTML = '';

    const data = {
        users: [
            { id: 1, name: 'shubham wakchaure', details: 'Active' },
            { id: 2, name: 'siddesh ambekar', details: 'Inactive' },
            { id: 3, name: 'sid shinde', details: 'Active' },
            { id: 4, name: 'rutika bhamre', details: 'Active' },
            // Add more users
        ],
        vendors: [
            { id: 1, name: 'manoj bhamre', details: 'Verified' },
            { id: 2, name: 'aditya bhabad', details: 'Pending' },
            { id: 3, name: 'akhil tiwari', details: 'Verified' },
            { id: 4, name: 'renuka sonavne', details: 'Verified' }
            // Add more vendors
        ],
        products: [
            { id: 1, name: 'apple juice', details: 'In Stock' },
            { id: 2, name: 'methi bhaji', details: 'Out of Stock' },
            { id: 3, name: 'milk', details: 'In Stock' },
            { id: 4, name: 'aloo', details: 'In Stock' },
            // Add more products
        ],
        orders: [
            { id: 1, name: 'Order #123', details: 'Completed' },
            { id: 2, name: 'Order #124', details: 'Pending' },
            { id: 3, name: 'Order #125', details: 'Shipped' },
            { id: 4, name: 'Order #126', details: 'Delivered' },
            // Add more orders
        ]
    };

    // Set the popup title and populate the table
    popupTitle.textContent = `List of ${type.charAt(0).toUpperCase() + type.slice(1)}`;
    const categoryData = data[type] || [];
    categoryData.forEach((item, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `<td>${index + 1}</td><td>${item.name}</td><td>${item.details}</td>`;
        popupTable.appendChild(row);
    });

    // Show the popup
    popup.style.display = 'block';
}

function closePopup() {
    document.querySelector('.popup').style.display = 'none';
}
