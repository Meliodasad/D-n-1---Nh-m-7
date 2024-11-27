<?php
include 'class/cartegoryClass.php';
$category = new Category();
if (!isset($_GET['category_id']) || $_GET['category_id'] == NULL) {
    echo "<script>window.location = 'cartegorylist.php';</script>";

}
else {
    $category_id = $_GET['category_id'];
}
    $delete_category = $category->delete_category($category_id);

?>
