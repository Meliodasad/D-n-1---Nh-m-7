<!-- Views/home.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Dao cao cấp G7Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <div class= "header-img"><img src="img/logo.jpg" alt=""></div>
            <nav>
                <a href="#">Trang chủ</a>
                <a href="#">Danh mục sản phẩm</a>
                <a href="#">Giới thiệu</a>
                <a href="#">Blog</a>
                <a href="#">Liên Hệ</a>
            </nav>
            <div class="search-bar">
                <input type="text" placeholder="Tìm kiếm sản phẩm...">
                <button>Tìm kiếm</button>
            </div>
        </div>
    </header>

    <!-- Banner -->
    <section class="banner">
    <img src="img/banner.jpg" alt="Banner Dao Cao Cấp">
    </section>

    <!-- Sản phẩm nổi bật -->
    <main>
        <section class="featured-products">
            <h2>Sản phẩm nổi bật</h2>
            <div class="product-list">
                <?php foreach ($products as $product): ?>
                    <div class="product-item">
                        <img src="<?= $product['image_url'] ?>" alt="<?= $product['name'] ?>">
                        <h3><?= $product['name'] ?></h3>
                        <p class="price"><?= $product['base_price'] ?> VND</p>
                        <p class="description"><?= substr($product['description'], 0, 50) . '...' ?></p>
                        <a href="productDetail.php?id=<?= $product['id'] ?>" class="btn-detail">Xem chi tiết</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <p>© 2024 G7Store - Dao cao cấp</p>
            <nav>
                <a href="#">Chính sách bảo mật</a>
                <a href="#">Điều khoản sử dụng</a>
                <a href="#">Liên hệ</a>
            </nav>
        </div>
    </footer>
</body>
</html>
