<?php
include 'header.html';
include 'slider.html';
include 'class/product_class.php';

$product = new Product();
$product_list = $product->get_all_product();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="admin-content-right">
        <div class="admin-content-right-product_list">
            <h1>Danh sách sản phẩm</h1>
            <table border="1" cellspacing="0" cellpadding="10">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Giá khuyến mãi</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($product_list) {
                        while ($row = $product_list->fetch_assoc()) {
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
                                    <button class="btn-edit" onclick="window.location.href='productedit.php?product_id=<?php echo $row['product_id']; ?>'">Sửa</button> | 
                                    <button class="btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa?') ? window.location.href='productdelete.php?product_id=<?php echo $row['product_id']; ?>' : false;">Xóa</button>
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
