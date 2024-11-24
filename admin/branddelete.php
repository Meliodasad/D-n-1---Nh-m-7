<?php
include 'class/brandClass.php';
$brand = new brand();
    $cartegory_id = $_GET['brand_id'];
    $delete_cartegory = $cartegory->delete_brand($brand_id);

?>
