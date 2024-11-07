<?php
session_start();
$conn = new mysqli("localhost", "root", "khaikhai", "duan1"); // Thay đổi với thông tin của bạn

// Xử lý đăng ký
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sql = "INSERT INTO users (username, password, email, phone, created_at) VALUES ('$username', '$password', '$email', '$phone', NOW())";
    if ($conn->query($sql) === TRUE) {
        echo "Đăng ký thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Đăng ký</title></head>
<body>
    <h2>Đăng ký</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <button type="submit">Register</button>
    </form>
</body>
</html>
