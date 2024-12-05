<?php
include 'header.html';
include 'slider.html';
include 'class/payment_class.php';

$payment = new Payment();
$order_list = $payment->get_grouped_orders();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="admin-content-right">
        <div class="admin-content-right-order_list">
            <h1>Danh sách đơn hàng</h1>
            <table border="1" cellspacing="0" cellpadding="10">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Người dùng</th>
                        <th>Tổng sản phẩm</th>
                        <th>Tổng giá</th>
                        <th>Ngày tạo</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($order_list) {
                        while ($order = $order_list->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $order['order_id']; ?></td>
                                <td><?php echo $order['user_name']; ?></td>
                                <td><?php echo $order['total_items']; ?></td>
                                <td><?php echo number_format($order['total_price'], 0, ',', '.'); ?> VNĐ</td>
                                <td><?php echo $order['created_at']; ?></td>
                                <td><?php echo $order['status']; ?></td>
                                <td>
                                    <button class="btn-detail" onclick="window.location.href='orderdetail.php?order_id=<?php echo $order['order_id']; ?>'">Chi tiết</button>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='7'>Không có đơn hàng nào</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
