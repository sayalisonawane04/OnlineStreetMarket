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

/// Function to ask if the user is a vendor or user and then redirect to the appropriate login page
function redirectToLogin() {
    // Ask the user whether they are a Vendor or User
    let userType = prompt("Are you a Vendor or User? (Type 'Vendor' or 'User')");

    // Redirect based on the response
    if (userType && userType.toLowerCase() === 'vendor') {
        window.location.href = "VendorLogin.php";  // Redirect to Vendor Login Page
    } else if (userType && userType.toLowerCase() === 'user') {
        window.location.href = "login.php";  // Redirect to User Login Page
    } else {
        alert("Invalid input. Please type 'Vendor' or 'User'.");
    }
}


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


document.getElementById('joinVendorButton').addEventListener('click', function() {
    window.location.href = 'JoinAsVendor.php';
});


function validatePassword() {
    const password = document.getElementById('password').value;
    const errorMessage = document.getElementById('password-error');

    // Regular expressions for validation
    const hasUpperCase = /[A-Z]/;
    const hasNumber = /\d/;
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/;

    // Check each condition
    if (!hasUpperCase.test(password)) {
      errorMessage.textContent = "Password must include at least one uppercase letter.";
      return false;
    }
    if (!hasNumber.test(password)) {
      errorMessage.textContent = "Password must include at least one number.";
      return false;
    }
    if (!hasSpecialChar.test(password)) {
      errorMessage.textContent = "Password must include at least one special character.";
      return false;
    }

    errorMessage.textContent = ""; // Clear the error message if validation passes
    return true; // Allow form submission
  }


  document.getElementById("vendorForm").addEventListener("submit", function (event) {
    event.preventDefault();
    let isValid = true;

    // 1. Validate Full Name
    const fullName = document.getElementById("fullName").value.trim();
    if (!fullName) {
        alert("Full Name is required");
        isValid = false;
    }

    // 2. Validate Email
    const email = document.getElementById("email").value.trim();
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address");
        isValid = false;
    }

    // 3. Validate Phone Number (10 digits)
    const phone = document.getElementById("phone").value.trim();
    if (!/^[0-9]{10}$/.test(phone)) {
        alert("Phone number must be 10 digits");
        isValid = false;
    }

    // 4. Validate Store Name
    const storeName = document.getElementById("storeName").value.trim();
    if (!storeName) {
        alert("Store Name is required");
        isValid = false;
    }

    // 5. Validate Username
    const username = document.getElementById("username").value.trim();
    const usernamePattern = /^[a-zA-Z][a-zA-Z0-9_]{4,14}$/; // Starts with a letter, 5-15 chars total

    if (!usernamePattern.test(username)) {
        alert("Username must be 5-15 characters, start with a letter, and contain only letters, numbers, and underscores.");
        isValid = false;
    }

    // 6. Validate Password Matching & Strength
    const password = document.getElementById("password").value.trim();
    const confirmPassword = document.getElementById("confirmPassword").value.trim();
    const passwordPattern = /^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).{10,}$/;

    if (!passwordPattern.test(password)) {
        alert("Password must be at least 8 characters long, include one uppercase letter and one special character.");
        isValid = false;
    }

    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        isValid = false;
    }

    // 7. Validate Address
    const address = document.getElementById("address").value.trim();
    if (!address || !address.includes("Nashik")) {
        alert("Address must mention Nashik");
        isValid = false;
    }

    // 8. Validate Category
    const category = document.getElementById("category").value;
    if (!category) {
        alert("Please select a category");
        isValid = false;
    }

    if (isValid) {
        alert("Form is valid. Submitting...");
        this.submit();
    }
});


  document.querySelector(".registration-form").addEventListener("submit", function(event) {
    // Prevent form submission to handle validation
    event.preventDefault();

    let isValid = true;

    // 1. Validate Full Name
    const fullName = document.getElementById("fullname").value.trim();
    if (fullName === "") {
      alert("Full Name is required");
      isValid = false;
    }

    // 2. Validate Email 
    const email = document.getElementById("email").value.trim();
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(email)) {
      alert("Please enter a valid email address");
      isValid = false;
    }

    const phone = document.getElementById("phone").value.trim();
    if (!/^[0-9]{10}$/.test(phone)) {
        alert("Phone number must be 10 digits");
        isValid = false;
    }
    
    // 3. Validate Username 
    const username = document.getElementById("username").value.trim();
    if (username === "") {
      alert("Username is required");
      isValid = false;
    }

    const password = document.getElementById("password").value.trim();
    const confirmPassword = document.getElementById("confirm-password").value.trim();
    const passwordPattern = /^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).{10,}$/;

    if (!passwordPattern.test(password)) {
        alert("Password must be at least 8 characters long, include one uppercase letter and one special character.");
        isValid = false;
    }

    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        isValid = false;
    }

    // If all validations pass, submit the form 
    if (isValid) {
      alert("Registration successful!");
      // You can submit the form here if needed
      document.querySelector(".registration-form").submit();
    }
  });