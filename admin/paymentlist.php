<?php
include 'header.html';
include 'slider.html';
include_once "database.php";

$db = Database::getInstance(); 

$query = "SELECT pd.detail_id, pd.order_id, pd.product_id, pd.product_name, pd.product_price, pd.product_quantity, pd.product_img, pd.status, pd.created_at, u.username AS user_name 
          FROM tbl_payment_detail pd
          JOIN tbl_payment p ON pd.order_id = p.id
          JOIN tbl_user u ON p.user_id = u.id
          ORDER BY pd.created_at DESC";

$result = $db->select($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'], $_POST['detail_id'])) {
    $status = mysqli_real_escape_string($db->getConnection(), $_POST['status']);
    $detail_id = (int) $_POST['detail_id'];
    $valid_statuses = ['Chờ Xử Lý', 'Đang chuẩn bị', 'Đang giao', 'Đã giao'];
    if (in_array($status, $valid_statuses)) {
        $check_status_query = "SELECT status FROM tbl_payment_detail WHERE detail_id = ?";
        $stmt = $db->prepare($check_status_query);
        $stmt->bind_param('i', $detail_id);
        $stmt->execute();
        $result_check = $stmt->get_result();
        $current_status = $result_check->fetch_assoc()['status'];

        if ($current_status != 'Đã huỷ' && $current_status != 'Đã giao') {
            $update_query = "UPDATE tbl_payment_detail SET status = ? WHERE detail_id = ?";
            $stmt = $db->prepare($update_query);
            $stmt->bind_param('si', $status, $detail_id);
            $stmt->execute();
        } else {
            echo "Không thể thay đổi trạng thái khi đơn hàng đã giao hoặc đã huỷ.";
        }
    } else {
        echo "Trạng thái không hợp lệ.";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Chi Tiết Đơn Hàng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-content-right">
    <div class="admin-content-right-product_list">
        <h1>Danh sách chi tiết đơn hàng</h1>
        <table border="1" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Người đặt hàng</th>
                    <th>Mã Đơn Hàng</th>
                    <th>Mã Sản Phẩm</th>
                    <th>Hình Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Trạng Thái</th>
                    <th>Ngày Tạo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['detail_id'] . "</td>";
                        echo "<td>" . $row['user_name'] . "</td>";
                        echo "<td>" . $row['order_id'] . "</td>";
                        echo "<td>" . $row['product_id'] . "</td>";
                        echo "<td><img src='/Duan1/view/" . $row['product_img'] . "' alt='Ảnh Sản Phẩm' width='100'></td>";
                        echo "<td>" . $row['product_name'] . "</td>";
                        echo "<td>" . number_format($row['product_price']) . " VND</td>";
                        echo "<td>" . $row['product_quantity'] . "</td>";

                        echo "<td>";
                    if ($row['status'] == 'Đã giao') {
                        echo "<span style='color: green;'>$row[status]</span>";
                    } elseif ($row['status'] == 'Đã huỷ') {
                        echo "<span style='color: red;'>$row[status]</span>";
                    } else {
                        echo "<form method='POST' style='display:inline;'>";
                        echo "<select name='status' onchange='this.form.submit()'>";
                        $statuses = ['Chờ Xử Lý', 'Đang chuẩn bị', 'Đang giao', 'Đã giao'];
                        foreach ($statuses as $status) {
                            $selected = $row['status'] == $status ? "selected" : "";
                            echo "<option value='$status' $selected>$status</option>";
                        }
                        echo "</select>";
                        echo "<input type='hidden' name='detail_id' value='" . $row['detail_id'] . "'>";
                        echo "</form>";
                    }
                    echo "</td>";

                        echo "<td>" . $row['created_at'] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
