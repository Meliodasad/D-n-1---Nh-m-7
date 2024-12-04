<?php
require 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!']);
    exit;
}
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $product_id = $data['product_id'] ?? null;

    if ($product_id) {
        $sql_product = "SELECT * FROM tbl_product WHERE product_id = :product_id";
        $stmt_product = $conn->prepare($sql_product);
        $stmt_product->execute(['product_id' => $product_id]);

        if ($stmt_product->rowCount() > 0) {
            $product = $stmt_product->fetch(PDO::FETCH_ASSOC);

            $sql_cart = "SELECT * FROM tbl_cart WHERE product_id = :product_id AND user_id = :user_id";
            $stmt_cart = $conn->prepare($sql_cart);
            $stmt_cart->execute(['product_id' => $product['product_id'], 'user_id' => $user_id]);

            if ($stmt_cart->rowCount() > 0) {
                $sql_update = "UPDATE tbl_cart SET cart_quantity = cart_quantity + 1 WHERE product_id = :product_id AND user_id = :user_id";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->execute([
                    'product_id' => $product['product_id'],
                    'user_id' => $user_id
                ]);
            } else {
                $sql_insert = "INSERT INTO tbl_cart (user_id, product_id, cart_img, cart_name, cart_quantity, cart_price) 
                               VALUES (:user_id, :product_id, :cart_img, :cart_name, 1, :cart_price)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->execute([
                    'user_id' => $user_id,
                    'product_id' => $product['product_id'],
                    'cart_img' => $product['product_img'],
                    'cart_name' => $product['product_name'],
                    'cart_price' => $product['product_price']
                ]);
            }
            echo json_encode(['success' => true]);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại!']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID sản phẩm không hợp lệ!']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Phương thức không hợp lệ!']);
    exit;
}
?>
