<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="mainstyle.cs">
    
</head>
<body>
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

        <!-- Tìm kiếm -->
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Tìm kiếm...">
            <button id="search-button"><i class="fas fa-search"></i> Tìm</button>
        </div>
        <div id="search-results" class="product-list"></div>

        <div class="user-cart">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span>Xin chào, <?= htmlspecialchars($_SESSION['email']) ?></span>
                <a href="dangxuat.php" class="logout">Đăng xuất</a>
            <?php else: ?>
                <a href="dangnhap.php" class="login">Đăng nhập</a>
                <a href="dangky.php" class="signup">Đăng ký</a>
            <?php endif; ?>
            <a href="cart.php" class="cart">
            
                <i class="fas fa-shopping-cart"></i> Giỏ hàng
            </a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
                <a href="/DuAn1/admin/index.php">Vào trang quản trị</a>
            <?php endif; ?>
        </div>
    </div>
</header>
</body>
</html>

