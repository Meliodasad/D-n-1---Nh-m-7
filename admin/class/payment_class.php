<?php
include_once 'database.php';
class Payment {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }
    public function get_grouped_orders() {
        $query = "
            SELECT 
                order_id, 
                user_name, 
                COUNT(product_id) AS total_items, 
                SUM(product_price * product_quantity) AS total_price, 
                created_at, 
                status 
            FROM tbl_payment_detail 
            GROUP BY order_id
            ORDER BY created_at DESC
        ";
        return $this->db->select($query);
    }
    public function get_order_details($order_id) {
        $query = "
            SELECT 
                tbl_payment_detail.*, 
                product_name, 
                product_price, 
                product_quantity 
            FROM tbl_payment_detail 
            JOIN tbl_products ON tbl_payment_detail.product_id = tbl_products.id 
            WHERE order_id = '$order_id'
        ";
        return $this->db->select($query);
    }
    public function insert_payment($data) {
        $user_id = $data['user_id'];
        $cart_id = $data['cart_id'];
        $payment_method = $data['payment_method'];
        $delivery_method = $data['delivery_method'];
        $status = $data['status'];
        $total_price = $data['total_price'];

        $query = "
            INSERT INTO tbl_payment_detail (user_id, cart_id, payment_method, delivery_method, status, total_price, created_at) 
            VALUES ('$user_id', '$cart_id', '$payment_method', '$delivery_method', '$status', '$total_price', NOW())
        ";
        return $this->db->insert($query);
    }
    public function update_order_status($order_id, $status) {
        $query = "
            UPDATE tbl_payment_detail 
            SET status = '$status', updated_at = NOW() 
            WHERE order_id = '$order_id'
        ";
        return $this->db->update($query);
    }
    public function delete_order($order_id) {
        $query = "
            DELETE FROM tbl_payment_detail 
            WHERE order_id = '$order_id'
        ";
        return $this->db->delete($query);
    }
}
