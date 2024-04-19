<?php
session_start(); // Start session if not already started
include 'connection.php';

if(isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Retrieve wishlist items for the current user
    $wishlistQuery = "SELECT products.id, products.name, products.description, products.price, products.image_url FROM wishlist JOIN products ON wishlist.product_id = products.id WHERE wishlist.user_id = $userId";
    $wishlistResult = $conn->query($wishlistQuery);

    if ($wishlistResult->num_rows > 0) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>My Wishlist</title>
            <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file -->
        </head>
        <body>
            <section class="main-content">
                <div class="container">
                    <h2>My Wishlist</h2>
                    <div class="product-grid">
                        <?php
                        while($row = $wishlistResult->fetch_assoc()) {
                            ?>
                            <div class="product-card" data-product-id="<?php echo $row['id']; ?>">
                                <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>">
                                <h3><?php echo $row['name']; ?></h3>
                                <p><?php echo $row['description']; ?></p>
                                <p class="price">Rs <?php echo $row['price']; ?></p>
                                <button class="btn remove-from-wishlist-btn" onclick="removeFromWishlist(<?php echo $row['id']; ?>)">Remove from Wishlist</button>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        </body>
        </html>
        <?php
    } else {
        echo "Your wishlist is empty";
    }
} else {
    echo "Please log in to view your wishlist";
}
$conn->close();
?>
