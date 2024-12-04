<?php
include 'header.html';
include 'slider.html';
include 'class/product_class.php';

$product = new Product;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $product_price = $_POST['product_price'];
    $product_price_new = $_POST['product_price_new'];
    $product_desc = $_POST['product_desc'];

    $product_img = $_FILES['product_img']['name'];
    $product_img_tmp = $_FILES['product_img']['tmp_name'];
    $upload_dir = "../view/image/";  
    move_uploaded_file($product_img_tmp, $upload_dir . $product_img);

    $insert_product = $product->insert_product(
        $product_name,
        $category_id,
        $product_price,
        $product_price_new,
        $product_desc,
        $product_img
    );

    if ($insert_product) {
        echo "<script>alert('Thêm sản phẩm thành công!');</script>";
        echo "<script>window.location.href = 'productlist.php';</script>";
        exit();
    } else {
        echo "<script>alert('Thêm sản phẩm thất bại!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-content-right">
    <div class="admin-content-right-product_add">
        <h1>Thêm sản phẩm</h1>
        <form action="" method="POST" enctype="multipart/form-data">
    <label for="">Tên sản phẩm <span style="color: red;">*</span></label>
    <input name="product_name" required type="text">
    
    <label for="">Danh mục <span style="color: red;">*</span></label>
    <select name="category_id">
        <option value="#">-Chọn-</option>
        <?php
        $show_category = $product->show_category();
        if ($show_category) {
            while ($result = $show_category->fetch_assoc()) {
                echo "<option value='{$result['category_id']}'>{$result['category_name']}</option>";
            }
        }
        ?>
    </select>

    <label for="">Giá sản phẩm <span style="color: red;">*</span></label>
    <input name="product_price" required type="text">
    
    <label for="">Giá khuyến mãi <span style="color: red;">*</span></label>
    <input name="product_price_new" required type="text">
    
    <label for="">Mô tả sản phẩm <span style="color: red;">*</span></label>
    <textarea name="product_desc" required></textarea>
    
    <label for="">Ảnh sản phẩm <span style="color: red;">*</span></label>
    <input name="product_img" required type="file">
    
    <button type="submit">Thêm</button>
</form>
    </div>
</div>
</body>
</html>
