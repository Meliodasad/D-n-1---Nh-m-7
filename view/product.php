<?php
require 'config.php'; 

$sql_highlighted = "SELECT * FROM tbl_product WHERE is_highlighted = 1";
$highlighted_products = $conn->query($sql_highlighted)->fetchAll(PDO::FETCH_ASSOC);


$sql_on_sale = "SELECT * FROM tbl_product WHERE is_on_sale = 1";
$sale_products = $conn->query($sql_on_sale)->fetchAll(PDO::FETCH_ASSOC);

function getCategories() {
    global $conn;
    $sql = "SELECT category_id, category_name FROM tbl_category";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$categories = getCategories();
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
    <?php
        include('header.php');
    ?>



<div class="product-page">
    <div class="top-row">
            <div class="product-sidebar">
            <h3>Danh mục sản phẩm</h3>
            <ul>
                <?php foreach ($categories as $category): ?>
                    <li>
                        <a href="category.php?id=<?php echo $category['category_id']; ?>">
                            <?php echo htmlspecialchars($category['category_name']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <h3>Lọc Giá</h3>
            <ul>
                <li><a href="category.php?id=<?php echo $category_id ?: 0; ?>&price_range=under_1000000">Dưới 1.000.000₫</a></li>
                <li><a href="category.php?id=<?php echo $category_id ?: 0; ?>&price_range=1000000_2000000">1.000.000₫ - 2.000.000₫</a></li>
                <li><a href="category.php?id=<?php echo $category_id ?: 0; ?>&price_range=2000000_3000000">2.000.000₫ - 3.000.000₫</a></li>
                <li><a href="category.php?id=<?php echo $category_id ?: 0; ?>&price_range=3000000_4000000">3.000.000₫ - 4.000.000₫</a></li>
                <li><a href="category.php?id=<?php echo $category_id ?: 0; ?>&price_range=above_4000000">Trên 4.000.000₫</a></li>
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
                <button onclick="addToCart(<?= $product['product_id'] ?>)">Thêm vào giỏ hàng</button>
            </div>
            <?php endforeach; ?>
        </div>
        <button id="load-more" onclick="loadMoreProducts()">Xem thêm</button>
    </div>
</section>

<?php include 'footer.php'; ?>

<script src="js/product.js"></script>
<script>
    function addToCart(productId) {
        fetch('add_to_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Sản phẩm đã được thêm vào giỏ hàng!');
            } else {
                alert(data.message || 'Thêm vào giỏ hàng thất bại!');
            }
        })
        .catch(error => console.error('Lỗi:', error));
    }
</script>
</body>
</html>
