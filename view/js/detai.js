function updateQuantity(change) {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);

    currentQuantity += change;
    if (currentQuantity < 1) {
        currentQuantity = 1;
    }

    quantityInput.value = currentQuantity;
}
