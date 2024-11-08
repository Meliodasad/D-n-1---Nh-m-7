<?php
include "views/admin/layout/header.php";
?>

<main class="">
    <hr>
    <h1>Thêm sản phẩm</h1>
    <hr>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tên sản phẩm :</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>Ảnh :</label>
            <input type="file" class="form-control" name="img">
        </div>
        <div class="form-group">
            <label>Mô tả :</label>
            <input type="text" class="form-control" name="mota">
        </div>
        <div class="form-group">
            <label>Danh mục :</label>
            <select name="id_category" id="">
                <option value="" hidden>----------</option>
                <?php
                foreach ($listDM as $value) :
                ?>
                    <option value="<?= $value['id']?>"><?= $value['name']?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Giá tiền :</label>
            <input type="text" class="form-control" name="price">
        </div>
        <div class="form-group">
            <label>Lượt xem :</label>
            <input type="text" class="form-control" name="view">
        </div>
        <hr>
        <button style="margin-bottom: 15px; width: 100px; height: 40px; border-radius: 5px; border: none;" class="btn-primary" type="submit">Thêm</button>
    </form>
</main>

<?php
include "views/admin/layout/footer.php";
?>