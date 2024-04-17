document.addEventListener('DOMContentLoaded', function() {
    const itemsContainer = document.getElementById('items');
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const checkoutBtn = document.getElementById('checkout-btn');

    let cart = [];

    // Sample product data
    const products = [
        { id: 1, name: 'Product 1', price: 10 },
        { id: 2, name: 'Product 2', price: 20 },
        { id: 3, name: 'Product 3', price: 30 }
    ];

    // Display products
    function displayProducts() {
        itemsContainer.innerHTML = '';
        products.forEach(product => {
            const itemDiv = document.createElement('div');
            itemDiv.classList.add('item');
            itemDiv.innerHTML = `
                <h3>${product.name}</h3>
                <p>$${product.price}</p>
                <button class="add-to-cart-btn" data-id="${product.id}">Add to Cart</button>
            `;
            itemsContainer.appendChild(itemDiv);
        });
    }

    // Add product to cart
    function addToCart(id) {
        const product = products.find(p => p.id === id);
        if (product) {
            cart.push(product);
            displayCart();
        }
    }

    // Display cart
    function displayCart() {
        cartItems.innerHTML = '';
        let total = 0;
        cart.forEach(item => {
            const li = document.createElement('li');
            li.textContent = `${item.name} - $${item.price}`;
            cartItems.appendChild(li);
            total += item.price;
        });
        cartTotal.textContent = total.toFixed(2);
    }

    // Handle add to cart button clicks
    itemsContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('add-to-cart-btn')) {
            const id = parseInt(event.target.getAttribute('data-id'));
            addToCart(id);
        }
    });

    // Handle checkout button click
    checkoutBtn.addEventListener('click', function() {
        // You can add your checkout logic here, such as redirecting to a checkout page or processing the order
        alert('Checkout clicked!');
    });

    // Initial display
    displayProducts();
});
