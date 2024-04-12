<?php
session_start();

// Check if user is already logged in
if(isset($_SESSION['user_id'])) {
    header("Location: user_panel.php");
    exit;
}

// Add your database connection
include 'connection.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform validation and authentication
    // Example query:
    // $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND user_type = 'user'";
    // Execute the query and handle authentication

    // For simplicity, let's assume authentication succeeds
    $_SESSION['user_id'] = 123; // Replace with actual user ID
    header("Location: user_panel.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>
<body>
    <h2>User Login</h2>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
