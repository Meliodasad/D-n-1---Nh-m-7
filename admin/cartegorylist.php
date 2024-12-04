<?php 
include_once 'database.php';  
include '/laragon/www/DuAn1/admin/class/cartegory_Class.php';
include "header.html";  
include 'slider.html';

$category = new Category();
$show_category = $category->show_category();
?>
 <style>.admin-content-right {
     width: 100%;
    max-width: 2000px;
    margin: 0 50px;
    padding: 20px;
    background-color: #454545;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.admin-content-right-category-list {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
}

.admin-content-right-category-list h1 {
    text-align: center;
    font-size: 24px;
    color: #fff;
    margin-bottom: 20px;
}

.admin-content-right-category-list table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.admin-content-right-category-list table th,
.admin-content-right-category-list table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    font-size: 16px;
    color: #454545;
}

.admin-content-right-category-list table th {
    background-color: #454545;
    color: white;
    text-transform: uppercase;
}

.admin-content-right-category-list table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.admin-content-right-category-list table tr:hover {
    background-color: #ddd;
}

.admin-content-right-category-list table td a {
    color: #454545;
    text-decoration: none;
    font-weight: bold;
}

.admin-content-right-category-list table td a:hover {
    text-decoration: underline;
}
</style>

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
                                <a href="cartegoryedit.php?category_id=<?php echo $result['category_id']; ?>">Sửa</a> |
                                <a href="cartegorydelete.php?category_id=<?php echo $result['category_id']; ?>">Xóa</a>
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
