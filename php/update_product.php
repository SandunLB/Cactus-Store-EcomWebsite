<?php
// Include database connection
include 'connection.php';

// Initialize variables
$product_id = null;
$product_name = null;
$product_description = null;
$product_price = null;
$product_image_url = null;
$update_success = false;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    // Get the ID of the product to update
    $product_id = $_POST['product_id'];

    // Fetch product details from the database
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch product details
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_name = $row['name'];
        $product_description = $row['description'];
        $product_price = $row['price'];
        $product_image_url = $row['image_url'];
    }

    // If product not found, redirect back to admin panel
    else {
        header("Location: admin_panel.php");
        exit;
    }

    // Check if form is submitted for update
    if (isset($_POST['update_product'])) {
        // Get updated form data
        $updated_name = $_POST['name'];
        $updated_description = $_POST['description'];
        $updated_price = $_POST['price'];

        // Update product details in the database
        $update_sql = "UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssdi", $updated_name, $updated_description, $updated_price, $product_id);
        if ($update_stmt->execute()) {
            $update_success = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="../css/admin_panel.css">
</head>
<body>
    <div class="background">
        <div class="create-product-container">
    <h2>Update Product</h2>
    <form method="post">
        <label for="product_id">Select Product to Update:</label>
        <select id="product_id" name="product_id">
            <?php
            // Fetch list of products from the database
            $sql = "SELECT id, name FROM products";
            $result = $conn->query($sql);

            // Display product options in dropdown
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'";
                    if ($row['id'] == $product_id) {
                        echo " selected";
                    }
                    echo ">" . $row['name'] . "</option>";
                }
            }
            ?>
        </select><br><br>
        
        <!-- Display product details regardless of whether a product is selected -->
        <h3>Product Details:</h3>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $product_name; ?>" required><br><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo $product_description; ?></textarea><br><br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" min="0" value="<?php echo $product_price; ?>" required><br><br>
        <button type="submit" name="update_product">Update</button>
        <?php if ($update_success) { ?>
            <p style="color: green;">Product updated successfully.</p>
        <?php } ?>
    </form>
        </div>
    </div>
    
</body>
</html>
