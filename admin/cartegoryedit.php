<?php
include_once 'database.php';  
include 'admin/class/cartegory_Class.php';  
include "header.html";  
include 'slider.html';

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $category = new Category();
    $category_data = $category->get_category($category_id);

    if (!$category_data) {
        echo "<script>alert('Danh mục không tồn tại!'); window.location.href = 'cartegorylist.php';</script>";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $category_name = $_POST['category_name'];

        if ($category->update_category($category_name, $category_id)) {
            echo "<script>alert('Cập nhật danh mục thành công!'); window.location.href = 'cartegorylist.php';</script>";
        } else {
            echo "<script>alert('Lỗi khi cập nhật danh mục!');</script>";
        }
    }
} else {
    echo "Danh mục không tồn tại.";
    exit();
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-category-edit">
        <h1>Sửa Danh Mục</h1>
        <form action="" method="POST">
            <label for="category_name">Tên Danh Mục</label>
            <input type="text" name="category_name" value="<?php echo $category_data['category_name']; ?>" required>
            <button type="submit">Cập Nhật</button>
        </form>
    </div>
</div>
</section>
</body>
</html>
