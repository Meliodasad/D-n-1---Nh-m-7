<?php
include 'header.php';
include 'class/categoryClass.php';
include 'slider.php';
?>
<?php
$category = new Category();
if (!isset($_GET['category_id']) || $_GET['category_id'] == NULL) {
    echo "<script>window.location = 'cartegorylist.php';</script>";

}
else {
    $category_id = $_GET['category_id'];
}
    $get_category = $category->get_category($category_id);
    if ($get_category) {
        $result = $get_category-> fetch_assoc();
    }
?>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];
    $update_category = $category->update_category($category_name, $category_id);
}
?>

<?php
if ($result) {
    echo "Thêm danh mục thành công!";
} else {
    echo "Lỗi khi thêm danh mục.";
}
?>

<div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>Thêm danh mục</h1>
                <form action="" method="POST">
                    <input name="category_name" type="text" placeholder="Nhập tên danh mục" 
                    value="<?php echo $result['category_name']; ?>">
                    <button type="sumit">Sửa</button>
                </form>
            </div>

        </div>

    </section>
</body>
</html>