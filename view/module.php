<?php
$servername = "localhost";
$username = "root";
$password = "khaikhai";
$dbname = "duan1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối CSDL thất bại: " . $conn->connect_error);
}
?>
