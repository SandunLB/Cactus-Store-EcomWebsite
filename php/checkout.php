<?php
        include 'connection.php'; // Include database connection
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $name = $_POST["name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $paymentMethod = $_POST["payment_method"];
            $cardNumber = $_POST["card_number"] ?? "";
            $expiry = $_POST["expiry"] ?? "";
            $cvv = $_POST["cvv"] ?? "";
            $paypalEmail = $_POST["paypal_email"] ?? "";
            $bankDetails = $_POST["bank_details"] ?? "";

            // Prepare and execute SQL INSERT statement
            $sql = "INSERT INTO orders (name, email, phone, payment_method, card_number, expiry, cvv, paypal_email, bank_details)
                    VALUES ('$name', '$email', '$phone', '$paymentMethod', '$cardNumber', '$expiry', '$cvv', '$paypalEmail', '$bankDetails')";

            if ($conn->query($sql) === TRUE) {
                echo "Order placed successfully! Redirecting...";
                // Redirect to thank you page after 5 seconds
                header("refresh:5;url=thank_you.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Close connection
        $conn->close();
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            background-image: url(../images/main.jpg);
            background-color: #09d3d352;
            background-size: cover;
            background-position: center;
            background-attachment: fixed; 
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        select {
            width: calc(100% - 22px);
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

        .payment-method {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .payment-method input[type="radio"] {
            margin-right: 10px;
        }

        .payment-method img {
            max-width: 80px;
            margin-right: 20px;
        }

        .payment-method label {
            font-weight: normal;
        }

        .payment-details {
            display: none;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
        }

        .payment-details.show {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        <form action="" method="post" id="checkout-form">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required><br>

            <label for="payment-method">Select Payment Method:</label><br>
            <div class="payment-method">
                <input type="radio" id="credit-card" name="payment_method" value="credit_card" onclick="togglePaymentDetails('credit-card-details')" required>
                <label for="credit-card"><img src="../images/payments/cc.png" alt="Credit Card"> Credit Card</label>
            </div>
            <div class="payment-method">
                <input type="radio" id="paypal" name="payment_method" value="paypal" onclick="togglePaymentDetails('paypal-details')" required>
                <label for="paypal"><img src="../images/payments/pp.jpg" alt="PayPal"> PayPal</label>
            </div>
            <div class="payment-method">
                <input type="radio" id="bank-transfer" name="payment_method" value="bank_transfer" onclick="togglePaymentDetails('bank-transfer-details')" required>
                <label for="bank-transfer"><img src="../images/payments/bt.png" alt="Bank Transfer"> Bank Transfer</label>
            </div>

            <div id="credit-card-details" class="payment-details">
                <label for="card-number">Card Number:</label>
                <input type="text" id="card-number" name="card_number"><br>

                <label for="expiry">Expiry Date:</label>
                <input type="text" id="expiry" name="expiry"><br>

                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv"><br>
            </div>

            <div id="paypal-details" class="payment-details">
                <label for="paypal-email">PayPal Email:</label>
                <input type="email" id="paypal-email" name="paypal_email"><br>
            </div>

            <div id="bank-transfer-details" class="payment-details">
                <label for="bank-details">Bank Details:</label>
                <textarea id="bank-details" name="bank_details"></textarea><br>
            </div>

            <input type="submit" value="Complete Purchase">
        </form>
    </div>

    <script>
        function togglePaymentDetails(paymentMethod) {
            var details = document.querySelectorAll('.payment-details');
            for (var i = 0; i < details.length; i++) {
                details[i].classList.remove('show');
            }
            document.getElementById(paymentMethod).classList.add('show');
        }
    </script>