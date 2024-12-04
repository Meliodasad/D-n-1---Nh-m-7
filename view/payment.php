<?php
include 'config.php';
include 'header.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Vui lòng đăng nhập để thanh toán.'); window.location.href = 'dangnhap.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Lấy các sản phẩm trong giỏ hàng của người dùng
$sql_cart_items = "SELECT c.*, p.product_name, p.product_price, p.product_img 
                   FROM tbl_cart c
                   JOIN tbl_product p ON c.product_id = p.product_id
                   WHERE c.user_id = :user_id";
$stmt_cart_items = $conn->prepare($sql_cart_items);
$stmt_cart_items->execute([':user_id' => $user_id]);
$cart_items = $stmt_cart_items->fetchAll(PDO::FETCH_ASSOC);

if (count($cart_items) > 0) {
    // Xử lý khi người dùng gửi form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $delivery_method = $_POST['delivery_method'] ?? '';
        $payment_method = $_POST['payment_method'] ?? '';
        
        // Tính tổng tiền của tất cả các sản phẩm trong giỏ hàng
        $total_price = 0;
        foreach ($cart_items as $cart) {
            $total_price += $cart['product_price'] * $cart['cart_quantity'];
        }

        // Thêm đơn hàng vào bảng tbl_payment
        $sql_payment = "INSERT INTO tbl_payment (user_id, payment_method, delivery_method, total_price, status, created_at, updated_at) 
                        VALUES (:user_id, :payment_method, :delivery_method, :total_price, 'Chờ Xử Lý', NOW(), NOW())";
        $stmt_payment = $conn->prepare($sql_payment);
        $stmt_payment->execute([
            ':user_id' => $user_id,
            ':payment_method' => $payment_method,
            ':delivery_method' => $delivery_method,
            ':total_price' => $total_price
        ]);

        // Lấy ID đơn hàng vừa tạo
        $order_id = $conn->lastInsertId();

        // Lưu chi tiết đơn hàng vào bảng tbl_payment_detail
        foreach ($cart_items as $cart) {
            $sql_payment_detail = "INSERT INTO tbl_payment_detail 
                                   (order_id, product_id, product_name, product_price, product_quantity, product_img) 
                                   VALUES (:order_id, :product_id, :product_name, :product_price, :product_quantity, :product_img)";
            $stmt_payment_detail = $conn->prepare($sql_payment_detail);
            $stmt_payment_detail->execute([
                ':order_id' => $order_id,
                ':product_id' => $cart['product_id'],
                ':product_name' => $cart['product_name'],
                ':product_price' => $cart['product_price'],
                ':product_quantity' => $cart['cart_quantity'],
                ':product_img' => $cart['product_img']
            ]);

            // Xóa sản phẩm khỏi giỏ hàng
            $sql_delete_cart = "DELETE FROM tbl_cart WHERE cart_id = :cart_id";
            $stmt_delete_cart = $conn->prepare($sql_delete_cart);
            $stmt_delete_cart->execute([':cart_id' => $cart['cart_id']]);
        }

        echo "<script>alert('Đặt hàng thành công!'); window.location.href = 'donhang.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Giỏ hàng của bạn trống!'); window.location.href = 'cart.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="css/mainstyle.css">
</head>
<body>
    <section class="payment">
        <div class="container">
            <form method="POST" action="">
                <div class="payment-content">
                    <div class="payment-content-left">
                        <p style="font-weight: bold; font-size: 20px;">Sản phẩm trong giỏ hàng</p>
                        <div class="payment-table">
                            <table>
                                <?php foreach ($cart_items as $cart): ?>
                                    <tr>
                                        <td><?= $cart['product_name'] ?></td>
                                        <td><?= number_format($cart['product_price'], 0, ',', '.') ?> VND</td>
                                        <td><?= $cart['cart_quantity'] ?></td>
                                        <td><?= number_format($cart['product_price'] * $cart['cart_quantity'], 0, ',', '.') ?> VND</td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>

                        <p style="font-weight: bold; font-size: 20px;">Phương thức giao hàng</p>
                        <div class="payment-table">
                            <table>
                                <tr>
                                    <td><input type="radio" name="delivery_method" value="Chuyển phát nhanh" id="delivery-method-1" required></td>
                                    <td><label for="delivery-method-1">Giao hàng chuyển phát nhanh</label></td>
                                </tr>
                            </table>
                        </div>

                        <p style="font-weight: bold; font-size: 20px;">Phương thức thanh toán</p>
                        <div class="payment-table">
                            <table>
                                <tr>
                                    <td><input type="radio" name="payment_method" value="Thẻ tín dụng" id="payment-method-1" required></td>
                                    <td><label for="payment-method-1">Thanh toán qua thẻ tín dụng (OnePay)</label></td>
                                    <td><img src="image/visa.png" alt="Visa" width="150" height="80"></td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="payment_method" value="ATM" id="payment-method-2"></td>
                                    <td><label for="payment-method-2">Thanh toán qua thẻ ATM (OnePay)</label></td>
                                    <td><img src="image/bank.png" alt="ATM" width="150" height="80"></td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="payment_method" value="Momo" id="payment-method-3"></td>
                                    <td><label for="payment-method-3">Thanh toán qua Momo (OnePay)</label></td>
                                    <td><img src="image/momo.png" alt="Momo" width="50" height="50"></td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="payment_method" value="Thanh toán khi nhận hàng" id="payment-method-4"></td>
                                    <td colspan="2"><label for="payment-method-4">Thanh toán khi nhận hàng</label></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="payment-content-right-payment">
                        <button type="submit">ĐẶT HÀNG</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>
