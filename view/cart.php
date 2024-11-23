<?php
require 'config.php'; 
include 'header.php';

// Xử lý thêm sản phẩm vào giỏ hàng
if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    $sql_product = "SELECT * FROM tbl_product WHERE product_id = :product_id";
    $stmt = $conn->prepare($sql_product);
    $stmt->execute(['product_id' => $product_id]);

    if ($stmt->rowCount() > 0) {
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        $sql_cart = "SELECT * FROM tbl_cart WHERE cart_name = :cart_name";
        $stmt_cart = $conn->prepare($sql_cart);
        $stmt_cart->execute(['cart_name' => $product['product_name']]);

        if ($stmt_cart->rowCount() > 0) {
            // Tăng số lượng nếu đã có
            $update_cart = "UPDATE tbl_cart SET cart_quantity = cart_quantity + 1 WHERE cart_name = :cart_name";
            $stmt_update = $conn->prepare($update_cart);
            $stmt_update->execute(['cart_name' => $product['product_name']]);
        } else {
            // Thêm sản phẩm mới
            $insert_cart = "INSERT INTO tbl_cart (cart_img, cart_name, cart_quantity, cart_price) 
                            VALUES (:cart_img, :cart_name, 1, :cart_price)";
            $stmt_insert = $conn->prepare($insert_cart);
            $stmt_insert->execute([
                'cart_img' => $product['product_img'],
                'cart_name' => $product['product_name'],
                'cart_price' => $product['product_price']
            ]);
        }
    }
}

// Xử lý cập nhật số lượng
if (isset($_GET['update_quantity'])) {
    $cart_id = $_GET['update_quantity'];
    $quantity = max(1, intval($_GET['quantity']));
    $sql_update_quantity = "UPDATE tbl_cart SET cart_quantity = :quantity WHERE cart_id = :cart_id";
    $stmt_update_quantity = $conn->prepare($sql_update_quantity);
    $stmt_update_quantity->execute(['quantity' => $quantity, 'cart_id' => $cart_id]);
    header("Location: cart.php");
    exit;
}

// Xử lý xóa sản phẩm
if (isset($_GET['remove'])) {
    $cart_id = $_GET['remove'];
    $sql_remove = "DELETE FROM tbl_cart WHERE cart_id = :cart_id";
    $stmt_remove = $conn->prepare($sql_remove);
    $stmt_remove->execute(['cart_id' => $cart_id]);
    header("Location: cart.php");
    exit;
}

// Lấy danh sách sản phẩm trong giỏ hàng
$sql_cart_items = "SELECT * FROM tbl_cart";
$stmt_cart_items = $conn->prepare($sql_cart_items);
$stmt_cart_items->execute();
$cart_items = $stmt_cart_items->fetchAll(PDO::FETCH_ASSOC);
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
                <div class="cart-content-left">
                    <table>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Xoá</th>
                        </tr>
                        <?php foreach ($cart_items as $cart): ?>
                        <tr>
                            <td><img src="image/<?php echo $cart['cart_img']; ?>" alt=""></td>
                            <td><p><?php echo $cart['cart_name']; ?></p></td>
                            <td>
                                <input type="number" value="<?php echo $cart['cart_quantity']; ?>" min="1" 
                                       onchange="updateQuantity(<?php echo $cart['cart_id']; ?>, this.value)">
                            </td>
                            <td><p><?php echo number_format($cart['cart_price'] * $cart['cart_quantity']); ?> <sup>đ</sup></p></td>
                            <td><a href="cart.php?remove=<?php echo $cart['cart_id']; ?>">X</a></td>
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
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>TỔNG TIỀN HÀNG</td>
                            <td><p>2.500.000 <sup>đ</sup></p></td>
                        </tr>
                        <tr>
                            <td>Tổng:</td>
                            <td><p style="color: black; font-weight: bold;"> 2.500.000 <sup>đ</sup></p></td>
                        </tr>
                    </table>
                    <div class="cart-content-right-text">
                        <p>Bạn sẽ được miễn phí ship đơn hàng của bạn có tổng giá trị trên 3.000.000 đ</p>
                        <p style="color: red; font-weight: bold;">mua thêm <span style="font-size: 18px;">500.000đ</span> để được miễn phí SHIP</p>
                    </div>
                    <div class="cart-content-right-button">
                        <a href="product.html"><button>Tiếp tục mua sắm</button></a>
                        <a href="payment.html"><button>Thanh Toán</button></a>
                    </div>
                    <div class="cart-content-right-dangnhap">
                        <p>Tài Khoản</p><br>
                        <p>Vui lòng <a href="">Đăng nhập</a> tài khoản của bạn để thanh toán</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function updateQuantity(cartId, quantity) {
            window.location.href = `cart.php?update_quantity=${cartId}&quantity=${quantity}`;
        }
    </script>
</body>
</html>

<?php include 'footer.php'; ?>
