<?php
require 'config.php'; // Kết nối DB

// Kiểm tra yêu cầu POST từ AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu JSON từ yêu cầu
    $data = json_decode(file_get_contents('php://input'), true);
    $product_id = $data['product_id'] ?? null;

    if ($product_id) {
        // Lấy thông tin sản phẩm từ DB
        $sql_product = "SELECT * FROM tbl_product WHERE product_id = :product_id";
        $stmt_product = $conn->prepare($sql_product);
        $stmt_product->execute(['product_id' => $product_id]);

        if ($stmt_product->rowCount() > 0) {
            $product = $stmt_product->fetch(PDO::FETCH_ASSOC);

            // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
            $sql_cart = "SELECT * FROM tbl_cart WHERE cart_name = :cart_name";
            $stmt_cart = $conn->prepare($sql_cart);
            $stmt_cart->execute(['cart_name' => $product['product_name']]);

            if ($stmt_cart->rowCount() > 0) {
                // Nếu đã có thì tăng số lượng
                $sql_update = "UPDATE tbl_cart SET cart_quantity = cart_quantity + 1 WHERE cart_name = :cart_name";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->execute(['cart_name' => $product['product_name']]);
            } else {
                // Nếu chưa có thì thêm mới
                $sql_insert = "INSERT INTO tbl_cart (cart_img, cart_name, cart_quantity, cart_price) 
                               VALUES (:cart_img, :cart_name, 1, :cart_price)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->execute([
                    'cart_img' => $product['product_img'],
                    'cart_name' => $product['product_name'],
                    'cart_price' => $product['product_price']
                ]);
            }

            // Trả về phản hồi thành công
            echo json_encode(['success' => true]);
            exit;
        } else {
            // Trả về lỗi nếu sản phẩm không tồn tại
            echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại!']);
            exit;
        }
    } else {
        // Trả về lỗi nếu thiếu product_id
        echo json_encode(['success' => false, 'message' => 'ID sản phẩm không hợp lệ!']);
        exit;
    }
} else {
    // Trả về lỗi nếu phương thức không phải POST
    echo json_encode(['success' => false, 'message' => 'Phương thức không hợp lệ!']);
    exit;
}
?>
