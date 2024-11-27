<?php

include 'class/brandClass.php';
$brand = new brand();
    $category_id = $_GET['brand_id'];
    $delete_category = $category->delete_brand($brand_id);


?>
