<?php
session_start(); // Start session if not already started
include 'connection.php';

if(isset($_SESSION['user_id'])) {
    $productId = $_POST['productId'];
    $userId = $_SESSION['user_id'];

    // Check if the product is already in the wishlist
    $checkQuery = "SELECT * FROM wishlist WHERE user_id = $userId AND product_id = $productId";
    $checkResult = $conn->query($checkQuery);

    if($checkResult->num_rows == 0) {
        // Insert product into wishlist
        $insertQuery = "INSERT INTO wishlist (user_id, product_id) VALUES ($userId, $productId)";
        if ($conn->query($insertQuery) === TRUE) {
            echo "Product added to wishlist successfully";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    } else {
        echo "Product already exists in wishlist";
    }
} else {
    echo "Please log in to add products to your wishlist";
}
$conn->close();
?>
