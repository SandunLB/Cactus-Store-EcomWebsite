<?php
session_start();


if(!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
</head>
<body>
    <h2>Welcome to User Panel</h2>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
