<?php
session_start();
include 'connection.php';

// Function to add a product to the wishlist
function addToWishlist($conn, $userId, $productId) {
    // Check if the product is already in the user's wishlist
    $checkQuery = "SELECT * FROM wishlist WHERE user_id = $userId AND product_id = $productId";
    $checkResult = $conn->query($checkQuery);

    if($checkResult->num_rows == 0) {
        // Insert product into wishlist
        $insertQuery = "INSERT INTO wishlist (user_id, product_id) VALUES ($userId, $productId)";
        if ($conn->query($insertQuery) === TRUE) {
            return "Product added to wishlist successfully";
        } else {
            return "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    } else {
        return "Product already exists in wishlist";
    }
}

// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else {
    // Redirect user to login page if not logged in
    header("location: user_login.php");
    exit();
}

// Check if the form is submitted
if(isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $response = addToWishlist($conn, $userId, $productId);
    echo $response;
    exit; // Stop further execution
}

// Retrieve wishlist items for the current user
$wishlistQuery = "SELECT products.id, products.name, products.description, products.price, products.image_url FROM wishlist JOIN products ON wishlist.product_id = products.id WHERE wishlist.user_id = $userId";
$wishlistResult = $conn->query($wishlistQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist</title>
    <!-- Add your CSS stylesheets here -->
    <style>
/* CSS styles for the wishlist container */
.wishlist-container {
    max-width: 300px; /* Adjust as needed */
    margin: 0 auto;
    padding: 10px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
}

/* CSS styles for the wishlist items */
.wishlist-item {
    border-bottom: 1px solid #ddd;
    padding: 10px 0;
    display: flex;
    align-items: center;
}

/* CSS styles for wishlist item image */
.wishlist-item img {
    max-width: 60px; /* Adjust as needed */
    max-height: 60px; /* Adjust as needed */
    margin-right: 10px;
}

/* CSS styles for wishlist item details */
.wishlist-item-details {
    flex-grow: 1;
}

.wishlist-item h3 {
    margin: 0;
    font-size: 16px;
    color: #333;
}

.wishlist-item p {
    margin: 5px 0;
    font-size: 14px;
    color: #666;
}

/* CSS styles for the add to wishlist button */
.add-to-wishlist-btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    font-size: 14px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.add-to-wishlist-btn:hover {
    background-color: #45a049;
}

/* CSS styles for empty wishlist message */
.empty-wishlist-msg {
    font-size: 16px;
    text-align: center;
    margin-top: 20px;
    color: #999;
}


    </style>
</head>
<body>
    <h2>My Wishlist</h2>
    <?php if(isset($wishlistResult) && $wishlistResult->num_rows > 0): ?>
        <?php while($row = $wishlistResult->fetch_assoc()): ?>
            <div class="wishlist-item">
                <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>">
                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <p>Price: Rs <?php echo $row['price']; ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Your wishlist is empty.</p>
    <?php endif; ?>

    <!-- Add to Wishlist Form 
    <form action="wishlist.php" method="post">
        <input type="hidden" name="productId" id="productId">
        <button type="submit" class="btnw add-to-wishlist-btn" onclick="setProductId(event)">
            &#x2665; Add to Wishlist
        </button>
    </form> 
    <script>
        function setProductId(event) {
            event.preventDefault(); // Prevent form submission
            var productId = event.target.getAttribute('data-product-id'); // Get the product ID
            document.getElementById('productId').value = productId; // Set the product ID in the hidden input field
            event.target.closest('form').submit(); // Submit the form
        }
    </script>-->
</body>
</html>

<?php
$conn->close();
?>
