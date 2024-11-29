<?php 
include_once 'database.php';  
include '/laragon/www/DuAn1/admin/class/cartegory_Class.php';
include "header.html";  
include 'slider.html';

$category = new Category();
$show_category = $category->show_category();
?>


    <div class="admin-content-right">
        <div class="admin-content-right-category-list">
            <h1>Danh Sách Danh Mục</h1>
            <table border="1">
                <tr>
                    <th>STT</th>     
                    <th>ID</th> 
                    <th>Danh Mục</th>
                    <th>Tùy Biến</th>   
                </tr>
                <?php
                if ($show_category) {
                    $i = 0;
                    while ($result = $show_category->fetch_assoc()) {
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['category_id']; ?></td>
                            <td><?php echo $result['category_name']; ?></td>
                            <td>
                                <a href="admin/cartegoryedit.php?category_id=<?php echo $result['category_id']; ?>">Sửa</a> |
                                <a href="categorydelete.php?category_id=<?php echo $result['category_id']; ?>">Xóa</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='4'>Không có danh mục nào.</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>  
</div>
