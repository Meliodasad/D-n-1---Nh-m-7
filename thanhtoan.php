<?php
session_start();

// Giả định có một giỏ hàng với sản phẩm
$cartItems = [
    ["name" => "Japanese Knife A", "price" => 50, "quantity" => 1],
    ["name" => "Japanese Knife B", "price" => 75, "quantity" => 2],
];

$totalAmount = 0;
foreach ($cartItems as $item) {
    $totalAmount += $item["price"] * $item["quantity"];
}

// Xử lý khi người dùng nhấn "Đặt hàng"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $paymentMethod = $_POST["payment_method"];

    echo "<h3>Thông tin Đơn Hàng:</h3>";
    echo "Tên: $name <br>";
    echo "Địa chỉ: $address <br>";
    echo "Số điện thoại: $phone <br>";
    echo "Phương thức thanh toán: $paymentMethod <br>";
    echo "Tổng tiền: $" . $totalAmount . "<br>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Thanh Toán</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 400px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .cart-items {
            margin-bottom: 20px;
        }
        .cart-items li {
            list-style: none;
            padding: 5px 0;
        }
        .total {
            font-weight: bold;
            margin-bottom: 20px;
            text-align: right;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            background-color: #5cb85c;
            color: #fff;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Trang Thanh Toán</h2>
        
        <div class="cart-items">
            <h3>Giỏ Hàng Của Bạn:</h3>
            <ul>
                <?php foreach ($cartItems as $item): ?>
                    <li><?php echo $item["name"]; ?> - $<?php echo $item["price"]; ?> x <?php echo $item["quantity"]; ?></li>
                <?php endforeach; ?>
            </ul>
            <p class="total"><strong>Tổng tiền:</strong> $<?php echo $totalAmount; ?></p>
        </div>

        <!-- Form thanh toán -->
        <form action="" method="POST">
            <label for="name">Họ và tên:</label>
            <input type="text" name="name" required>

            <label for="address">Địa chỉ:</label>
            <input type="text" name="address" required>

            <label for="phone">Số điện thoại:</label>
            <input type="text" name="phone" required>

            <label for="payment_method">Phương thức thanh toán:</label>
            <select name="payment_method">
                <option value="cash">Thanh toán khi nhận hàng</option>
                <option value="credit_card">Thẻ tín dụng</option>
            </select>

            <button type="submit">Đặt hàng</button>
        </form>
    </div>
</body>
</html>
