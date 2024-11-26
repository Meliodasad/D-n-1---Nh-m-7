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

// Cập nhật số lượng sản phẩm (Xử lý AJAX)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id']) && isset($_POST['quantity'])) {
    $cart_id = intval($_POST['cart_id']);
    $quantity = intval($_POST['quantity']);

    if ($quantity > 0) {
        $sql_update = "UPDATE tbl_cart SET cart_quantity = :quantity WHERE cart_id = :cart_id AND user_id = :user_id";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->execute([':quantity' => $quantity, ':cart_id' => $cart_id, ':user_id' => $user_id]);
    }
    // Trả về kết quả không có gì (để xử lý trong AJAX)
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

// Định dạng tổng tiền và tổng số lượng với dấu phẩy
$total_price_formatted = number_format($total_price);  // Dấu phẩy ở hàng nghìn
$total_quantity_formatted = number_format($total_quantity);  // Định dạng số lượng sản phẩm

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
    <script>
        function updateCart() {
            var total_price = 0;
            var total_quantity = 0;
            var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

            checkboxes.forEach(function(checkbox) {
                var row = checkbox.closest('tr'); // Lấy hàng tương ứng với checkbox
                var quantity = parseInt(row.querySelector('.quantity-input').value);
                var price = parseFloat(row.querySelector('.product-price').dataset.price);
                
                total_price += price * quantity;
                total_quantity += quantity;
            });

            // Cập nhật tổng số lượng và tổng tiền trên giao diện
            document.getElementById('total_quantity').innerText = total_quantity.toLocaleString();
            document.getElementById('total_price').innerText = total_price.toLocaleString() + '₫';

            // Cập nhật thông tin miễn phí ship nếu có
            var freeShipInfo = document.getElementById('free_ship_info');
            if (total_price >= 3000000) {
                freeShipInfo.innerText = "Bạn đã được miễn phí ship!";
                freeShipInfo.style.color = "green";
            } else {
                freeShipInfo.innerHTML = "Mua thêm <span style='font-size: 18px;'>" + (3000000 - total_price).toLocaleString() + "₫</span> để được miễn phí ship!";
                freeShipInfo.style.color = "red";
            }
        }

        // Đảm bảo tính toán khi checkbox thay đổi
        document.addEventListener('DOMContentLoaded', function() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', updateCart);
            });
            
            // Cập nhật khi trang tải xong
            updateCart();
        });

        // AJAX cập nhật số lượng khi nhấn tăng hoặc giảm
        document.addEventListener('DOMContentLoaded', function() {
            // Hàm gửi yêu cầu AJAX để cập nhật số lượng
            function updateQuantity(cart_id, quantity) {
                var formData = new FormData();
                formData.append('cart_id', cart_id);
                formData.append('quantity', quantity);
                
                fetch('cart.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    // Sau khi gửi thành công, cập nhật lại giao diện
                    updateCart();
                })
                .catch(error => {
                    alert('Có lỗi xảy ra khi cập nhật số lượng.');
                });
            }

            // Xử lý sự kiện khi bấm nút "Tăng"
            var increaseBtns = document.querySelectorAll('.increase-btn');
            increaseBtns.forEach(function(button) {
                button.addEventListener('click', function() {
                    var cart_id = button.getAttribute('data-cart-id');
                    var quantityInput = document.querySelector('#quantity_' + cart_id);
                    var quantity = parseInt(quantityInput.value) + 1;
                    quantityInput.value = quantity;
                    updateQuantity(cart_id, quantity);
                });
            });

            // Xử lý sự kiện khi bấm nút "Giảm"
            var decreaseBtns = document.querySelectorAll('.decrease-btn');
            decreaseBtns.forEach(function(button) {
                button.addEventListener('click', function() {
                    var cart_id = button.getAttribute('data-cart-id');
                    var quantityInput = document.querySelector('#quantity_' + cart_id);
                    var quantity = parseInt(quantityInput.value) - 1;
                    if (quantity > 0) {
                        quantityInput.value = quantity;
                        updateQuantity(cart_id, quantity);
                    }
                });
            });
            
            // Cập nhật khi trang tải xong
            updateCart();
        });
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
                                <th>Thành Tiền</th>
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
                                        <!-- Thêm nút tăng và giảm -->
                                        <button type="button" class="increase-btn" data-cart-id="<?php echo $cart['cart_id']; ?>">+</button>
                                        <input type="number" name="quantity" class="quantity-input" id="quantity_<?php echo $cart['cart_id']; ?>" 
                                               value="<?php echo $cart['cart_quantity']; ?>" 
                                               min="1" onchange="updateCart()">
                                        <button type="button" class="decrease-btn" data-cart-id="<?php echo $cart['cart_id']; ?>">-</button>
                                    </form>
                                </td>
                                <td><p class="product-price" style="font-weight: bold; font-size: 13px;" data-price="<?php echo $cart['cart_price']; ?>"><?php echo number_format($cart['cart_price'] * $cart['cart_quantity']); ?> <sup>đ</sup></p></td>
                                <td><a href="cart.php?remove=<?php echo $cart['cart_id']; ?>" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">X</a></td>
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
                            <td><p id="total_quantity"><?php echo $total_quantity_formatted; ?></p></td>
                        </tr>
                        <tr>
                            <td>TỔNG TIỀN HÀNG</td>
                            <td><p id="total_price" style="font-weight: bold; font-size: 20px; "><?php echo $total_price_formatted; ?> <sup>đ</sup></p></td>
                        </tr>
                    </table>
                    <div class="cart-content-right-text">
                        <p id="free_ship_info" style="font-weight: bold;">
                            <?php if ($total_price >= 3000000): ?>
                                Bạn đã được miễn phí ship!
                            <?php else: ?>
                                Mua thêm <span style="font-size: 18px;"><?php echo number_format(3000000 - $total_price); ?>₫</span> để được miễn phí ship!
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="cart-content-right-button">
                        <a href="product.php"><button type="button">Tiếp tục mua sắm</button></a>
                        <form method="POST" action="">
                            <button type="submit" name="checkout">Thanh Toán</button>
                        </form>
                    </div>
                </div>
                <?php else: ?>
                    <p>Giỏ hàng của bạn chưa có sản phẩm nào.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</body>
</html>
