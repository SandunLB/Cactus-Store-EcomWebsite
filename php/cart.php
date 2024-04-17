<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-card {
            border: 1px solid #ccc;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
        }

        .product-card img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .price {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .btn {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .cart {
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            background-color: #fff;
        }

        .cart h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        #cart-items {
            list-style-type: none;
            padding: 0;
        }

        #cart-items li {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item-quantity input {
            width: 40px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .item-total {
            font-weight: bold;
        }

        .actions {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .clear-cart-btn {
            background-color: #dc3545;
        }

        .clear-cart-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <section class="main-content">
        <div class="container">
            <h2>New Arrivals</h2>
            <div class="product-grid">
                <?php
                include 'connection.php';

                $sql = "SELECT id, name, description, price, image_url FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <div class="product-card" data-product-id="<?php echo $row['id']; ?>">
                            <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>">
                            <h3><?php echo $row['name']; ?></h3>
                            <p><?php echo $row['description']; ?></p>
                            <p class="price">$<?php echo $row['price']; ?></p>
                            <button class="btn add-to-cart-btn" onclick="addToCart(<?php echo $row['id']; ?>, '<?php echo $row['name']; ?>', <?php echo $row['price']; ?>)">Add to Cart</button>
                        </div>
                        <?php
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </section>

    <div class="cart">
        <h2>Shopping Cart</h2>
        <ul id="cart-items">
            <!-- Cart items will be dynamically added here -->
        </ul>
        <div class="actions">
            <button class="btn clear-cart-btn" onclick="clearCart()">Clear Cart</button>
            <p>Total: <span id="cart-total">$0.00</span></p>
        </div>
    </div>

    <script>
        let cart = [];

        function addToCart(id, name, price) {
            const existingItem = cart.find(item => item.id === id);
            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push({ id, name, price, quantity: 1 });
            }
            updateCart();
        }

        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            updateCart();
        }

        function updateQuantity(id, newQuantity) {
            const item = cart.find(item => item.id === id);
            item.quantity = parseInt(newQuantity);
            updateCart();
        }

        function clearCart() {
            cart = [];
            updateCart();
        }

        function updateCart() {
            const cartItemsElement = document.getElementById('cart-items');
            const cartTotalElement = document.getElementById('cart-total');
            let cartItemsHTML = '';
            let total = 0;

            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                cartItemsHTML += `
                    <li>
                        <div>
                            <span>${item.name} - $${item.price} x </span>
                            <div class="item-quantity">
                                <input type="number" min="1" value="${item.quantity}" onchange="updateQuantity(${item.id}, this.value)">
                            </div>
                            <span class="item-total">$${itemTotal.toFixed(2)}</span>
                        </div>
                        <button class="btn" onclick="removeFromCart(${item.id})">Remove</button>
                    </li>
                `;
                total += itemTotal;
            });

            cartItemsElement.innerHTML = cartItemsHTML;
            cartTotalElement.textContent = `$${total.toFixed(2)}`;
        }
    </script>
</body>
</html>
