
<?php
include 'database.php';
?>
<?php
class Category {
    private $db;

    public function __construct() 
    {
        $this->db = new Database();
    }

    public function insert_category($category_name) {
        $query = "INSERT INTO tbl_category (category_name) VALUES ('$category_name')";
        $result = $this->db->insert($query);
        header('location:cartegorylist.php');
        // return $result;
    }

    public function show_category() {
    $query = "SELECT * FROM tbl_category ORDER BY category_id DESC";
    $result = $this->db->select($query);
    return $result;
}
// định nghĩa hàm
public function get_category($category_id) {
    $query = "SELECT * FROM tbl_category WHERE category_id = '$category_id'";
    $result = $this->db->select($query);
    return $result;
}
public function update_category($category_name, $category_id) {
    $query = "UPDATE tbl_cartegory SET category_name = '$category_name' WHERE category_id = '$category_id'";
    $result = $this->db->select($query);
    header('location:cartegorylist.php');
    return $result;
}
public function delete_category($category_id) {
    $query = "DELETE FROM tbl_category WHERE category_id = '$category_id'";
    $result = $this->db->delete($query);
    header('location:cartegorylist.php');
    return $result;
}
}
?>
<!-- <form method="POST" action="categoryadd.php">
    <input type="text" name="category_name" required />
    <input type="submit" value="Add Category" />
</form> -->
