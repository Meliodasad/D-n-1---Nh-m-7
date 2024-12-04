<?php
include_once 'database.php';

class Product {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function show_category() {
        $query = "SELECT * FROM tbl_category ORDER BY category_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_all_product() {
        $query = "SELECT tbl_product.*, tbl_category.category_name
                  FROM tbl_product
                  INNER JOIN tbl_category ON tbl_product.category_id = tbl_category.category_id
                  ORDER BY tbl_product.product_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function insert_product() {
        $product_name = $_POST['product_name'];
        $category_id = $_POST['category_id'];
        $product_price = $_POST['product_price'];
        $product_price_new = $_POST['product_price_new'];
        $product_desc = $_POST['product_desc'];
        $product_img = $_FILES['product_img']['name'];
        $product_img_tmp = $_FILES['product_img']['tmp_name'];
    
        // Di chuyển ảnh tải lên đến thư mục uploads
        move_uploaded_file($product_img_tmp, "uploads/" . $product_img);
    
        // Câu lệnh SQL để thêm sản phẩm vào cơ sở dữ liệu
        $query = "INSERT INTO tbl_product (
            product_name,
            category_id,
            product_price,
            product_price_new,
            product_desc,
            product_img
        ) VALUES (
            '$product_name',
            '$category_id',
            '$product_price',
            '$product_price_new',
            '$product_desc',
            '$product_img'
        )";
    
        // Thực thi câu lệnh SQL và trả về kết quả
        $result = $this->db->insert($query);
    
        if ($result) {
            // Lấy ID của sản phẩm vừa thêm vào nếu thành công
            $query = "SELECT * FROM tbl_product ORDER BY product_id DESC LIMIT 1";
            $result = $this->db->select($query)->fetch_assoc();
            $product_id = $result['product_id'];
        }
    
        return $result;
    }
    
    
    public function update_product($product_id, $data, $files) {
        $product_name = $data['product_name'];
        $category_id = $data['category_id'];
        $product_price = $data['product_price'];
        $product_price_new = $data['product_price_new'];
        $product_desc = $data['product_desc'];
    
        
        $product_img = $files['product_img']['name'];
        if ($product_img) {
            $tmp_name = $files['product_img']['tmp_name'];
            move_uploaded_file($tmp_name, "uploads/$product_img");
    
            $query = "UPDATE tbl_product SET 
                product_name = '$product_name',
                category_id = '$category_id',
                product_price = '$product_price',
                product_price_new = '$product_price_new',
                product_desc = '$product_desc',
                product_img = '$product_img'
                WHERE product_id = '$product_id'";
        } else {
            $query = "UPDATE tbl_product SET 
                product_name = '$product_name',
                category_id = '$category_id',
                product_price = '$product_price',
                product_price_new = '$product_price_new',
                product_desc = '$product_desc'
                WHERE product_id = '$product_id'";
        }
    
        return $this->db->update($query);
    }
    public function get_product_by_id($product_id) {
        $query = "SELECT * FROM tbl_product WHERE product_id = '$product_id'";
        $result = $this->db->select($query);
    
        
        if ($result) {
            return $result->fetch_assoc(); 
        } else {
            return false;
        }
    }
    public function delete_product($product_id) {
        
        $sql = "DELETE FROM tbl_product WHERE product_id = '$product_id'";
    
        
        if ($this->db->delete($sql)) {
            return true;  
        } else {
            return false; 
        }
    }
    
}
?>
