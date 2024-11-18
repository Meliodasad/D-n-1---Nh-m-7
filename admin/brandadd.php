<?php
include 'header.php';
include 'slider.php';
include 'class/brandClass.php';
?>

<?php
$brand = new Brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['cartegory_id'];
    $brand_name = $_POST['brand_name'];
    $insert_brand = $brand->insert_brand($category_id,$brand_name);
}

?>

<style>
    select{
    height: 30px;
    width: 200px;
    }
</style>
<div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>Thêm loại sản phẩm</h1>
                <form action="" method="POST">
                    <select name="cartegory_id"id="">
                        <option value="#">Chon danh muc</option>
                    <?php
                $show_category = $brand->show_category();
                if ($show_category) {while ($rusult = $show_category->fetch_assoc()) {
                    
                
                    ?>
                        <option value="<?php echo $rusult['cartegory_id'] ?>"><?php echo $rusult['cartegory_name']?></option>
                        <?php
                        }}
                        ?>
                    </select> <br>
                    <input required name="brand_name" type="text" placeholder="Nhập tên loại sản phẩm ">
                    <button type="sumit">Thêm</button>
                </form>
            </div>

        </div>

    </section>
</body>
</html>