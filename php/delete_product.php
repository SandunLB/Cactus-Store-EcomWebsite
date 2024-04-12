<?php
// Include database connection
include 'connection.php';

// Initialize variables
$success_message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    // Get the ID of the product to delete
    $product_id = $_POST['product_id'];

    // Delete the product from the database
    $delete_sql = "DELETE FROM products WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $product_id);
    if ($delete_stmt->execute()) {
        $success_message = 'Product has been successfully deleted.';
    } else {
        $error_message = 'Error deleting product.';
    }
}

// Fetch list of products from the database
$sql = "SELECT id, name, description, price, image_url FROM products";
$result = $conn->query($sql);

// Store products in an array
$products = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <link rel="stylesheet" href="../css/admin_panel.css">
</head>
<body>
    <h2>Delete Product</h2>
    <?php if (!empty($success_message)) { ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php } ?>
    <div class="product-grid">
        <?php foreach ($products as $product) { ?>
            <div class="product-card">
                <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
                <h3><?php echo $product['name']; ?></h3>
                <p>Description: <?php echo $product['description']; ?></p>
                <p>Price: <?php echo $product['price']; ?></p>
                <form method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <button class="delete-btn" type="submit">Delete</button>
                </form>
            </div>
        <?php } ?>
    </div>
</body>
</html>
