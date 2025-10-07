// Confirm Logout
function confirmLogout() {
    const confirmAction = confirm('Are you sure you want to logout?');
    if(confirmAction) {
        window.location.href = 'logout.php'; // Logout page to destroy session
    }
}

