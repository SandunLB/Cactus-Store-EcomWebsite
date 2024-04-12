// Array to store cart items
let cart = [];

// Function to add item to cart
function addToCart(id) {
    // Simulated product data, replace with actual product data
    const product = {
        id: id,
        name: `Product ${id}`,
        price: 10 // Sample price, replace with actual price
    };

    // Check if item is already in cart
    const existingItem = cart.find(item => item.id === id);
    if (existingItem) {
        // Increment quantity if item is already in cart
        existingItem.quantity++;
    } else {
        // Add item to cart with quantity 1
        cart.push({ ...product, quantity: 1 });
    }

    // Update cart display
    displayCart();
}

// Function to display cart items
function displayCart() {
    const cartContainer = document.getElementById('cart-items');
    cartContainer.innerHTML = '';

    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `
            <p>${item.name} - $${item.price} - Quantity: ${item.quantity}</p>
        `;
        cartContainer.appendChild(cartItem);
    });
}

// Function to handle checkout
function checkout() {
    // Simulate payment process
    alert('Payment successful! Thank you for your purchase.');

    // Clear cart after checkout
    cart = [];
    displayCart();
}

// Event listeners
document.addEventListener('DOMContentLoaded', () => {
    displayCart();

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', () => {
            const id = parseInt(button.dataset.id);
            addToCart(id);
        });
    });

    document.getElementById('checkout').addEventListener('click', checkout);
});
