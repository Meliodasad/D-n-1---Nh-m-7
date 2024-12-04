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

    if (!is_numeric($product_price) || !is_numeric($product_price_new)) {
        echo "<script>alert('Giá và giá khuyến mãi phải là số!');</script>";
    } elseif ($product_price_new >= $product_price) {
        echo "<script>alert('Giá ưu đãi phải nhỏ hơn giá gốc!');</script>";
    } elseif (empty($category_id)) {
        echo "<script>alert('Vui lòng chọn danh mục!');</script>";
    } else {
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/DuAn1/view/";
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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="style.css">
    <script>

        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector("form");
            const price = document.querySelector("input[name='product_price']");
            const priceNew = document.querySelector("input[name='product_price_new']");
            const errorMessage = document.createElement("span");

            errorMessage.style.color = "red";
            errorMessage.style.display = "none";
            priceNew.insertAdjacentElement("afterend", errorMessage);

            form.addEventListener("submit", function (event) {
                const priceValue = parseFloat(price.value);
                const priceNewValue = parseFloat(priceNew.value);

                if (isNaN(priceValue) || isNaN(priceNewValue)) {
                    event.preventDefault();
                    errorMessage.textContent = "Giá và giá khuyến mãi phải là số.";
                    errorMessage.style.display = "block";
                    return;
                }
                if (priceNewValue >= priceValue) {
                    event.preventDefault();
                    errorMessage.textContent = "Giá ưu đãi phải nhỏ hơn giá gốc.";
                    errorMessage.style.display = "block";
                } else {
                    errorMessage.style.display = "none";
                }
            });
        });
    </script>
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
                <option value="">-Chọn-</option>
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
