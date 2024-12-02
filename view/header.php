<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stim Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="mainstyle.css">
    
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
            <a href="about.php">Giới thiệu</a>
            <a href="consulting.php">Tư Vấn</a>
            <a href="contact.php">Liên hệ</a>
            
        </nav>
        <div class="search-bar">
    <form method="GET" action="search.php">
        <input type="text" id="search-input" name="query" placeholder="Tìm kiếm...">
        <button type="submit" id="search-button"><i class="fas fa-search"></i> Tìm</button>
    </form>
</div>


        <div class="user-cart">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span style="margin: 0px 30px">Xin chào,<br> <?= htmlspecialchars($_SESSION['email']) ?></span>
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
<style>
    
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
}


.user-cart {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-shrink: 0;
}

.user-cart span {
    font-size: 14px;
    color: #00b4d8;
}

.user-cart a {
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s ease;
}

.user-cart a:hover {
    color: #ebd3b8;
}

.user-cart .cart {
    display: flex;
    align-items: center;
    gap: 5px;
}

.user-cart .cart i {
    font-size: 18px;
}
.header {
    background-color: #333333;
    color: #fff;
    padding: 10px 20px;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: nowrap;
}


.logo img {
    display: block;
}

nav {
    display: flex;
    gap: 20px;
    flex-shrink: 0;
}

nav a {
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    transition: color 0.3s ease;
}

nav a:hover {
    color: #ebd3b8;
}


.search-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
}

.search-bar input[type="text"] {
    padding: 8px 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    outline: none;
    font-size: 14px;
    width: 200px; 
    transition: box-shadow 0.3s ease; 
}

.search-bar input[type="text"]:focus {
    box-shadow: 0 0 5px rgba(0, 180, 216, 0.5);
}

.search-bar button {
    padding: 8px 12px;
    background-color: #ebd3b8;
    border: none;
    color: #fff;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.search-bar button:hover {
    background-color: #ebd3b8;
}


@media (max-width: 768px) {
    .header-container {
        flex-direction: column;
        align-items: flex-start;
    }

    nav {
        flex-wrap: wrap;
        gap: 10px;
    }

    .search-bar input[type="text"] {
        width: 100%;
    }
}

</style>
</body>
</html>

