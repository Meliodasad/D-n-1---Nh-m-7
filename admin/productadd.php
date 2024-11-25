<?php
include "header.php";
include "slider.php";
include "class/product_class.php";
?>
<?php
$product = new Product;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // var_dump($_POST,$_FILES);
    // echo '<pre>';
    // echo print_r($_FILES);
    // echo '</pre>';
    $insert_product = $product ->insert_product($_FOST,$_FILES);
}
?>

<div class="admin-content-right">
<div class="admin-content-right-product_add">
    <h1>Thêm sản phẩm</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="">nhập tên sản phẩm <span style="color: red;">*</span></label>
        <input name="product_name" required type="text" >
        <label for="">Chọn danh mục <span style="color: red;">*</span></label>
        <select name="category_id" id="">
            <option value="#">-chọn-</option>
            <?php
            $show_category = $product -> show_category();
            if ($show_category) {while ($result = $show_category -> fetch_assoc()) {

                
            ?>
            <option value="<?php echo $result['category_id'] ?>"><?php echo $result['category_name'] ?></option>
            <?php
            }}
            ?>
        </select>
        <label for="">Chọn loại sản phẩm <span style="color: red;">*</span></label>
        <select name="brand_id" id="">
            <label for="">chọn loại sản phẩm <span style="color: red;">*</span></label>
            <option value="#">-chọn-</option>
            <?php
            $show_brand = $product -> show_brand();
            if ($show_brand) {while ($result = $show_brand -> fetch_assoc()) {

                
            ?>
            <option value="<?php echo $result['brand_id'] ?>"><?php echo $result['brand_name'] ?></option>
            <?php
            }}
            ?>
        </select>
        <label for="">giá sản phẩm <span style="color: red;">*</span></label>
        <input name="product_price" required type="text" >
        <label for="">giá khuyễn mãi <span style="color: red;">*</span></label>
        <input name="product_price_new" required type="text" >
        <label for="">mô tả sản phẩm <span style="color: red;">*</span></label>
        <textarea required name="product_desc" id="" cols="30" rows="10"></textarea>
        <label for="">ảnh sản phẩm <span style="color: red;">*</span></label>
        <input name="product_img" required type="file" >
        <label for="">ảnh mô tả <span style="color: red;">*</span></label>
        <input name="product_img_desc" required multiple type="file" >
        <button type="submit">Thêm</button>
        <!-- required:nhắc nhở không được để trống  -->
    </form>

 </div>

    </section>
</body>
</html>