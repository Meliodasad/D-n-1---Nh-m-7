<?php
// Kết nối cơ sở dữ liệu
include 'config.php';

// Lấy danh sách sản phẩm nổi bật từ bảng products
try {
    $query = "SELECT * FROM tbl_product WHERE category_id = 1";
    // Chỉnh lại tên bảng nếu cần
    $stmt = $pdo->query($query);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}
?>
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
    <section class="sale-products">
        <h2>Sản phẩm nổi bật</h2>
        <div class="product-grid">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product">
                        <img src="image/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" width="200">
                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <p class="sale-price"><?= htmlspecialchars(number_format($product['price'], 0, ',', '.')) ?>₫</p>
                        <a href="cart.html" class="buy-now">Thêm vào giỏ hàng</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có sản phẩm nổi bật nào.</p>
            <?php endif; ?>
        </div>
        <a href="product.php" class="view-all-button">Xem tất cả</a>
    </section>
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
