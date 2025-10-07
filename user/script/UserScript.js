// script.js
function setButtonColors() {
    document.documentElement.style.setProperty('--button-bg', '#FF6F61');
    document.documentElement.style.setProperty('--button-hover-bg', '#D64550');
    document.documentElement.style.setProperty('--button-text', 'white');
}
window.onload = setButtonColors;


document.addEventListener("DOMContentLoaded", function() {
    const navLinks = document.querySelectorAll("a");
    navLinks.forEach(link => {
        link.addEventListener("click", function(e) {
            const targetId = this.getAttribute("href");
            if (targetId.startsWith("#")) {
                e.preventDefault();
                const targetSection = document.querySelector(targetId);
                
                if (targetSection) {
                    targetSection.scrollIntoView({
                        behavior: "smooth"
                    });
                }
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.querySelector('.search-bar input');
    const searchButton = document.querySelector('.search-bar button');

    searchButton.addEventListener('click', function() {
        const query = searchInput.value.trim().toLowerCase();

        if (query) {
            alert('Searching for: ' + query);
        } else {
            alert('Please enter a search term.');
        }
    });
});

function navigateToCategory(category) {
    window.location.href = `category.php?category=${category}`;
}

function navigateToVendors(vid) {
    window.location.href = `vendors.php?vid=${vid}`;
}

function confirmLogout() {
    const confirmAction = confirm('Are you sure you want to logout?');
    if(confirmAction) {
        window.location.href = 'logout.php'; // Logout page to destroy session
    }
}