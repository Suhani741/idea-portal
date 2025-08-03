// Adding client-side validation and optional features for login page
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();

        if (username === "" || password === "") {
            e.preventDefault(); // Prevent form submission
            alert("Both fields are required!");
        }
    });

    // Optional: Toggle password visibility
    const passwordField = document.getElementById("password");
    const togglePassword = document.createElement("button");
    togglePassword.type = "button";
    togglePassword.textContent = "Show Password";
    togglePassword.style.marginTop = "-10px";
    togglePassword.style.marginBottom = "15px";
    form.insertBefore(togglePassword, passwordField.nextSibling);

    togglePassword.addEventListener("click", function () {
        if (passwordField.type === "password") {
            passwordField.type = "text";
            togglePassword.textContent = "Hide Password";
        } else {
            passwordField.type = "password";
            togglePassword.textContent = "Show Password";
        }
    });
});
