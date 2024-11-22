<?php
require 'config.php'; 

$sql_highlighted = "SELECT * FROM tbl_product WHERE is_highlighted = 1 LIMIT 8";
$highlighted_products = $conn->query($sql_highlighted)->fetchAll(PDO::FETCH_ASSOC);


$sql_on_sale = "SELECT * FROM tbl_product WHERE is_on_sale = 1";
$sale_products = $conn->query($sql_on_sale)->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stim Store</title>
    <link rel="stylesheet" href="css/mainstyle.css">
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
    <form method="GET" action="search.php">
        <input type="text" id="search-input" name="query" placeholder="Tìm kiếm...">
        <button type="submit" id="search-button"><i class="fas fa-search"></i> Tìm</button>
    </form>
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

<div class="slide-show">
    <div class="slide-container">
        <img src="image/banner1.webp" alt="Image 1" class="slide">
        <img src="image/banner2.webp" alt="Image 2" class="slide">
        <img src="image/banner3.webp" alt="Image 3" class="slide">
        <img src="image/banner4.webp" alt="Image 4" class="slide">
        <img src="image/banner5.webp" alt="Image 5" class="slide">
    </div>
</div>

<section class="main-container">
    <div class="highlighted-products">
        <h2>Sản phẩm nổi bật</h2>
        <div class="product-list">
            <?php foreach ($highlighted_products as $product): ?>
            <div class="product">
                <a href="product_detail.php?id=<?= $product['product_id'] ?>">
                    <img src="<?= $product['product_img'] ?>" alt="<?= htmlspecialchars($product['product_name']) ?>" width="200" height="200">
                </a>
                <h3><?= htmlspecialchars($product['product_name']) ?></h3>
                <p><?= number_format($product['product_price'], 0, ',', '.') ?>₫</p>
                <a href="cart.php?add=<?= $product['product_id'] ?>"><button>Thêm vào giỏ hàng</button></a>
            </div>
            <?php endforeach; ?>
        </div>
        <a href="product.php" class="view-all-button">
            Xem tất cả dao Nhật
        </a>
        <div class="home-banner">
            <a href="product.php"><img src="image/homebanner_1.webp" alt="Home Banner 1" class="banner-image"></a>
            <a href="product.php"><img src="image/homebanner_2.webp" alt="Home Banner 2" class="banner-image"></a>
        </div>
    </div>
    

    <div class="sale-products">
        <h2>Sản phẩm đang giảm giá</h2>
        <div class="product-grid">
            <?php foreach ($sale_products as $product): ?>
            <div class="product">
                <a href="product_detail.php?id=<?= $product['product_id'] ?>">
                    <img src="<?= $product['product_img'] ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
                </a>
                <h3><?= htmlspecialchars($product['product_name']) ?></h3>
                <p class="original-price"><?= number_format($product['product_price'], 0, ',', '.') ?>₫</p>
                <p class="sale-price"><?= number_format($product['product_price_new'], 0, ',', '.') ?>₫</p>
                <a href="cart.php?add=<?= $product['product_id'] ?>" class="buy-now">Thêm vào giỏ hàng</a>
            </div>
            <?php endforeach; ?>
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

    <script src="js/script.js"></script>

    <script src="js/slide.js"></script>


</body>
</html>






