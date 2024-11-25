<?php
include "header.html";
include "slider.html";
include "/laragon/www/DuAn1/admin/class/cartegoryClass.php";
?>

<?php
$category = new Category;
if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $category_name = $_POST['category_name'];
    $insert_category = $category -> insert_category($category_name);
}
?>
    
        <div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>Thêm danh mục</h1>
                <form action="" method="POST">
                    <input name="category_name" type="text" placeholder="Nhập tên danh mục" required>
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>


</body>
</html>