<?php
session_start();

// Initialize $account_link with the default link
$account_link = '<li><a href="user_login.php">My Account</a></li>';

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in, fetch their username from the session
    $username = $_SESSION['username'];
    // Update $account_link with the logged-in user's name
    $account_link = '<li><a href="#">'.$username.'\'s Account</a></li>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
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
                <li><a href="user_panel.php">Home</a></li>
                    <li><a href="contact_us.php">Contact</a></li>
                    <button id="popupBtn">🛒</button>
                    <span id="cartBadge" style="display: none;">0</span>
            <div id="popup" class="popup">
            <span class="close" id="closeBtn">&times;</span>
                <div class="popup-content">
               
                <div class="cart">
        <h2>Shopping Cart</h2>
        <ul id="cart-items">
          
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
                            <p class="price">Rs <?php echo $row['price']; ?></p>
                            <button class="btn add-to-cart-btn" onclick="addToCart(<?php echo $row['id']; ?>, '<?php echo $row['name']; ?>', <?php echo $row['price']; ?>)">Add to Cart</button>
                            <form action="wishlist.php" method="post">
                                <input type="hidden" name="productId" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btnw add-to-wishlist-btn">
                                        &#x2665;
                                    </button>
                            </form>


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

    
    
    
    <footer>
    <div class="footer-content">
        <nav class="footer-nav">
            <ul>
                <li><a href="contact_us.php">Contact Us</a></li>
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

var btn = document.getElementById("popupBtn");
var popup = document.getElementById("popup");
var closeBtn = document.getElementById("closeBtn");
var cartBadge = document.getElementById("cartBadge");
var cartContent = document.getElementById("cartContent");

var cartCount = 0; // Initialize cart count

btn.onclick = function() {
    popup.style.display = "block";
    cartCount++; // Increment cart count
    cartBadge.innerText = cartCount; // Update badge text
    cartBadge.style.display = "inline"; // Show badge
    // Add item to the top of the cart content
    var newItem = document.createElement("p");
    newItem.innerText = "Item " + cartCount;
    cartContent.insertBefore(newItem, cartContent.firstChild);
}

closeBtn.onclick = function() {
    popup.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == popup) {
        popup.style.display = "none";
    }
}
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
                            <span>${item.name} - Rs ${item.price} x </span>
                            <div class="item-quantity">
                                <input type="number" min="1" value="${item.quantity}" onchange="updateQuantity(${item.id}, this.value)">
                            </div>
                            <span class="item-total">Rs ${itemTotal.toFixed(2)}</span>
                        </div>
                        <button class="Rbtn" onclick="removeFromCart(${item.id})">Remove</button>
                    </li>
                `;
                total += itemTotal;
            });

            cartItemsElement.innerHTML = cartItemsHTML;
            cartTotalElement.textContent = `Rs${total.toFixed(2)}`;
        }
        function redirectToCheckout() {
    // Get the total price from the cart
    var totalPrice = document.getElementById("cart-total").innerText;
    // Encode the total price for URL
    var encodedPrice = encodeURIComponent(totalPrice);
    // Redirect to the checkout page with the total price in the URL parameters
    window.location.href = "checkout.php?total=" + encodedPrice;
}
    </script>
</body>
</html>
