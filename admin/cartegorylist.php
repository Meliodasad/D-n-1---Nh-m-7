<?php
include 'database.php';
include 'class/categoryClass.php';
include 'slider.php';
$category = new Category();
$result = $category->insert_category('Dao Nhật');

$show_category = $category->show_category();
if ($result) {
    echo "Thêm danh mục thành công!";
} else {
    echo "Lỗi khi thêm danh mục.";
}
?>

<div class="admin-content-right">
<div class="admin-content-right-category-list">
                <h1>Danh Sách Danh Mục</h1> 
                <table>
                    <tr>
                        <th>STT</th>     
                        <th>ID</th> 
                        <th>Danh Muc</th>
                        <th>Tùy Biến</th>   
                    </tr>
                    <?php
                    if ($show_category) {
                        $i = 0;
                        while ($result = $show_category->fetch_assoc()) {$i++;
                    }
                    }
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['category_id']; ?></td>
                        <td><?php echo $result['category_name']; ?></td>
                       <td><a href="cartegoryedit.php?category_id=<?php echo $result['category_id']; ?>">Sửa</a>|<a href="cartegorydelete.php?category_id=<?php echo $result['category_id']; ?>">Xóa</a></td>
                    </tr>
                    <?php
                    ?>
            </div>

        </div>

    </section>
</body>
</html>