<?php
include "views/admin/layout/header.php";
?>

<main class="">
    <hr>
    <h1>Thống kê</h1>
    <hr>
    
    <table border="1" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên danh mục</th>
                <th>Số lượng</th>
                <th>Giá cao nhất</th>
                <th>Giá thấp nhất</th>
                <th>Giá trung bình</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($thongke as $key => $value) :
            ?>
                <tr>
                    <td><?= $key+1 ?></td>
                    <td><?= $value['name'] ?></td>
                    <td><?= $value['dem'] ?></td>
                    <td><?= $value['max'] ?></td>
                    <td><?= $value['min'] ?></td>
                    <td><?= $value['tb'] ?></td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
    <span class="btn-them"><a class="btn btn-primary" href="?action=bieudo">Xem biểu đồ</a></span>
</main>

<?php
include "views/admin/layout/footer.php";
?>