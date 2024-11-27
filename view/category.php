<?php
require_once 'config.php';

$category_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$price_range = isset($_GET['price_range']) ? $_GET['price_range'] : null;

if ($category_id <= 0) {
    header('Location: index.php');
    exit();
}

function getCategoryName($category_id) {
    global $conn;
    $sql = "SELECT category_name FROM tbl_category WHERE category_id = :category_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn() ?: 'Danh mục không tồn tại';
}

function getProductsByCategoryAndPrice($category_id, $price_range) {
    global $conn;
    $sql = "SELECT * FROM tbl_product WHERE category_id = :category_id";

    if ($price_range) {
        switch ($price_range) {
            case 'under_1000000':
                $sql .= " AND product_price < 1000000";
                break;
            case '1000000_2000000':
                $sql .= " AND product_price BETWEEN 1000000 AND 2000000";
                break;
            case '2000000_3000000':
                $sql .= " AND product_price BETWEEN 2000000 AND 3000000";
                break;
            case '3000000_4000000':
                $sql .= " AND product_price BETWEEN 3000000 AND 4000000";
                break;
            case 'above_4000000':
                $sql .= " AND product_price > 4000000";
                break;
        }
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$category_name = getCategoryName($category_id);
$products = getProductsByCategoryAndPrice($category_id, $price_range);
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
<main>
    <h1>Danh mục: <?php echo htmlspecialchars($category_name); ?></h1>
    <div class="filter">
        <h3>Lọc Giá</h3>
        <ul>
            <li><a href="category.php?id=<?php echo $category_id; ?>&price_range=under_1000000">Dưới 1.000.000₫</a></li>
            <li><a href="category.php?id=<?php echo $category_id; ?>&price_range=1000000_2000000">1.000.000₫ - 2.000.000₫</a></li>
            <li><a href="category.php?id=<?php echo $category_id; ?>&price_range=2000000_3000000">2.000.000₫ - 3.000.000₫</a></li>
            <li><a href="category.php?id=<?php echo $category_id; ?>&price_range=3000000_4000000">3.000.000₫ - 4.000.000₫</a></li>
            <li><a href="category.php?id=<?php echo $category_id; ?>&price_range=above_4000000">Trên 4.000.000₫</a></li>
        </ul>
    </div>
    <div class="product-list">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-item">
                    <img src="images/<?php echo htmlspecialchars($product['product_img']); ?>" 
                         alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                    <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
                    <p>Giá: <?php echo number_format($product['product_price'], 0, ',', '.'); ?>₫</p>
                    <?php if (!empty($product['product_price_new'])): ?>
                        <p>Giá khuyến mãi: 
                            <span style="color: red;">
                                <?php echo number_format($product['product_price_new'], 0, ',', '.'); ?>₫
                            </span>
                        </p>
                    <?php endif; ?>
                    <a href="product.php?id=<?php echo $product['product_id']; ?>">Xem chi tiết</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Không có sản phẩm nào trong danh mục này.</p>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
