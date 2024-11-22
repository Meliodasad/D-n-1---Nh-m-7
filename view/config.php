<?php

$host = 'localhost';

$dbname = 'web_duan1'; 
$username = 'root'; 
$password = 'khaikhai';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
}

// $dbname = 'web_duan1';
// $username = 'root';
// $password = '052005';

// try {
//     // Tạo kết nối PDO
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

//     // Thiết lập chế độ lỗi PDO
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());

// }
?>
