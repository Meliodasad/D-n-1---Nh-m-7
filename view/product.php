<?php
require 'config.php'; // Kết nối đến cơ sở dữ liệu
include 'header.php';


require 'config.php'; 
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



    
<?php include 'footer.php'; ?>


    <script src="js/product.js"></script>


</body>
</html>

