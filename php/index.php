<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your E-Commerce Store</title>
    <link rel="stylesheet" href="../css/styles.css">
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
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">Categories</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">My Account</a></li>
                </ul>
            </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>🌵Prickle My Fancy Cacti🌵</h1>
            <h2>Rare and resilient cacti. Bring home nature’s elegance.🌟</h2>
            <br>
            <a href="#" class="btn">Shop Now</a>
        </div>
    </section>

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
            <button class="btn checkout-btn" onclick="redirectToCheckout()">Checkout</button>
        </div>
    </div>
    
    
    <footer>
    <div class="footer-content">
        <nav class="footer-nav">
            <ul>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li><a href="faq.html">FAQs</a></li>
                <li><a href="terms.html">Terms and Conditions</a></li>
                <li><a href="privacy.html">Privacy Policy</a></li>
            </ul>
        </nav>
        <div class="social-icons">
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-instagram"></a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 Nature ART. All rights reserved.</p>
    </div>
</footer>




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
                        <button class="Rbtn" onclick="removeFromCart(${item.id})">Remove</button>
                    </li>
                `;
                total += itemTotal;
            });

            cartItemsElement.innerHTML = cartItemsHTML;
            cartTotalElement.textContent = `$${total.toFixed(2)}`;
        }
        function redirectToCheckout() {
            window.location.href = "checkout.php"; // Redirect to checkout page
        }
    </script>
</body>
</html>
