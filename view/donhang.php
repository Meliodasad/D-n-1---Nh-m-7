<?php
include 'config.php';
include 'header.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Vui lòng đăng nhập để xem đơn hàng.'); window.location.href = 'dangnhap.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

$sql_details = "SELECT * FROM tbl_payment_detail WHERE order_id IN (SELECT id FROM tbl_payment WHERE user_id = :user_id)";
$stmt_details = $conn->prepare($sql_details);
$stmt_details->execute([':user_id' => $user_id]);
$details = $stmt_details->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['cancel_detail_id'])) {
    $cancel_detail_id = $_POST['cancel_detail_id'];
    
    $sql_check_status = "SELECT status FROM tbl_payment_detail WHERE detail_id = :detail_id";
    $stmt_check_status = $conn->prepare($sql_check_status);
    $stmt_check_status->execute([':detail_id' => $cancel_detail_id]);
    $status = $stmt_check_status->fetchColumn();
    
    if ($status != 'Đã giao' && $status != 'Đã huỷ') {
        $sql_cancel = "UPDATE tbl_payment_detail SET status = 'Đã huỷ' WHERE detail_id = :detail_id";
        $stmt_cancel = $conn->prepare($sql_cancel);
        $stmt_cancel->execute([':detail_id' => $cancel_detail_id]);
    }

    header("Location: donhang.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <link rel="stylesheet" href="css/mainstyle.css">
    <style>
        table {
            margin: 100px 10px;
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #3a3a3a;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        .order-details {
            margin: 20px 0;
            padding: 10px;
            border: 1px solid #ccc;
        }
        button.cancel-btn {
            background-color: #e74c3c; 
            color: white; 
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button.cancel-btn:hover {
            background-color: #c0392b;
        }

        button.cancel-btn:active {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>
<h2>Chi Tiết Đơn Hàng Của Bạn</h2>
<?php if (count($details) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Ảnh Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Giá</th>
                <th>Số Lượng</th>
                <th>Trạng Thái</th>
                <th>Ngày Đặt Hàng</th>
                <th>Trạng Thái Sản Phẩm</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($details as $detail): ?>
                <tr>
                    <td><img src="<?= $detail['product_img'] ?>" alt="<?= htmlspecialchars($detail['product_name'] ?? '') ?>" width="100" height="100"></td>
                    <td><?= htmlspecialchars($detail['product_name'] ?? '') ?></td>
                    <td><?= number_format($detail['product_price']) ?> VND</td>
                    <td><?= htmlspecialchars($detail['product_quantity'] ?? '') ?></td>
                    <td><?= htmlspecialchars($detail['status'] ?? '') ?></td>
                    <td><?= htmlspecialchars($detail['created_at'] ?? '') ?></td>
                    <td>
                        <?php if ($detail['status'] != 'Đã huỷ' && $detail['status'] != 'Đã giao' && $detail['status'] != 'Đang giao'): ?>
                            <form action="donhang.php" method="post" style="display:inline;">
                                <input type="hidden" name="cancel_detail_id" value="<?= $detail['detail_id'] ?>">
                                <button type="submit" class="cancel-btn" onclick="return confirm('Bạn có chắc chắn muốn huỷ sản phẩm này?');">Huỷ Sản Phẩm</button>
                            </form>
                        <?php elseif ($detail['status'] == 'Đã giao' ): ?>
                            <span style="color: green;">Đơn Hàng Đã Hoàn Thành</span>
                        <?php elseif ($detail['status'] == 'Đang giao' ): ?>
                            <span style="color: #3a3a3a;">Đơn Hàng Đang Được Giao Tới Bạn</span>
                        <?php else: ?>
                            <span style="color: red;">Đã Huỷ</span>
                        <?php endif ; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Chưa có đơn hàng nào.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>
</body>
</html>
