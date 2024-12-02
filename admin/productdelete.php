<?php
include 'header.html';
include 'slider.html';
include 'class/product_class.php';

$product = new Product();

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];


    $product_info = $product->get_product_by_id($product_id);

    if ($product_info) {

        $product_img = $product_info['product_img'];
        $product_img_path = "../view/image/" . $product_img;

        
        $delete_product = $product->delete_product($product_id);

        if ($delete_product) {
            
            if (file_exists($product_img_path)) {
                unlink($product_img_path);
            }

            
            header('Location: productlist.php');
            exit;
        } else {
            echo "<script>alert('Xóa sản phẩm thất bại!');</script>";
        }
    } else {
        echo "<script>alert('Sản phẩm không tồn tại!');</script>";
    }
} else {
    echo "<script>alert('Không có sản phẩm để xóa!');</script>";
}
?>
