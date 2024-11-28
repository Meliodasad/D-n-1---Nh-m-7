function updateQuantity(change) {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);

    // Cập nhật số lượng, đảm bảo không giảm dưới 1
    currentQuantity += change;
    if (currentQuantity < 1) {
        currentQuantity = 1;
    }

    quantityInput.value = currentQuantity;
}
