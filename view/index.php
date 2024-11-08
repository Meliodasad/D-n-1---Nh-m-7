<?php
session_start();


if (!isset($_SESSION['id'])) {
    header('Location: dangnhap.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
        <p><strong>Phone:</strong> <?php echo $_SESSION['phone']; ?></p>
        <p><strong>Role:</strong> <?php echo $_SESSION['role']; ?></p>
        <p><a href="dangxuat.php">Đăng Xuất</a></p>
    </div>
</body>
</html>
