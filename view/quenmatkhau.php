<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $newPassword = $_POST['new-password'] ?? '';
    $confirmPassword = $_POST['confirm-password'] ?? '';

    if (!empty($email) && !empty($newPassword) && !empty($confirmPassword)) {
        if ($newPassword === $confirmPassword) {
            // Kiểm tra email có tồn tại không
            $stmt = $conn->prepare("SELECT id FROM tbl_user WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                // Cập nhật mật khẩu
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                $stmt = $conn->prepare("UPDATE tbl_user SET password = ? WHERE email = ?");
                if ($stmt->execute([$hashedPassword, $email])) {
                    echo "<script>alert('Mật khẩu đã được thay đổi thành công!');</script>";
                } else {
                    echo "<script>alert('Lỗi khi đặt lại mật khẩu!');</script>";
                }
            } else {
                echo "<script>alert('Email không tồn tại trong hệ thống!');</script>";
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
    <title>Quên Mật Khẩu</title>
    <link rel="stylesheet" href="mainstyle.css">
</head>
<body>
<?php include('header.php'); ?>
    <h2>Quên Mật Khẩu</h2>
    <form action="" method="post">
        <div class="quenmatkhau">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
       
            <label for="new-password">Mật khẩu mới:</label>
            <input type="password" id="new-password" name="new-password" required>
       
            <label for="confirm-password">Xác nhận mật khẩu:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
        
        <button type="submit">Đổi Mật Khẩu</button>
        <a href="dangnhap.php">Quay Lại Trang Đăng Nhập</a>
    </div>
    </form>
    <?php include 'footer.php'; ?>
</body>
</html>
