<?php
session_start();
$conn = new mysqli("localhost", "root", "khaikhai", "duan1");

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Lấy thông tin người dùng
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Xử lý cập nhật thông tin cá nhân
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sql = "UPDATE users SET email='$email', phone='$phone', updated_at=NOW() WHERE id='$user_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Quản lý thông tin cá nhân</title></head>
<body>
    <h2>Thông tin cá nhân</h2>
    <form method="POST" action="">
        <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <input type="text" name="phone" value="<?= $user['phone'] ?>" required>
        <button type="submit">Cập nhật</button>
    </form>
    <a href="logout.php">Đăng xuất</a>
</body>
</html>
