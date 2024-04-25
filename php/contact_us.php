<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url(../images/main.jpg);
            background-size: cover;
            background-position: center;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<header>
        <div class="header-content">
            <div class="logo">
                <img src="../images/logo.png" alt="Logo">
                <span>Nature ART</span>
            </div>
            <nav class="main-nav">
                <ul>
                <li><a href="index.php">Home</a></li>
                    <li><a href="index.php">Shop</a></li>
                    <li><a href="contact_us.php">Contact</a></li>
                    <li><a href="#">My Account</a></li>
                    <button id="popupBtn">🛒</button>
                    <span id="cartBadge" style="display: none;">0</span>
            <div id="popup" class="popup">
            <span class="close" id="closeBtn">&times;</span>
                <div class="popup-content">
               
                <div class="cart">
        <h2>Shopping Cart</h2>
        <ul id="cart-items">
            <!-- Cart items will be dynamically added here -->
        </ul>
        <div class="actions">
            <button class="btn clear-cart-btn" onclick="clearCart()">Clear Cart</button>
            <p>Total: <span id="cart-total">Rs 0.00</span></p>
            <button class="btn checkout-btn" onclick="redirectToCheckout()">Checkout</button>
        </div>
    </div>
                
            </div>
                    
                </ul>
              
        </div>
            </nav>
    </header>
    <div class="container">
        <h2>Contact Us</h2>
        <form method="post" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>

            <input type="submit" value="Submit">
        </form>
        <?php
        // Include database connection file
        include_once "connection.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $conn->real_escape_string($_POST['name']);
            $email = $conn->real_escape_string($_POST['email']);
            $message = $conn->real_escape_string($_POST['message']);

            // Insert submitted data into database
            $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
            if ($conn->query($sql) === TRUE) {
                echo "<p class='message'>Thank you, $name! Your message has been received.</p>";
            } else {
                echo "<p class='message'>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

        // Close database connection
        $conn->close();
        ?>
    </div>

</body>
</html>
