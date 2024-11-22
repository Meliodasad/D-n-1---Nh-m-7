<?php
<<<<<<< HEAD
require 'config.php'; // Kết nối đến cơ sở dữ liệu
include 'header.php';

// Lấy sản phẩm nổi bật
=======
require 'config.php'; 
>>>>>>> fd2f57db4c20fa57b734a8268c9f14ad282acefe
$sql_highlighted = "SELECT * FROM tbl_product WHERE is_highlighted = 1";
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
    <link rel="stylesheet" href="css/products.css">
</head>
<body>
<<<<<<< HEAD
=======
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
>>>>>>> fd2f57db4c20fa57b734a8268c9f14ad282acefe


<div class="product-page">

    <div class="top-row">
        <div class="product-sidebar">
                <h3>Danh mục sản phẩm</h3>
            <ul>
                <li><a href="#">Dao Cắt Thái</a></li>
                <li><a href="#">Dao Phi Lê</a></li>
                <li><a href="#">Dao Sushi</a></li>
                <li><a href="#">Dao Chặt Xương</a></li>
                <li><a href="#">Dao Bếp</a></li>
            </ul>
            <br>
            <h3>Lọc Giá</h3>
            <ul>
                <li><a href="">Dưới 1.000.000₫</a></li>
                <li><a href="">1.000.000₫ - 2.000.000₫</a></li>
                <li><a href="">2.000.000₫ - 3.000.000₫</a></li>
                <li><a href="">3.000.000₫ - 4.000.000₫</a></li>
                <li><a href="">Trên 4.000.000₫</a></li>
            </ul>
        </div>
        
        <div class="product-banner">
            <img src="image/banner3.webp" alt="Banner sản phẩm">
        </div>
    </div>
</div>
<section class="main-product">  
    <div class="highlighted-products">
        <h2>DAO NHẬT</h2>
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
        <button id="load-more" onclick="loadMoreProducts()">Xem thêm</button>
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

