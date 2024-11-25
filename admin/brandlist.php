<?php
include 'header.php';
include 'slider.php';
include 'class/brandClass.php';


$brand = new brand();
$show_brand = $brand ->show_brand();

if ($result) {
    echo "Thêm danh mục thành công!";
} else {
    echo "Lỗi khi thêm danh mục.";
}
?>

<div class="admin-content-right">
<div class="admin-content-right-cartegory-list">
                <h1>Danh Sách Loại San Pham</h1> 
                <table>
                    <tr>
                        <th>STT</th>     
                        <th>ID</th> 
                        <th>Danh Muc</th>
                        <th>Loại San Pham</th>
                        <th>Tùy Biến</th>   
                    </tr>
                    <?php
                    if ($show_category) {
                        $i = 0;
                        while ($result = $show_brand->fetch_assoc()) {$i++;
                    }
                    }
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['brand_id']; ?></td>
                        <td><?php echo $result['category_name']; ?></td>
                        <td><?php echo $result['brand_name']; ?></td>
                       <td><a href="brandedit.php?brand_id=<?php echo $result['brand_id']; ?>">Sửa</a>|<a href="branddelete.php?brand_id=<?php echo $result['brand_id']; ?>">Xóa</a></td>
                    </tr>
                    <?php
                    ?>
            </div>

        </div>

    </section>
</body>
</html>