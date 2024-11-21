<?php
// Thông tin kết nối database
$host = 'localhost';
$dbname = 'web_duan1';
$username = 'root';
$password = 'khaikhai';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối database thất bại: " . $e->getMessage());
}
?>
