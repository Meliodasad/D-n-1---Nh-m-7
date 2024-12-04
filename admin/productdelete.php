<?php
include 'header.html';
include 'slider.html';
include 'class/product_class.php';

$product = new Product();

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Lấy thông tin sản phẩm theo product_id
    $product_info = $product->get_product_by_id($product_id);

    if ($product_info) {
        // Lấy hình ảnh của sản phẩm
        $product_img = $product_info['product_img'];
        $product_img_path = "../view/image/" . $product_img;

        // Xóa sản phẩm khỏi cơ sở dữ liệu
        $delete_product = $product->delete_product($product_id);

        if ($delete_product) {
            // Nếu hình ảnh tồn tại, xóa nó
            if (file_exists($product_img_path)) {
                unlink($product_img_path);
            }

            // Chuyển hướng về trang danh sách sản phẩm
            header('Location: productlist.php');
            exit;
        } else {
            // Nếu xóa không thành công
            echo "<script>alert('Xóa sản phẩm thất bại!');</script>";
        }
    } else {
        // Nếu không tìm thấy sản phẩm
        echo "<script>alert('Sản phẩm không tồn tại!');</script>";
    }
} else {
    // Nếu không có product_id trong URL
    echo "<script>alert('Không có sản phẩm để xóa!');</script>";
}
?>
