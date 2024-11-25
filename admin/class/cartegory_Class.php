<?php
include_once 'database.php';

class Category {
    private $db;

    // Constructor để khởi tạo đối tượng Database
    public function __construct() {
        $this->db = new Database();  // Khởi tạo kết nối CSDL
    }

    // Phương thức thêm danh mục
    public function insert_category($category_name) {
        if (!empty($category_name)) {
            // Chuẩn bị câu truy vấn
            $stmt = $this->db->prepare("INSERT INTO tbl_category (category_name) VALUES (?)");
            // Liên kết tham số
            $stmt->bind_param("s", $category_name);
            // Thực thi câu truy vấn
            $result = $stmt->execute();
            $stmt->close();
            
            if ($result) {
                header('Location: cartegorylist.php');  // Chuyển hướng sau khi thêm thành công
                exit();
            } else {
                echo "Thêm danh mục thất bại!";
            }
        } else {
            echo "Tên danh mục không được để trống!";
        }
    }

    // Phương thức hiển thị danh mục
    public function show_category() {
        $query = "SELECT * FROM tbl_category ORDER BY category_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    // Phương thức lấy thông tin danh mục theo ID
    public function get_category($category_id) {
        $query = "SELECT * FROM tbl_category WHERE category_id = '$category_id'";
        $result = $this->db->select($query);
        return $result;
    }

    // Phương thức cập nhật danh mục
    public function update_category($category_name, $category_id) {
        $query = "UPDATE tbl_category SET category_name = '$category_name' WHERE category_id = '$category_id'";
        $result = $this->db->update($query);  // Thực thi câu truy vấn cập nhật
        header('Location: categorylist.php');  // Chuyển hướng sau khi cập nhật thành công
        return $result;
    }

    // Phương thức xóa danh mục
    public function delete_category($category_id) {
        $query = "DELETE FROM tbl_category WHERE category_id = '$category_id'";
        $result = $this->db->delete($query);  // Thực thi câu truy vấn xóa
        header('Location: categorylist.php');  // Chuyển hướng sau khi xóa thành công
        return $result;
    }
}
?>
