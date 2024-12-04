<?php
require 'config.php'; 

$sql_highlighted = "SELECT * FROM tbl_product WHERE is_highlighted = 1";
$highlighted_products = $conn->query($sql_highlighted)->fetchAll(PDO::FETCH_ASSOC);

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
    <?php
        include('header.php');
    ?>
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
                    <button onclick="addToCart(<?= $product['product_id'] ?>)">Thêm vào giỏ hàng</button>
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
                    <button onclick="addToCart(<?= $product['product_id'] ?>)">Thêm vào giỏ hàng</button>
                </div>
                <?php endforeach; ?>
            </div>
            <a href="product.php" class="view-all-button">
                Xem tất cả
            </a>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
    <script src="js/slide.js"></script>
    <script>
    function addToCart(productId) {
        fetch('add_to_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.success) {
                alert('Sản phẩm đã được thêm vào giỏ hàng!');
            } else {
                alert(data.message || 'Thêm vào giỏ hàng thất bại!');
            }
        })
        .catch(error => {
            console.error('Có lỗi xảy ra:', error);
            alert('Có lỗi xảy ra, vui lòng thử lại!');
        });
    }
</script>

</body>
</html>
