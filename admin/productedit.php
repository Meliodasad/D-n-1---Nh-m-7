<?php
include 'header.html';
include 'slider.html';
include 'class/product_class.php';

$product = new Product();

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $product_data = $product->get_product_by_id($product_id); // Lấy dữ liệu sản phẩm theo ID
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $update_product = $product->update_product($product_id, $_POST, $_FILES);
    if ($update_product) {
        echo "<script>alert('Cập nhật sản phẩm thành công!');</script>";
        echo "<script>window.location.href = 'productlist.php';</script>";
    } else {
        echo "<script>alert('Cập nhật thất bại!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-content-right">
    <div class="admin-content-right-product_add">
        <h1>Sửa sản phẩm</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <?php if ($product_data) { 
                $row = $product_data->fetch_assoc(); ?>
                <label for="">Tên sản phẩm</label>
                <input name="product_name" required type="text" value="<?php echo $row['product_name']; ?>">

                <label for="">Chọn danh mục</label>
                <select name="category_id">
                    <option value="#">- Chọn -</option>
                    <?php
                    $categories = $product->show_category();
                    if ($categories) {
                        while ($cat = $categories->fetch_assoc()) {
                            $selected = $cat['category_id'] == $row['category_id'] ? 'selected' : '';
                            echo "<option value='{$cat['category_id']}' $selected>{$cat['category_name']}</option>";
                        }
                    }
                    ?>
                </select>

                <label for="">Giá sản phẩm</label>
                <input name="product_price" required type="text" value="<?php echo $row['product_price']; ?>">

                <label for="">Giá khuyến mãi</label>
                <input name="product_price_new" required type="text" value="<?php echo $row['product_price_new']; ?>">

                <label for="">Mô tả sản phẩm</label>
                <textarea name="product_desc" required><?php echo $row['product_desc']; ?></textarea>

                <label for="">Hình ảnh hiện tại</label>
                <img src="uploads/<?php echo $row['product_img']; ?>" alt="" width="80">
                <input name="product_img" type="file">

                <button type="submit">Cập nhật</button>
            <?php } ?>
        </form>
    </div>
</div>
</body>
</html>
