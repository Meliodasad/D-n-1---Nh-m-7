<?php
include "views/admin/layout/header.php";
?>
<main class="row">
    <hr>
    <h1>Danh mục</h1>
    <hr>
    <span class=""><a class="" href="?action=them_danhmuc">Thêm</a></span>
    <table border="1" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên danh mục</th>
                <th>Công cụ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($listDM as $key => $dm) :
            ?>
                <tr>
                    <td><?= $key+1 ?></td>
                    <td><?= $dm['name'] ?></td>
                    <td>
                        <a class="btn btn-primary" href="?action=sua_danhmuc&id=<?= $dm['id'] ?>">Sửa</a>
                        <a onclick="return confirm('Bạn có muốn xóa không?')" class="btn btn-primary" href="?action=xoa_danhmuc&id=<?= $dm['id'] ?>">Xóa</a>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</main>

<?php
include "views/admin/layout/footer.php";
?>