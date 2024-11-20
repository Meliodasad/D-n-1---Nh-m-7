document.getElementById('search-button').addEventListener('click', () => {
    const keyword = document.getElementById('search-input').value.trim();
    searchProducts(keyword);
});

function searchProducts(keyword) {
    if (!keyword) {
        alert('Vui lòng nhập từ khóa tìm kiếm!');
        return;
    }

    fetch(`http://localhost/www/DuAn1--Nhom-7/view/search.php?keyword=${encodeURIComponent(keyword)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(products => {
            const searchResults = document.getElementById('search-results');
            searchResults.innerHTML = ''; // Xóa kết quả cũ

            if (products.length === 0) {
                searchResults.innerHTML = '<p>Không tìm thấy sản phẩm nào phù hợp.</p>';
                return;
            }

            // Hiển thị kết quả tìm kiếm
            products.forEach(product => {
                const productDiv = document.createElement('div');
                productDiv.classList.add('product');

                productDiv.innerHTML = `
                    <img src="${product.image}" alt="${product.name}" width="200" height="200">
                    <h3>${product.name}</h3>
                    <p>${Number(product.price).toLocaleString('vi-VN')}₫</p>
                    <a href="cart.html"><button>Thêm vào giỏ hàng</button></a>
                `;

                searchResults.appendChild(productDiv);
            });
        })
        .catch(error => {
            console.error('Lỗi khi tìm kiếm sản phẩm:', error);
            alert('Đã xảy ra lỗi khi tìm kiếm sản phẩm. Vui lòng thử lại sau!');
        });
}
