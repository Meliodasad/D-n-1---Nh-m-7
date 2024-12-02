<?php
require_once 'config.php'; 

$category_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$price_range = isset($_GET['price_range']) ? $_GET['price_range'] : null;

if ($category_id == 0) {
    header('Location: index.php');
    exit();
}

function getPriceFilter($price_range) {
    switch ($price_range) {
        case 'under_1000000':
            return [0, 1000000];
        case '1000000_2000000':
            return [1000000, 2000000];
        case '2000000_3000000':
            return [2000000, 3000000];
        case '3000000_4000000':
            return [3000000, 4000000];
        case 'above_4000000':
            return [4000000, PHP_INT_MAX];
        default:
            return null;
    }
}

$sql_categories = "SELECT * FROM tbl_category";
$stmt_categories = $conn->query($sql_categories);
$categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

$sql_category = "SELECT category_name FROM tbl_category WHERE category_id = :category_id";
$stmt_category = $conn->prepare($sql_category);
$stmt_category->bindParam(':category_id', $category_id, PDO::PARAM_INT);
$stmt_category->execute();
$category_name = $stmt_category->fetchColumn();

$sql_products = "SELECT * FROM tbl_product WHERE category_id = :category_id";
$price_filter = getPriceFilter($price_range);

if ($price_filter) {
    $sql_products .= " AND product_price BETWEEN :min_price AND :max_price";
}

$stmt_products = $conn->prepare($sql_products);
$stmt_products->bindParam(':category_id', $category_id, PDO::PARAM_INT);

if ($price_filter) {
    $stmt_products->bindParam(':min_price', $price_filter[0], PDO::PARAM_INT);
    $stmt_products->bindParam(':max_price', $price_filter[1], PDO::PARAM_INT);
}

$stmt_products->execute();
$products = $stmt_products->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục: <?php echo htmlspecialchars($category_name); ?></title>
    <link rel="stylesheet" href="css/mainstyle.css">
    <link rel="stylesheet" href="css/products.css">
</head>
<body>
<?php include('header.php'); ?>
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
            <li><a href="category.php?id=<?php echo $category_id; ?>&price_range=under_1000000">Dưới 1.000.000₫</a></li>
            <li><a href="category.php?id=<?php echo $category_id; ?>&price_range=1000000_2000000">1.000.000₫ - 2.000.000₫</a></li>
            <li><a href="category.php?id=<?php echo $category_id; ?>&price_range=2000000_3000000">2.000.000₫ - 3.000.000₫</a></li>
            <li><a href="category.php?id=<?php echo $category_id; ?>&price_range=3000000_4000000">3.000.000₫ - 4.000.000₫</a></li>
            <li><a href="category.php?id=<?php echo $category_id; ?>&price_range=above_4000000">Trên 4.000.000₫</a></li>
        </ul>
    </div>

    <div class="product-banner">
        <img src="image/banner3.webp" alt="Banner sản phẩm">
    </div>
</div>
</div>

<section class="main-product">
    <div class="highlighted-products">
    <h1>Danh mục: <?php echo htmlspecialchars($category_name); ?></h1>
    <div class="product-list">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product">
                <a href="product_detail.php?id=<?= $product['product_id'] ?>">
                    <img src="<?= $product['product_img'] ?>"  width="200" height="200">
                </a>
                    <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
                    <p>Giá: <?php echo number_format($product['product_price'], 0, ',', '.'); ?>₫</p>
                    <?php if (!empty($product['product_price_new'])): ?>
                        
                        </p>
                    <?php endif; ?>
                    <button onclick="addToCart(<?= $product['product_id'] ?>)">Thêm vào giỏ hàng</button>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Không có sản phẩm nào trong danh mục này.</p>
        <?php endif; ?>
    </div>
    </div>
    </section>

<?php include('footer.php'); ?>
</body>
</html>
