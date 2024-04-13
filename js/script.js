// Function to update the cart count in the header
function updateCartCount(count) {
    const cartCountElement = document.querySelector('.cart-count');
    cartCountElement.textContent = count;
}

// Function to add a product to the cart
function addToCart(productId) {
    // Logic to add the product to the cart (e.g., update cart in local storage)
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.push(productId);
    localStorage.setItem('cart', JSON.stringify(cart));
    
    // Update cart count in the header
    updateCartCount(cart.length);
}

// Function to initialize the cart count
function initCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    updateCartCount(cart.length);
}

// Function to handle form submission (e.g., for checkout)
function handleFormSubmit(event) {
    event.preventDefault();
    // Logic to handle form submission (e.g., validate inputs, send data to server)
    // Example:
    // const formData = new FormData(event.target);
    // const serializedForm = Object.fromEntries(formData.entries());
    // console.log(serializedForm);
}

// Event listener for document ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize cart count
    initCartCount();

    // Event listener for add to cart buttons
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = button.dataset.productId;
            addToCart(productId);
        });
    });

    // Event listener for form submission (e.g., checkout)
    const checkoutForm = document.querySelector('#checkout-form');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', handleFormSubmit);
    }
});
