<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION["id"])) {
    header("Location: /webdev1/login");
    exit();
}

// You can fetch user-specific data here if needed

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>Welcome to the Home Page</h1>
    <p>This is the home page content.</p>
    <a href="logout.php">Logout</a> <!-- Add a logout link -->
</body>
</html>
