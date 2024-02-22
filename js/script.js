// You can add your JavaScript code here

// Example: Validate signup form
document.getElementById('signupForm').addEventListener('submit', function(event) {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;

    if (password !== confirmPassword) {
        alert("Passwords do not match");
        event.preventDefault(); // Prevent form submission
    }
});

// Example: Validate login form
document.getElementById('loginForm').addEventListener('submit', function(event) {
    // You can add more validation logic here if needed
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    if (username === "" || password === "") {
        alert("Please enter username and password");
        event.preventDefault(); // Prevent form submission
    }
});
