let cart = []; // Array to store cart items

function addToCart(itemId, priceId, imgId) {
    // Get item name, price, and image from the HTML using IDs
    const itemElement = document.getElementById(itemId);
    const priceElement = document.getElementById(priceId);
    const imgElement = document.getElementById(imgId);

    if (!itemElement || !priceElement || !imgElement) {
        console.error('Element not found:', { itemId, priceId, imgId });
        alert('Error: Item, price, or image not found.');
        return; // Exit the function if elements are not found
    }

    const itemName = itemElement.innerText;
    const itemPrice = parseFloat(priceElement.innerText.replace(/[^0-9.-]+/g, "")); // Extract numeric value
    const itemImage = imgElement.src; // Get the image source

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
            quantity: 1,
            image: itemImage // Store the image source
        };
        cart.push(item);
    }

    updateCartItemCount();

     // Show notification modal
     const notificationMessage = `${itemName} has been added to your cart. Current quantity: ${existingItem ? existingItem.quantity : 1}`;
     document.getElementById('notificationMessage').innerText = notificationMessage;
     $('#notificationModal').modal('show');
 
     // Hide the modal after 3 seconds
     setTimeout(() => {
         $('#notificationModal').modal('hide');
     }, 3000);
     
     // Feedback for the user
     console.log('Added to cart:', cart);

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
        listItem.className = 'list-group-item d-flex align-items-center';

        listItem.innerHTML = `
            <div class="d-flex align-items-center">
                <img src="${item.image}" alt="${item.name}" class="img-thumbnail" style="width: 75px; height: 100px; margin-right: 10px;">
                <div class="ml-2">
                    <strong>${item.name}</strong><br>
                    <span>Quantity: ${item.quantity}</span><br>
                    <span>Price: $${item.price.toFixed(2)}</span><br>
                    <span>Subtotal: $${subtotal.toFixed(2)}</span>
                </div>
            </div>
        `;

        cartItemsList.appendChild(listItem);
    });

    // Update total amount in the modal
    document.getElementById('totalAmount').innerText = total.toFixed(2);

    // Show the modal
    $('#cartModal').modal('show');
}


function proceedToPayment() {
    // Store the cart in session through an AJAX call
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'db/cart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Redirect to payment page
            window.location.href = 'payment.php';
        }
    };
    xhr.send(JSON.stringify(cart));
}


function addToCartPayment(itemId, priceId, imgId, itemQuantity) {

    
    // If item doesn't exist, create a new entry with quantity set to 1
    const item = {
        name: itemId,
        price: priceId,
        quantity: itemQuantity,
        image: imgId // Store the image source
    };
    cart.push(item);

    updateCartItemCount();
}
