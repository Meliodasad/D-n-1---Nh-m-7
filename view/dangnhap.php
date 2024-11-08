<?php
session_start();
include 'module.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($username) && !empty($password)) {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            if ($password === $user['password']) { 
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email']; 
                $_SESSION['phone'] = $user['phone'];
                $_SESSION['role'] = $user['role'];    

                header('Location: index.php');
                exit();
            } else {
                echo "<script>alert('Sai mật khẩu, vui lòng thử lại !.');</script>";
            }
        } else {
            echo "<script>alert('Không tìm thấy thông tin tài khoản, vui lòng kiểm tra lại.');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin để đăng nhập.');</script>";
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
        <h2>Đăng nhập bằng tài khoản của bạn</h2>
        <form action="dangnhap.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" placeholder="Enter your username" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required><br>

            <button type="submit" name="login">Login</button>
        </form>
        <p>Bạn chưa có tài khoản ?<a href="dangki.php">Đăng kí</a></p>
    </div>
</body>
</html>
