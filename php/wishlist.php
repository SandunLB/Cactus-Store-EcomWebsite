<?php
include 'connection.php';

// Function to add a product to the wishlist
function addToWishlist($conn, $productId) {
    // Check if the product is already in the wishlist
    $checkQuery = "SELECT * FROM wishlist WHERE product_id = $productId";
    $checkResult = $conn->query($checkQuery);

    if($checkResult->num_rows == 0) {
        // Insert product into wishlist
        $insertQuery = "INSERT INTO wishlist (product_id) VALUES ($productId)";
        if ($conn->query($insertQuery) === TRUE) {
            return "Product added to wishlist successfully";
        } else {
            return "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    } else {
        return "Product already exists in wishlist";
    }
}

// Check if the form is submitted
if(isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $response = addToWishlist($conn, $productId);
    echo $response;
    exit; // Stop further execution
}

// Retrieve wishlist items
$wishlistQuery = "SELECT products.id, products.name, products.description, products.price, products.image_url FROM wishlist JOIN products ON wishlist.product_id = products.id";
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
        /* Add your CSS styles for wishlist items here */
        .wishlist-item {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
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

    <!-- Add to Wishlist Form -->
    <form action="wishlist.php" method="post">
        <input type="hidden" name="productId" id="productId">
        <button type="submit" class="btnw add-to-wishlist-btn" onclick="setProductId(event)">
            &#x2665; Add to Wishlist
        </button>
    </form>

    <!-- JavaScript to set the product ID when submitting the form -->
    <script>
        function setProductId(event) {
            event.preventDefault(); // Prevent form submission
            var productId = event.target.getAttribute('data-product-id'); // Get the product ID
            document.getElementById('productId').value = productId; // Set the product ID in the hidden input field
            event.target.closest('form').submit(); // Submit the form
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
