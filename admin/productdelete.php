<?php
include 'header.html';
include 'slider.html';
include 'class/product_class.php';

$product = new Product();

// Kiểm tra nếu có product_id trong URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Lấy thông tin sản phẩm trước khi xóa để có thể xóa ảnh
    $product_info = $product->get_product_by_id($product_id);

    // Kiểm tra nếu sản phẩm tồn tại
    if ($product_info) {
        // Lấy tên ảnh sản phẩm
        $product_img = $product_info['product_img'];
        $product_img_path = "../view/image/" . $product_img;

        // Xóa sản phẩm khỏi cơ sở dữ liệu
        $delete_product = $product->delete_product($product_id);

        if ($delete_product) {
            // Nếu có ảnh, xóa ảnh trong thư mục
            if (file_exists($product_img_path)) {
                unlink($product_img_path);
            }

            // Chuyển hướng về trang danh sách sản phẩm
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
