let cart = []; // Array to store cart items

function addToCart(itemId, priceId) {
    // Get item name and price from the HTML using IDs
    const itemElement = document.getElementById(itemId);
    const priceElement = document.getElementById(priceId);

    if (!itemElement || !priceElement) {
        console.error('Element not found:', { itemId, priceId });
        alert('Error: Item or price not found.');
        return; // Exit the function if elements are not found
    }

    const itemName = itemElement.innerText;
    const itemPrice = parseFloat(priceElement.innerText.replace(/[^0-9.-]+/g, "")); // Extract numeric value

    // Check if the item is already in the cart
    const existingItem = cart.find(item => item.name === itemName);

    if (existingItem) {
        // If item exists, increase the quantity
        existingItem.quantity += 1;
    } else {
        // If item doesn't exist, create a new entry with quantity set to 1
        const item = {
            name: itemName,
            price: itemPrice,
            quantity: 1
        };
        cart.push(item);
    }

    updateCartItemCount();
    
    // Feedback for the user
    console.log('Added to cart:', cart);
    alert(itemName + ' has been added to your cart. Current quantity: ' + (existingItem ? existingItem.quantity : 1));
}

function updateCartItemCount() {
    const itemCount = cart.reduce((total, item) => total + item.quantity, 0);
    const cartItemCount = document.getElementById('cartItemCount');

    if (itemCount > 0) {
        cartItemCount.innerText = itemCount;
        cartItemCount.style.display = 'inline'; // Show badge
    } else {
        cartItemCount.style.display = 'none'; // Hide badge
    }
}

function viewCart() {
    const cartItemsList = document.getElementById('cartItemsList');
    cartItemsList.innerHTML = ''; // Clear the current list
    let total = 0; // Initialize total

    cart.forEach(item => {
        const subtotal = item.price * item.quantity;
        total += subtotal;

        const listItem = document.createElement('li');
        listItem.className = 'list-group-item';
        listItem.innerHTML = `
            <strong>${item.name}</strong> - $${item.price.toFixed(2)} x ${item.quantity} = $${subtotal.toFixed(2)}
        `;
        cartItemsList.appendChild(listItem);
    });

    // Update total amount in the modal
    document.getElementById('totalAmount').innerText = total.toFixed(2);

    // Show the modal
    $('#cartModal').modal('show');
}
