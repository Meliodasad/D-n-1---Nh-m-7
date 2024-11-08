<?php
// Bắt đầu phiên làm việc và kiểm tra xem admin đã đăng nhập chưa
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php'); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit();
}

// Tạo kết nối đến database
$host = 'localhost';
$dbname = 'duan1';
$username = 'root';
$password = '052005';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
}

// Lấy số lượng sản phẩm, đơn hàng, khách hàng
$product_count = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$order_count = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$customer_count = $pdo->query("SELECT COUNT(*) FROM customers")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .dashboard-title {
            text-align: center;
            margin-top: 20px;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }
        .stat-box {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 30%;
            text-align: center;
            box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
        }
        .stat-box h2 {
            margin: 0;
            font-size: 2em;
        }
        .stat-box p {
            margin: 10px 0 0;
            color: #555;
        }
        .logout {
            text-align: right;
            margin-top: 10px;
        }
        .logout a {
            color: #555;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logout">
            <a href="logout.php">Đăng xuất</a>
        </div>
        <h1 class="dashboard-title">Trang Tổng Quan Quản Trị</h1>
        <div class="stats">
            <div class="stat-box">
                <h2><?php echo $product_count; ?></h2>
                <p>Sản phẩm</p>
            </div>
            <div class="stat-box">
                <h2><?php echo $order_count; ?></h2>
                <p>Đơn hàng</p>
            </div>
            <div class="stat-box">
                <h2><?php echo $customer_count; ?></h2>
                <p>Khách hàng</p>
            </div>
        </div>
    </div>
</body>
</html>

svajbgvadgjadv
