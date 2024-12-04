<?php
include 'header.html';
include 'slider.html';
include_once "database.php";  // Bao gồm file database.php để kết nối và thực hiện truy vấn

// Kết nối đến cơ sở dữ liệu
$db = Database::getInstance(); 

$query = "SELECT id, username, password, email, phone FROM tbl_user";
    $result = $db->select($query);

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Xóa tài khoản từ cơ sở dữ liệu
    $delete_query = "DELETE FROM tbl_user WHERE id = $delete_id";
    $delete_result = $db->delete($delete_query);

    // Kiểm tra và thông báo xóa thành công
    if ($delete_result) {
        echo "<script>alert('Tài khoản đã được xóa!'); window.location.href = 'user.php';</script>";
    } else {
        echo "<script>alert('Xóa tài khoản thất bại!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Tài Khoản</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-content-right">
        <div class="admin-content-right-product_list">
            <h1>Danh sách tài khoản</h1>
            <table border="1" cellspacing="0" cellpadding="10">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Người Dùng</th>
                        <th>Mật Khẩu</th>
                        <th>Emai</th>
                        <th>Số Điện Thoại</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result) {
                        // Duyệt qua các dòng dữ liệu và hiển thị trong bảng
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['password'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td><a href='?delete_id=" . $row['id'] . "' onclick='return confirm(\"Bạn có chắc muốn xóa tài khoản này không?\")'>Xóa</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Không có tài khoản nào</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
