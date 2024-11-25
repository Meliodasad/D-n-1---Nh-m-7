<?php

include 'config.php';
include 'header.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Lấy danh sách sản phẩm trong giỏ hàng
$sql_cart_items = "SELECT * FROM tbl_cart";
$stmt_cart_items = $conn->prepare($sql_cart_items);
$stmt_cart_items->execute();
$cart_items = $stmt_cart_items->fetchAll(PDO::FETCH_ASSOC);

// Tính tổng tiền và tổng số lượng sản phẩm cho những sản phẩm được chọn
$total_price = 0;
$total_quantity = 0;

if (isset($_POST['selected_items'])) {
    $selected_items = $_POST['selected_items']; // Mảng chứa các cart_id đã chọn
    foreach ($selected_items as $cart_id) {
        $sql_item = "SELECT * FROM tbl_cart WHERE cart_id = :cart_id";
        $stmt_item = $conn->prepare($sql_item);
        $stmt_item->execute([':cart_id' => $cart_id]);
        $cart = $stmt_item->fetch(PDO::FETCH_ASSOC);
        $total_price += $cart['cart_price'] * $cart['cart_quantity'];
        $total_quantity += $cart['cart_quantity'];
    }
}

if (isset($_POST['checkout'])) {
    // Kiểm tra nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Vui lòng đăng nhập để tiếp tục thanh toán.'); window.location.href = 'dangnhap.php';</script>";
        exit;
    } else {
        // Người dùng đã đăng nhập, chuyển đến trang thanh toán
        header("Location: payment.php");
        exit();
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
    <script>
        // Hàm tính tổng tiền và số lượng dựa trên các checkbox được chọn
        function updateTotal() {
            let totalPrice = 0;
            let totalQuantity = 0;

            // Lấy tất cả checkbox đã chọn
            let selectedItems = document.querySelectorAll('input[name="selected_items[]"]:checked');
            
            selectedItems.forEach(function(item) {
                // Lấy cart_id và price từ dữ liệu đã được ẩn trong các thẻ tr
                let cartId = item.value;
                let price = parseFloat(document.getElementById('price_' + cartId).innerText.replace(/[^\d.-]/g, '')); // Loại bỏ các ký tự không phải số
                let quantity = parseInt(document.getElementById('quantity_' + cartId).value);
                
                // Kiểm tra giá trị hợp lệ
                if (!isNaN(price) && !isNaN(quantity)) {
                    totalPrice += price * quantity;
                    totalQuantity += quantity;
                }
            });

            // Cập nhật tổng tiền và tổng số lượng
            document.getElementById('total_price').innerText = new Intl.NumberFormat().format(totalPrice) + ' đ';
            document.getElementById('total_quantity').innerText = totalQuantity;
        }
    </script>
</head>
<body>
    <section class="cart">
        <div class="container">
            <div class="cart-content row">
                <?php if (count($cart_items) > 0): ?>
                <div class="cart-content-left">
                    <form method="POST" action="">
                        <table>
                            <tr>
                                <th>Chọn</th>
                                <th>Sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Xoá</th>
                            </tr>
                            <?php foreach ($cart_items as $cart): ?>
                            <tr>
                                <td><input type="checkbox" name="selected_items[]" value="<?php echo $cart['cart_id']; ?>" onchange="updateTotal()"></td>
                                <td><img src="image/<?php echo $cart['cart_img']; ?>" alt=""></td>
                                <td><p><?php echo $cart['cart_name']; ?></p></td>
                                <td>
                                    <input type="number" id="quantity_<?php echo $cart['cart_id']; ?>" value="<?php echo $cart['cart_quantity']; ?>" min="1" onchange="updateTotal()">
                                </td>
                                <td><p id="price_<?php echo $cart['cart_id']; ?>"><?php echo number_format($cart['cart_price'] * $cart['cart_quantity']); ?> <sup>đ</sup></p></td>
                                <td><a href="cart.php?remove=<?php echo $cart['cart_id']; ?>">X</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </form>
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
                        <a href="product.html"><button>Tiếp tục mua sắm</button></a>
                        <!-- Thêm form để gửi thông tin thanh toán -->
                        <form method="POST" action="">
                            <button type="submit" name="checkout">Thanh Toán</button>
                        </form>
                    </div>
                </div>
                <?php else: ?>
                <p>Giỏ hàng của bạn hiện đang trống. <a href="product.html">Tiếp tục mua sắm</a>.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</body>
</html>

<?php include 'footer.php'; ?>
