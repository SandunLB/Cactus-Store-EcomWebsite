<?php
// Include database connection
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = null;

    // Handle image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        
        // Generate unique filename
        $image_filename = uniqid() . '.' . $image_extension;

        // Move uploaded file to uploads directory
        $upload_path = 'uploads/' . $image_filename;
        move_uploaded_file($image_tmp_name, $upload_path);

        // Set image URL to the uploaded file path
        $image_url = $upload_path;
    }

    // Insert new product into the database
    $sql = "INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssds", $name, $description, $price, $image_url);
    $stmt->execute();

  
    
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link rel="stylesheet" href="../css/admin_panel.css">
</head>
<body>
    <div class="background">
        <div class="create-product-container">
            <h2>Create Product</h2>
            <form method="post" enctype="multipart/form-data">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" required><br><br>
                <label for="description">Description:</label><br>
                <textarea id="description" name="description"></textarea><br><br>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" min="0" required><br><br>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image"><br><br>
                <button type="submit">Create</button>
            </form>
        </div>
    </div>
</body>
</html>
