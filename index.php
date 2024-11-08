<?php
require_once 'config/Database.php';
require_once __DIR__ . '/controllers/ProductController.php';


$database = new Database();
$db = $database->connect();
$controller = new HomeController($db);

// Điều hướng đến trang chủ
$controller->index();
?>
