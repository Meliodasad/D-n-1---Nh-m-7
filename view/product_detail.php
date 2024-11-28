<?php
require_once 'config.php';

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id == 0) {
    header('Location: index.php');
    exit();
}

function getProductDetails($product_id) {
    global $conn;
    $sql = "SELECT * FROM tbl_product WHERE product_id = :product_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$product = getProductDetails($product_id);

if (!$product) {
    echo "<p>Sản phẩm không tồn tại.</p>";
    exit();
}

$related_products = getRelatedProducts($product['category_id'], $product['product_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['product_name']); ?></title>
    <link rel="stylesheet" href="css/mainstyle.css">
    <link rel="stylesheet" href="css/products.css">
    <link rel="stylesheet" href="css/products_detail.css">
</head>
<body>
<?php include 'header.php'; ?>
<main class="product-detail">
    <div class="product-image">
        <img src="<?= $product['product_img'] ?>" alt="<?= htmlspecialchars($product['product_name']) ?>" width="300" height="300">
    </div>
    <div class="product-info">
        <h1><?php echo htmlspecialchars($product['product_name']); ?></h1>
        <p><strong>Giá:</strong> <?php echo number_format($product['product_price'], 0, ',', '.'); ?>₫</p>
        <?php if (!empty($product['product_price_new'])): ?>
        <?php endif; ?>
        <p><strong>Mô tả:</strong> <?php echo nl2br(htmlspecialchars($product['product_desc'])); ?></p>

        <div class="quantity-container">
            <p>Số lượng:</p>
            <button class="quantity-btn" id="decrease" onclick="updateQuantity(-1)">-</button>
            <input  id="quantity" value="1" min="1" />
            <button class="quantity-btn" id="increase" onclick="updateQuantity(1)">+</button>
        </div>
        
        <a href="add_to_cart.php"><button class="add-to-cart-btn" onclick="addToCart(<?= $product['product_id'] ?>)">Thêm vào giỏ hàng</button></a>
    </div>
</main>

    </main>



    <section class="main-product">
    <div class="highlighted-products">
    <h2>Sản phẩm liên quan</h2>
    <div class="product-list">
        <?php  
        $related_products = getRelatedProducts($product['category_id'], $product['product_id']);
        foreach ($related_products as $related_product): ?>
            <div class="product">
                <a href="product_detail.php?id=<?= $related_product['product_id'] ?>">
                    <img src="<?= $related_product['product_img'] ?>" alt="<?= htmlspecialchars($related_product['product_name']) ?>" width="150" height="150">
                </a>
                <h4><?= htmlspecialchars($related_product['product_name']) ?></h4>
                <p><?= number_format($related_product['product_price'], 0, ',', '.') ?>₫</p>
                <a href="add_to_cart.php"><button  onclick="addToCart(<?= $product['product_id'] ?>)">Thêm vào giỏ hàng</button></a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</section>
<script src="js/detai.js"></script>

<?php include 'footer.php'; ?>
</body>
</html>
