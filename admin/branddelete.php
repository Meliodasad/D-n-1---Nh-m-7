<?php
include 'class/cartegoryClass.php';
$cartegory = new Category();
    $category_id = $_GET['cartegory_id'];
    $delete_category = $category->delete_cartegory($cartegory_id);

?>
