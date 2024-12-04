<?php
include 'header.html';
include 'slider.html';
include_once "database.php";

$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

$db = Database::getInstance(); 

$query = "SELECT pd.order_id, pd.product_id, pd.product_price , pd.product_img, pd.status, pd.created_at, 
                 p.payment_method, p.delivery_method, u.username AS user_name 
          FROM tbl_payment_detail pd
          JOIN tbl_payment p ON pd.order_id = p.id
          JOIN tbl_user u ON p.user_id = u.id
          WHERE MONTH(pd.created_at) = '$month' 
          AND YEAR(pd.created_at) = '$year'
          AND (pd.status = 'Đã giao' OR pd.status = 'Đã huỷ')
          ORDER BY pd.created_at DESC"; 

$result = $db->select($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Đơn Hàng</title>
    <link rel="stylesheet" href="style.css">
    <style>
        form {
            display: flex;
            justify-content: space-between; 
            align-items: center;
            gap: 20px; 
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        form label {
            font-weight: bold; 
            font-size: 14px; 
            color: #333;
        }

        form select, form button {
            padding: 8px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            background-color: #4CAF50;
            color: white;  
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }

        select {
            width: 150px;
        }

        button {
            width: 120px;
        }
    </style>
</head>
<body>
<div class="admin-content-right">
    <div class="admin-content-right-product_list">
        <h1>Danh sách đơn hàng</h1>
        <form method="get" action="paymentfinish.php">
            <label for="month">Chọn tháng:</label>
            <select name="month" id="month">
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    $value = str_pad($i, 2, '0', STR_PAD_LEFT);
                    $selected = ($month == $value) ? 'selected' : '';
                    echo "<option value='$value' $selected>Tháng $i</option>";
                }
                ?>
            </select>

            <label for="year">Chọn năm:</label>
            <select name="year" id="year">
                <?php
                for ($i = 2021; $i <= date('Y'); $i++) {
                    $selected = ($year == $i) ? 'selected' : '';
                    echo "<option value='$i' $selected>$i</option>";
                }
                ?>
            </select>

            <button type="submit">Lọc</button>
        </form>
        <table border="1" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>Mã Đơn Hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Ảnh Sản Phẩm</th>
                    <th>Giá Sản Phẩm</th>
                    <th>Hình Thức Thanh Toán</th>
                    <th>Hình Thức Giao Hàng</th>
                    <th>Trạng Thái</th>
                    <th>Ngày Tạo Đơn</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['order_id'] . "</td>";
                        echo "<td>" . $row['user_name'] . "</td>";
                        echo "<td><img src='/Duan1/view/" . $row['product_img'] . "' alt='Ảnh Sản Phẩm' width='100'></td>";
                        echo "<td>" . number_format($row['product_price']) . " VND</td>";
                        echo "<td>" . $row['payment_method'] . "</td>";
                        echo "<td>" . $row['delivery_method'] . "</td>";

                        if ($row['status'] == 'Đã huỷ') {
                            echo "<td><span style='color: red;'>Đã huỷ</span></td>";
                        } else {
                            echo "<td><span style='color: green;'>Đã giao</span></td>";
                        }
                        
                        echo "<td>" . $row['created_at'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Không có đơn hàng trong tháng $month/$year</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
