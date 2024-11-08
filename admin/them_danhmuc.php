<?php
include "views/admin/layout/header.php";
?>

<main class="">
    <hr>
    <h1>Thêm danh mục</h1>
    <hr>
    <form action="" method="post">
        <div class="form-group">
            <label for="name">Tên danh mục :</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <hr>
        <button style="margin-bottom: 15px; width: 100px; height: 40px; border-radius: 5px; border: none;" class="btn-primary" type="submit">
            Thêm
        </button>
    </form>
</main>

<?php
include "views/admin/layout/footer.php";
?>