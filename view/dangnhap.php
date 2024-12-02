<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, password, role FROM tbl_user WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($password === $user['password']) {
                session_start();
                $_SESSION = [
                    'user_id' => $user['id'],
                    'role'    => $user['role'],
                    'email'   => $email,
                ];

                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Mật khẩu không đúng!');</script>";
            }
        } else {
            echo "<script>alert('Email không tồn tại!');</script>";
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
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="css/mainstyle.css">
</head>
<body>
    <?php include('header.php'); ?>
    <section class="login-section">
        <div class="login-container">
            <h2><a href="dangnhap.php">Đăng Nhập</a> | <a href="dangky.php">Đăng Ký</a></h2>
            <form action="" method="POST" class="login-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Nhập email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" class="btn-submit">Đăng Nhập</button>
            </form>
            <p>Bạn không nhớ tài khoản & mật khẩu của mình: <a href="quenmatkhau.php">Quên mật khẩu</a></p>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>
