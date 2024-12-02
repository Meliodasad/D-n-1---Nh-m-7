<?php
include('config.php');
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm-password'] ?? '';
    $phone = trim($_POST['phone'] ?? '');

    if (!empty($username) && !empty($email) && !empty($password) && !empty($confirm_password) && !empty($phone)) {
        if ($password === $confirm_password) {
            $stmt = $conn->prepare("SELECT id FROM tbl_user WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Email đã tồn tại!');</script>";
            } else {
                $role = 2;
                $stmt = $conn->prepare("INSERT INTO tbl_user (username, email, password, phone, role) VALUES (?, ?, ?, ?, ?)");
                if ($stmt->execute([$username, $email, $password, $phone, $role])) {
                    echo "<script>alert('Đăng ký thành công!');</script>";
                } else {
                    echo "<script>alert('Lỗi khi đăng ký: " . $stmt->errorInfo()[2] . "');</script>";
                }
            }
        } else {
            echo "<script>alert('Mật khẩu xác nhận không khớp!');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="css/mainstyle.css">
</head>
<body>

    <section class="dangky-section">
        <div class="dangky-container">
            <h2><a href="dangnhap.php">Đăng Nhập</a>  |  <a href="dangky.php">Đăng Ký</a></h2>
            <form action="" method="post" class="signup-form">
                <div class="form-group">
                    <label for="username">Họ Tên</label>
                    <input type="text" id="username" name="username" required placeholder="Nhập họ tên của bạn">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="Nhập email của bạn">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu của bạn">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Xác nhận mật khẩu</label>
                    <input type="password" id="confirm-password" name="confirm-password" required placeholder="Nhập lại mật khẩu">
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="tel" id="phone" name="phone" required placeholder="Nhập số điện thoại của bạn">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-submit">Đăng Ký</button>
                </div>
            </form>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>
</body>
</html>
