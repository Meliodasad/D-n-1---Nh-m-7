<?php
include 'header.html';
include 'slider.html';
include 'class/product_class.php';

$product = new Product();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id']) && isset($_POST['status'])) {
        $product_id = $_POST['product_id'];
        $new_status = $_POST['status'];
        $update_status = $product->update_product_status($product_id, $new_status);

        if ($update_status) {
            header('Location: productlist.php');
            exit;
        } else {
            echo "Lỗi: Không thể cập nhật trạng thái.";
        }
    }
}
$product_list = $product->get_all_product();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            padding: 10px;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        select {
            height: 40px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
            cursor: pointer;
        }
        .status-green {
            color: green;
        }
        .status-red {
            color: red;
        }
    </style>
    <script>
        function updateStatusColor(selectElement) {
            const selectedValue = selectElement.value;
            if (selectedValue === "Còn hàng") {
                selectElement.className = "status-green";
            } else if (selectedValue === "Hết hàng") {
                selectElement.className = "status-red";
            }
        }
    </script>
</head>
<body>
    <div class="admin-content-right">
        <div class="admin-content-right-product_list">
            <h1>Danh sách sản phẩm</h1>
            <table border="1" cellspacing="0" cellpadding="10">
                <thead>
                    <tr style="color: black;">
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Giá khuyến mãi</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($product_list) {
                        while ($row = $product_list->fetch_assoc()) {
                            $statusClass = $row['status'] === 'Còn hàng' ? 'status-green' : 'status-red';
                            ?>
                            <tr>
                                <td><?php echo $row['product_id']; ?></td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo $row['category_name']; ?></td>
                                <td><?php echo number_format($row['product_price'], 0, ',', '.'); ?> VNĐ</td>
                                <td><?php echo number_format($row['product_price_new'], 0, ',', '.'); ?> VNĐ</td>
                                <td><img src="/DuAn1/view/<?php echo $row['product_img']; ?>" alt="" width="100"></td>
                                <td style="width: 200px; overflow: hidden;"><?php echo $row['product_desc']; ?></td>
                                <td>
                                    <form method="POST" action="">
                                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                        <select 
                                            name="status" 
                                            onchange="this.form.submit(); updateStatusColor(this);" 
                                            class="<?php echo $statusClass; ?>"
                                        >
                                            <option value="Còn hàng" <?php echo ($row['status'] === 'Còn hàng') ? 'selected' : ''; ?>>Còn hàng</option>
                                            <option value="Hết hàng" <?php echo ($row['status'] === 'Hết hàng') ? 'selected' : ''; ?>>Hết hàng</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='8'>Không có sản phẩm nào</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>