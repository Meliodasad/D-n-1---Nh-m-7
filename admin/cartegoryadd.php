<?php
include "header.html";
include "slider.html";
include '/laragon/www/DuAn1/admin/class/cartegory_Class.php';

$category = new Category;

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $category_name = $_POST['category_name'];
    $insert_category = $category -> insert_category($category_name);
}
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Thêm danh mục</h1>
                <form action="" method="POST">
                    <input name="cartegory_name" type="text" placeholder="Nhập tên danh mục">
                    <button type="sumit">Thêm</button>
                </form>
            </div>

        </div>

    </section>
</body>
</html>