<?php
include "views/admin/layout/header.php";
?>

<main class="row">
    <hr>
    <h1>Sản phẩm</h1>
    <hr>
    <span class=""><a class="" href="?action=them_sanpham">Thêm</a></span>
    <table border="1" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Danh mục</th>
                <th>Giá tiền</th>
                <th>Lượt xem</th>
                <th>Công cụ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($listSP as $key => $sp) :
            ?>
                <tr>
                    <td><?= $key+1 ?></td>
                    <td><img width="100px" src="public/image/<?= $sp['img'] ?>" alt=""></td>
                    <td><?= $sp['name'] ?></td>
                    <td><?= $sp['desc_ribe'] ?></td>
                    <td><?= $sp['nameDM'] ?></td>
                    <td><?= $sp['price'] ?></td>
                    <td><?= $sp['view'] ?></td>
                    <td>
                        <a class="btn btn-primary" href="?action=sua_sanpham&id=<?= $sp['id'] ?>">Sửa</a>
                        <a onclick="return confirm('Bạn có muốn xóa không?')" class="btn btn-primary" href="?action=xoa_sanpham&id=<?= $sp['id'] ?>">Xóa</a>
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