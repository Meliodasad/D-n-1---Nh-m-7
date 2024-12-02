let productCount = 8;
const products = document.querySelectorAll('.product-list .product');

function hideExtraProducts() {
    for (let i = 8; i < products.length; i++) {
        products[i].style.display = 'none';
    }
}

function loadMoreProducts() {
    productCount += 8;
    if (productCount >= products.length) {
        document.getElementById('load-more').style.display = 'none'; 
    }
    for (let i = 0; i < productCount; i++) {
        products[i].style.display = 'block';
    }
}
hideExtraProducts();

document.querySelector('.quantity-btn.minus').addEventListener('click', () => {
    const quantityInput = document.getElementById('quantity');
    let currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
});

document.querySelector('.quantity-btn.plus').addEventListener('click', () => {
    const quantityInput = document.getElementById('quantity');
    quantityInput.value = parseInt(quantityInput.value) + 1;
});
