<?php
include 'class/cartegoryClass.php';
$cartegory = new Cartegory();
    $category_id = $_GET['cartegory_id'];
    $delete_category = $category->delete_cartegory($cartegory_id);

?>
