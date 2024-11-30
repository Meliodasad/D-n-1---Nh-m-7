<?php
include 'config.php';
include 'header.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header('Location: dangnhap.html');
    exit();
}

// Lấy thông tin người dùng và giỏ hàng
$user_id = $_SESSION['user_id'];
$query_cart = "SELECT * FROM tbl_cart WHERE user_id = :user_id";
$stmt_cart = $conn->prepare($query_cart);
$stmt_cart->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt_cart->execute();
$cart_items = $stmt_cart->fetchAll(PDO::FETCH_ASSOC);

// Xử lý thanh toán
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payment_method = $_POST['payment_method'] ?? '';
    $delivery_method = $_POST['delivery_method'] ?? '';
    $selected_carts = $_POST['selected_cart'] ?? [];

    if ($payment_method && $delivery_method && !empty($selected_carts)) {
        try {
            $conn->beginTransaction();

            foreach ($selected_carts as $cart_id) {
                $query_payment = "INSERT INTO tbl_payment (user_id, cart_id, payment_method, delivery_method, status) 
                                  VALUES (:user_id, :cart_id, :payment_method, :delivery_method, 'Chờ xử lý')";
                $stmt_payment = $conn->prepare($query_payment);
                $stmt_payment->execute([
                    ':user_id' => $user_id,
                    ':cart_id' => $cart_id,
                    ':payment_method' => $payment_method,
                    ':delivery_method' => $delivery_method
                ]);

                // Xóa sản phẩm khỏi giỏ hàng
                $query_delete_cart = "DELETE FROM tbl_cart WHERE cart_id = :cart_id AND user_id = :user_id";
                $stmt_delete_cart = $conn->prepare($query_delete_cart);
                $stmt_delete_cart->execute([':cart_id' => $cart_id, ':user_id' => $user_id]);
            }

            $conn->commit();
            echo "<script>alert('Thanh toán thành công!'); window.location.href = 'success.php';</script>";
        } catch (Exception $e) {
            $conn->rollBack();
            echo "<script>alert('Lỗi khi thanh toán: " . $e->getMessage() . "');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng chọn sản phẩm và phương thức thanh toán, giao hàng!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/mainstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <section class="payment">
    <div class="container">
                <div class="payment-top-wrap">
                    <div class="payment-top">
                        <div class="payment-top-payment payment-top-item">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="payment-top-payment payment-top-item">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        <form method="POST" action="">
            <div class="container">
                <div class="payment-content row">
                    <div class="payment-content-left">
                        <p style="font-weight: bold; font-size: 20px;">Phương thức giao hàng</p>
                        <div class="payment-table">
                            <table>
                                <tr>
                                    <td><input type="radio" name="delivery_method" value="Chuyển phát nhanh" id="delivery-method-1"></td>
                                    <td><label for="delivery-method-1">Giao hàng chuyển phát nhanh</label></td>
                                </tr>
                            </table>
                        </div>
                        <p style="font-weight: bold; font-size: 20px;">Phương thức thanh toán</p>
                        <div class="payment-table">
                            <table>
                                <tr>
                                    <td><input type="radio" name="payment_method" value="Thẻ tín dụng" id="payment-method-1"></td>
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
                    <div class="payment-content-right">
                        <div class="payment-content-right-button">
                            <input type="text" placeholder="Mã giảm giá">
                            <button><i class="fas fa-check"></i></button>
                        </div>
                        <div class="payment-content-right-button">
                            <input type="text" placeholder="Mã giảm giá">
                            <button><i class="fas fa-check"></i></button>
                        </div>
                        <div class="payment-content-right-button-mnv">
                            <select name="" id="">
                                <option value="">Chọn mã ưu đãi</option>
                                <option value="">Ph54666</option>
                                <option value="">Ph54666</option>
                                <option value="">Ph54666</option>
                                <option value="">Ph54666</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="payment-content-right-payment">
                    <button type="submit">THANH TOÁN</button>
                </div>
            </div>
        </form>
    </section>
    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
    <script src="js/slide.js"></script>
</body>
</html>

    