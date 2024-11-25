<?php

include 'config.php';
include 'header.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Vui lòng đăng nhập để xem giỏ hàng.'); window.location.href = 'dangnhap.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id']; // Lấy user_id từ session

// Xử lý xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['remove'])) {
    $cart_id = intval($_GET['remove']);
    $sql_delete = "DELETE FROM tbl_cart WHERE cart_id = :cart_id AND user_id = :user_id";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->execute([':cart_id' => $cart_id, ':user_id' => $user_id]);

    // Quay lại trang giỏ hàng sau khi xóa
    header("Location: cart.php");
    exit;
}

// Cập nhật số lượng sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $cart_id = intval($_POST['cart_id']);
    $quantity = intval($_POST['quantity']);

    if ($quantity > 0) {
        $sql_update = "UPDATE tbl_cart SET cart_quantity = :quantity WHERE cart_id = :cart_id AND user_id = :user_id";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->execute([':quantity' => $quantity, ':cart_id' => $cart_id, ':user_id' => $user_id]);
    }
    header("Location: cart.php");
    exit;
}

// Lấy danh sách sản phẩm trong giỏ hàng của tài khoản đang đăng nhập
$sql_cart_items = "SELECT * FROM tbl_cart WHERE user_id = :user_id";
$stmt_cart_items = $conn->prepare($sql_cart_items);
$stmt_cart_items->execute([':user_id' => $user_id]);
$cart_items = $stmt_cart_items->fetchAll(PDO::FETCH_ASSOC);

// Tính tổng tiền và tổng số lượng sản phẩm
$total_price = 0;
$total_quantity = 0;

foreach ($cart_items as $cart) {
    $total_price += $cart['cart_price'] * $cart['cart_quantity'];
    $total_quantity += $cart['cart_quantity'];
}

// Xử lý thanh toán
if (isset($_POST['checkout'])) {
    if ($total_price == 0) {
        echo "<script>alert('Vui lòng chọn sản phẩm để thanh toán.');</script>";
    } else {
        header("Location: payment.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="css/mainstyle.css">
</head>
<body>
    <section class="cart">
        <div class="container">
            <div class="cart-content row">
                <?php if (count($cart_items) > 0): ?>
                <div class="cart-content-left">
                    <table>
                        <tr>
                            <th>Chọn</th>
                            <th>Sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn Giá</th>
                            <th>Xoá</th>
                        </tr>
                        <?php foreach ($cart_items as $cart): ?>
                        <tr>
                            <td><input type="checkbox" name="selected_items[]" value="<?php echo $cart['cart_id']; ?>"></td>
                            <td><img src="<?= $cart['cart_img'] ?>" width="150" height="150"></td>
                            <td><p><?php echo $cart['cart_name']; ?></p></td>
                            <td>
                                <form method="POST" action="" style="display: inline-block;">
                                    <input type="hidden" name="cart_id" value="<?php echo $cart['cart_id']; ?>">
                                    <input type="number" name="quantity" id="quantity_<?php echo $cart['cart_id']; ?>" 
                                           value="<?php echo $cart['cart_quantity']; ?>" 
                                           min="1" onchange="this.form.submit()">
                                    <input type="hidden" name="update_quantity" value="1">
                                </form>
                            </td>
                            <td><p id="price_<?php echo $cart['cart_id']; ?>"><?php echo number_format($cart['cart_price'] * $cart['cart_quantity']); ?> <sup>đ</sup></p></td>
                            <td><a href="cart.php?remove=<?php echo $cart['cart_id']; ?>" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">X</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="cart-content-right">
                    <table>
                        <tr>
                            <th colspan="2">TỔNG TIỀN GIỎ HÀNG</th>
                        </tr>
                        <tr>
                            <td>TỔNG SẢN PHẨM</td>
                            <td><p id="total_quantity"><?php echo $total_quantity; ?></p></td>
                        </tr>
                        <tr>
                            <td>TỔNG TIỀN HÀNG</td>
                            <td><p id="total_price"><?php echo number_format($total_price); ?> <sup>đ</sup></p></td>
                        </tr>
                    </table>
                    <div class="cart-content-right-text">
                        <?php if ($total_price >= 3000000): ?>
                            <p>Bạn đã được miễn phí ship!</p>
                        <?php else: ?>
                            <p style="color: red; font-weight: bold;">Mua thêm <span style="font-size: 18px;"><?php echo number_format(3000000 - $total_price); ?>₫</span> để được miễn phí ship!</p>
                        <?php endif; ?>
                    </div>
                    <div class="cart-content-right-button">
                        <a href="product.php"><button type="button">Tiếp tục mua sắm</button></a>
                        <form method="POST" action="">
                            <button type="submit" name="checkout">Thanh Toán</button>
                        </form>
                    </div>
                </div>
                <?php else: ?>
                <p>Giỏ hàng của bạn hiện đang trống. <a href="product.php">Tiếp tục mua sắm</a>.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</body>
</html>

<?php include 'footer.php'; ?>
