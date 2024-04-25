<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../images/bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Fix the background position */
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color:  rgba(255, 255, 255, 0.3);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .order {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            background-color: #ffffff;
        }

        .order-header {
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .order-details {
            color: #666;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">View Orders</h1>
        <div class="orders-grid">
            <?php
            // Include database connection file
            include_once "connection.php";

            // Query to fetch orders data
            $sql = "SELECT * FROM orders";
            $result = $conn->query($sql);

            // Check if there are any orders
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="order">
                        <div class="order-header">Order ID: <?php echo $row["id"]; ?></div>
                        <div class="order-details">
                            <div>Name: <?php echo $row["name"]; ?></div>
                            <div>Email: <?php echo $row["email"]; ?></div>
                            <div>Phone: <?php echo $row["phone"]; ?></div>
                            <div>Payment Method: <?php echo $row["payment_method"]; ?></div>
                            <div>Card Number: <?php echo $row["card_number"]; ?></div>
                            <div>Expiry: <?php echo $row["expiry"]; ?></div>
                            <div>CVV: <?php echo $row["cvv"]; ?></div>
                            <div>PayPal Email: <?php echo $row["paypal_email"]; ?></div>
                            <div>Bank Details: <?php echo $row["bank_details"]; ?></div>
                            <div>Created At: <?php echo $row["created_at"]; ?></div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No orders found.";
            }

            // Close database connection
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
