<?php
require 'config.php'; 
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

    <section class="main-container">
    <div class="highlighted-products">
        <h2>Sản phẩm tìm kiếm</h2>
        <div class="product-list">
<?php
// Kiểm tra xem có truy vấn 'query' hay không
if (isset($_GET['query']) && !empty(trim($_GET['query']))) {
    $query = trim($_GET['query']); // Lấy dữ liệu từ form
    $sql = "SELECT product_id, product_name, product_img, product_price 
            FROM tbl_product 
            WHERE product_name LIKE :query";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Kiểm tra nếu có sản phẩm được tìm thấy
    if (!empty($results)) {
        foreach ($results as $product) {
            echo '<div class="product">';
            echo '<a href="product_detail.php?id=' . htmlspecialchars($product['product_id']) . '">';
            echo '<img src="' . htmlspecialchars($product['product_img']) . '" alt="' . htmlspecialchars($product['product_name']) . '">';
            echo '</a>';
            echo '<h3>' . htmlspecialchars($product['product_name']) . '</h3>';
            echo '<p>' . number_format($product['product_price'], 0, ',', '.') . '₫</p>';
            echo '<a href="cart.php?add=' . htmlspecialchars($product['product_id']) . '"><button>Thêm vào giỏ hàng</button></a>';
            echo '</div>';
        }
    } else {
        echo '<p>Không tìm thấy sản phẩm phù hợp.</p>';
    }
} else {
    echo '<p>Vui lòng nhập từ khóa tìm kiếm.</p>';
}
?>
</div>
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
