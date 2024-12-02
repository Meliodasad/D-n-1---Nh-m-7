<?php
include_once 'database.php';

class Category {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function insert_category($category_name) {
        $query = "INSERT INTO tbl_category (category_name) VALUES ('$category_name')";
        $result = $this->db->insert($query);
        header('location:cartegorylist.php');
    }

    public function show_category() {
        $query = "SELECT * FROM tbl_category ORDER BY category_id DESC";
        return $this->db->select($query);
    }

    public function get_category($category_id) {
        $query = "SELECT * FROM tbl_category WHERE category_id = '$category_id'";
        $result = $this->db->select($query);
        return $result ? $result->fetch_assoc() : null; 
    }

    public function update_category($category_name, $category_id) {
        $query = "UPDATE tbl_category SET category_name = '$category_name' WHERE category_id = '$category_id'";
        return $this->db->update($query); 
    }

    public function delete_category($category_id) {
        $query = "DELETE FROM tbl_category WHERE category_id = '$category_id'";
        return $this->db->delete($query);
    }
}
?>
