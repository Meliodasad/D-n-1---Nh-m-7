<?php
include 'header.html';
include 'slider.html';
include_once 'database.php';  // Bao gồm kết nối cơ sở dữ liệu từ database.php

// Truy vấn dữ liệu
$sql = "SELECT product_id, product_name, category_id, brand_id, product_price, product_price_new, product_desc, product_img FROM products";
$result = $conn->query($sql);

// Kiểm tra và hiển thị kết quả
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Category ID</th>
                <th>Brand ID</th>
                <th>Product Price</th>
                <th>Product Price (New)</th>
                <th>Description</th>
                <th>Product Image</th>
            </tr>";

    // Lặp qua các bản ghi và hiển thị
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["product_id"] . "</td>
                <td>" . $row["product_name"] . "</td>
                <td>" . $row["category_id"] . "</td>
                <td>" . $row["brand_id"] . "</td>
                <td>" . $row["product_price"] . "</td>
                <td>" . $row["product_price_new"] . "</td>
                <td>" . $row["product_desc"] . "</td>
                <td><img src='" . $row["product_img"] . "' alt='" . $row["product_name"] . "' width='100'></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
