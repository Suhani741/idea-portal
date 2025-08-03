// student_profile.js

// Function to validate password and confirm password match
document.getElementById('confirm_password').addEventListener('input', function() {
    const password = document.getElementById('new_password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    // Check if passwords match
    if (password !== confirmPassword) {
        document.getElementById('confirm_password').setCustomValidity("Passwords do not match");
    } else {
        document.getElementById('confirm_password').setCustomValidity("");
    }
});

// Optional: You can also add functionality to check if the password meets certain criteria
document.getElementById('new_password').addEventListener('input', function() {
    const password = document.getElementById('new_password').value;
    const passwordRequirements = document.getElementById('password-requirements');

    // Simple password strength check (at least 8 characters)
    if (password.length < 8) {
        passwordRequirements.textContent = "Password must be at least 8 characters.";
        passwordRequirements.style.color = "red";
    } else {
        passwordRequirements.textContent = "";
    }
});