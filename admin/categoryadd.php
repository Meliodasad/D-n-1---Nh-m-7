<?php
include 'database.php';
include 'class/categoryClass.php';

$category = new Category();
$result = $category->insert_category('Dao Nhật');

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
                    <input name="category_name" type="text" placeholder="Nhập tên danh mục">
                    <button type="sumit">Thêm</button>
                </form>
            </div>

        </div>

    </section>
</body>
</html>