<?php
require_once 'db_config.php';

// Handle signup form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $country_code = $_POST["country_code"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];

    // Insert user into database
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $stmt = $conn->prepare("INSERT INTO users (username, password, country_code, phone_number, email, verified, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
    // Set default values for additional columns
    $default_verified = 'no'; // Set default value for verified
    $stmt->bind_param("sssssss", $username, $password, $country_code, $phone_number, $email, $default_verified, $gender);
    if ($stmt->execute()) {
        // Redirect to login page after successful signup
        header("Location: /webdev1/login.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>Sign Up</h1>
    <form id="signupForm" action="signup.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="country_code" placeholder="Country Code">
        <input type="text" name="phone_number" placeholder="Phone Number">
        <input type="email" name="email" placeholder="Email">
        <select name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
        <button type="submit">Sign Up</button>
    </form>
    <a href="/webdev1/login.php">Already have an account? Login here</a>
</body>
</html>

