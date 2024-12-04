<?php
include 'header.html';
include 'slider.html';
include_once "database.php";

$db = Database::getInstance();

$query = "
    SELECT
        YEAR(created_at) AS year,
        MONTH(created_at) AS month,
        COUNT(DISTINCT user_id) AS num_customers
    FROM tbl_payment
    GROUP BY YEAR(created_at), MONTH(created_at)
    ORDER BY YEAR(created_at) DESC, MONTH(created_at) DESC
";
$result = $db->select($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống Kê Số Lượng Khách Hàng Mua Hàng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="admin-content-right">
        <div class="admin-content-right-product_list">
            <h1>Thống Kê Số Lượng Khách Hàng Mua Hàng</h1>
            <table border="1" cellspacing="0" cellpadding="10">
                <thead>
                    <tr>
                        <th>Năm</th>
                        <th>Tháng</th>
                        <th>Số Lượng Khách Hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['year'] . "</td>";
                            echo "<td>" . $row['month'] . "</td>";
                            echo "<td>" . $row['num_customers'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Không có dữ liệu thống kê</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
