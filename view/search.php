<?php
header('Content-Type: application/json');

$host = 'localhost';
$dbname = 'duan11';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Lấy từ khóa tìm kiếm từ URL
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
    

    // Truy vấn sản phẩm theo từ khóa
    $stmt = $conn->prepare("SELECT product_id, product_name, product_price, product_img FROM tlb_product WHERE name LIKE :keyword");
    $stmt->execute(['keyword' => "%$keyword%"]);

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($products);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
