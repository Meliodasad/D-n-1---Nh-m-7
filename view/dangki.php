<?php
include 'module.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    
    $check_query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
    mysqli_stmt_execute($stmt);
    $check_result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Username hoặc Email đã tồn tại. Vui lòng chọn thông tin khác.');</script>";
    } else {
        
        $insert_query = "INSERT INTO users (username, password, email, phone, created_at, updated_at, role) 
                         VALUES (?, ?, ?, ?, NOW(), NOW(), 'customer')";
        $stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt, 'ssss', $username, $hashed_password, $email, $phone);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Đăng ký thành công! Bạn có thể đăng nhập.'); window.location.href = 'dangnhap.php';</script>";
        } else {
            echo "<script>alert('Đã xảy ra lỗi, vui lòng thử lại.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bán Dao Nhật</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Đăng Kí</h2>
        <form action="dangki.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" required><br>

            <button type="submit" name="register">Đăng kí</button>
        </form>
    </div>
</body>
</html>
