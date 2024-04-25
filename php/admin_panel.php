<?php
include 'connection.php';
session_start();

if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/admin_panel.css">
</head>
<body>
<div class="container">
    <div class="dashboard">
        <div class="sidebar" id="sidebar">
            <div class="admin-info">
                <img src="../images/logo.png" alt="Admin Photo">
                <h3>Admin Panel</h3>
            </div>
            <ul class="menu">
                <li><a href="create_product.php" target="content">Create Product</a></li>
                <li><a href="update_product.php" target="content">Update Product</a></li>
                <li><a href="delete_product.php" target="content">Delete Product</a></li>
                <br>
                <br>
                <br>
                <li><a href="view_orders.php" target="content">View Orders</a></li>
                <li><a href="view_users.php" target="content">View Users</a></li>
                <li><a href="view_messages.php" target="content">Messages</a></li>
            </ul>
            <a class="logout-btn" href="logout.php">Logout</a>
        </div>
        <div class="content">
            
            <iframe id="content-frame" name="content" src="create_product.php" frameborder="0"></iframe>
        </div>
    </div>
</div>
    <script src="../js/script.js"></script>
</body>
</html>
