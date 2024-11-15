let productCount = 8; // Số sản phẩm ban đầu hiển thị
const products = document.querySelectorAll('.product-list .product'); // Lấy tất cả các sản phẩm

// Ẩn các sản phẩm không cần thiết
function hideExtraProducts() {
    for (let i = 8; i < products.length; i++) {
        products[i].style.display = 'none';
    }
}

function loadMoreProducts() {
    productCount += 8; // Mỗi lần nhấn, hiển thị thêm 8 sản phẩm
    if (productCount >= products.length) {
        document.getElementById('load-more').style.display = 'none'; // Ẩn nút nếu không còn sản phẩm để hiển thị
    }
    for (let i = 0; i < productCount; i++) {
        products[i].style.display = 'block';
    }
}

// Gọi hàm ẩn sản phẩm ban đầu
hideExtraProducts();

// chi tiết product js

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
