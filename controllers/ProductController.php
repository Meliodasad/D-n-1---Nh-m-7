<?php
// Controllers/HomeController.php
require_once 'Models/ProductModel.php';

class HomeController {
    private $productModel;

    public function __construct($db) {
        $this->productModel = new ProductModel($db);
    }

    // Hàm hiển thị trang chủ
    public function index() {
        $products = $this->productModel->getAllProducts();
        include 'Views/home.php';
    }
}
?>
