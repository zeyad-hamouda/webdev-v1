<?php
session_start();
require_once 'db_config.php';

// Check if user is already logged in, if yes, redirect to home page
if(isset($_SESSION["id"])) {
    header("Location: /webdev1/home.php");
    exit();
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connect to database
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to fetch user info
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if username exists
    if ($stmt->num_rows == 1) {
        // Bind result variables
        $stmt->bind_result($id, $hashed_password);
        if ($stmt->fetch() && password_verify($password, $hashed_password)) {
            // Login successful, create session
            $_SESSION["id"] = $id;
            // Redirect to home page
            header("Location: /webdev1/home");
            exit();
        } else {
            // Password incorrect
            $login_error = "Invalid username or password";
        }
    } else {
        // Username not found
        $login_error = "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>Login</h1>
    <?php if(isset($login_error)) echo "<p>$login_error</p>"; ?>
    <form id="loginForm" action="login.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <a href="/webdev1/signup.php">Don't have an account? Sign Up here</a>
</body>
</html>
