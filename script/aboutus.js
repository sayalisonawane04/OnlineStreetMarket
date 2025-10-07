// Smooth Scroll for Navigation Links
document.querySelectorAll('nav a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();

        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);

        // Scroll smoothly to the target section
        targetElement.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    });
});


// Form Validation (Example for a Contact Form)
function validateEmail(email) {
    const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return re.test(String(email).toLowerCase());
}

document.querySelector('footer form').addEventListener('submit', function(e) {
    e.preventDefault();
    const emailInput = this.querySelector('input[type="email"]');
    
    if (validateEmail(emailInput.value)) {
        alert("Thank you for subscribing!");
        emailInput.value = ''; // Clear the input after successful submission
    } else {
        alert("Please enter a valid email address.");
    }
});
