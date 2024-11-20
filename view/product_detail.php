<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stim Store</title>
    <link rel="stylesheet" href="css/mainstyle.css">
    <link rel="stylesheet" href="css/products.css">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <a href="index.php"><img src="image/logo.png" alt="Logo" width="50" height="50"></a>
            </div>
            <nav>
                <a href="index.php">Trang chủ</a>
                <a href="product.php">Sản phẩm</a>
                <a href="#">Giới thiệu</a>
                <a href="#">Tư Vấn</a>
                <a href="#">Liên hệ</a>
            </nav>
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Tìm kiếm...">
                <button id="search-button"><i class="fas fa-search"></i> Tìm</button>
            </div>
            <div id="search-results" class="product-list"></div>

            <div class="user-cart">
                <a href="dangnhap.html" class="login">Đăng nhập</a>
                <a href="dangky.html" class="signup">Đăng ký</a>
                <a href="cart.html" class="cart">
                    <i class="fas fa-shopping-cart"></i> Giỏ hàng
                </a>
            </div>
        </div>
    </header>

<section class="main-product">
    <section class="product-detail">
        <div class="product-container">
            <!-- Product Image -->
            <div class="product-image">
                <img src="image/dao dai.png" alt="Sản phẩm dao" width="400" height="400">
            </div>
    
            <!-- Product Details -->
            <div class="product-info">
                <h1>Dao Nhật Bản Cao Cấp</h1>
                <p class="product-description">
                    Dao Nhật Bản được chế tác từ thép không gỉ, sắc bén và bền bỉ, phù hợp với các đầu bếp chuyên nghiệp và gia đình. Mang lại trải nghiệm ẩm thực tuyệt vời.
                </p>
                <p class="product-price">Giá: <span>1.200.000₫</span></p>
    
                <!-- Quantity Selection -->
                <div class="product-quantity">
                    <label for="quantity">Số lượng:</label>
                    <button class="quantity-btn minus">-</button>
                    <input  id="quantity" value="1" min="1">
                    <button class="quantity-btn plus">+</button>
                </div>
    
                <!-- Action Buttons -->
                <div class="product-actions">
                    <a href="cart.html"><button class="btn add-to-cart"><i class="fas fa-cart-plus"></i> Thêm vào giỏ</button></a>
                    <button class="btn buy-now"><i class="fas fa-bolt"></i> Mua ngay</button>
                </div>
            </div>
        </div>
    </section>
    
<div class="sale-products">
    <h2>Sản phẩm liên quan</h2>
    <div class="product-grid">
        <div class="product">
            <img src="image/dao gyuto.jpg" alt="Product 1">
            <h3>Dao KAISHUN GYUTO</h3>
            <p class="sale-price">2,900,000₫</p>
            <a href="cart.html" class="buy-now">Thêm vào giỏ hàng</a>
        </div>
        <div class="product">
            <img src="image/dao deba.png" alt="Product 2">
            <h3>Dao Nhật DEBA</h3>
            <p class="sale-price">480,000₫</p>
            <a href="cart.html" class="buy-now">Thêm vào giỏ hàng</a>
        </div>
        <div class="product">
            <img src="image/dao nakiri.jpg" alt="Product 1">
            <h3>Dao Nhật NAKIRI</h3>
            <p class="sale-price">400,000₫</p>
            <a href="cart.html" class="buy-now">Thêm vào giỏ hàng</a>
        </div>
        <div class="product">
            <img src="image/dao paring.webp" alt="Product 1">
            <h3>Dao Nhật PARING</h3>
            <p class="sale-price">400,000₫</p>
            <a href="cart.html" class="buy-now">Thêm vào giỏ hàng</a>
        </div>
        <div class="product">
            <img src="image/dao santoku.webp" alt="Product 1">
            <h3>Dao Nhật SANTOKU</h3>
            <p class="sale-price">400,000₫</p>
            <a href="cart.html" class="buy-now">Thêm vào giỏ hàng</a>
        </div>  
    </div>
    <a href="product.php" class="view-all-button">
        Xem tất cả
    </a>
</div>
</section>
    
    <section class="footer">
        <div class="footer-container">
            <p>Nhận Tư Vấn</p>
            <div class="input-email">
                <input type="text" placeholder="Nhập Email của bạn...">
                <i class="fas fa-arrow-left"></i>
            </div>
            <div>
                <li><a href=""><img src="image/logo.png" alt="" width="50" height="50"></a></li>
                <li><a href="">Liên hệ</a></li>
                <li><a href="">Giới thiệu</a></li>
                <li><a href="">Tư Vấn</a></li>
                <li><a href=""><i class="fab fa-facebook-f"></i></a><a href=""><i class="fab fa-youtube"></i></a></li>
            </div>
            <div class="footer-text">
                Stim Store tự hào là thương hiệu chuyên cung cấp các loại dao Nhật Bản cao cấp <br>
            Mang lại chất lượng vượt trội và độ bền bỉ, đúng chuẩn tinh hoa ẩm thực Nhật Bản. Được kiểm duyệt và trải nghiệm bởi đầu bếp nổi tiếng Hoshi Đào. <br>
            FPT Polytechnic, đường Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, Hà Nội. <br>
            Hotline: 0345981925
            </div>
            <div>
                Copyright © 2024 Stim Store.
            </div>
        </div>
    </section>


    <script src="js/product.js"></script>


</body>
</html>

