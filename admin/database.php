<?php
include_once "config.php";

class Database {
    private static $instance = null; // Biến tĩnh để lưu đối tượng Database duy nhất
    private $link; // Kết nối cơ sở dữ liệu
    private $error;

    // Các thuộc tính cấu hình kết nối
    public $host = DB_HOST;
    public $user = DB_USER;
    public $pass = DB_PASS;
    public $dbname = DB_NAME;

    // Hàm khởi tạo private để tránh tạo đối tượng từ ngoài lớp
    public function __construct() {
      $this->connectDB();  // Phương thức này không còn bị hạn chế truy cập
  }

    // Phương thức static để lấy đối tượng duy nhất của lớp Database
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Kết nối đến cơ sở dữ liệu
    private function connectDB() {
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->link->connect_error) {
            $this->error = "Kết nối thất bại: " . $this->link->connect_error;
            die($this->error);
        }
    }

    // Phương thức select để lấy dữ liệu
    public function select($query) {
      $result = $this->link->query($query) or die($this->link->error . __LINE__);
      if ($result->num_rows > 0) {
          return $result;
      } else {
          return false;
      }
  }
    // Phương thức insert để thêm dữ liệu
    public function insert($query) {
        $insert_row = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($insert_row) {
            return $insert_row;
        } else {
            return false;
        }
    }

    // Phương thức update để sửa dữ liệu
    public function update($query) {
        $update_row = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($update_row) {
            return $update_row;
        } else {
            return false;
        }
    }

    // Phương thức delete để xóa dữ liệu
    public function delete($query) {
        $delete_row = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($delete_row) {
            return $delete_row;
        } else {
            return false;
        }
    }

    // Phương thức prepare để chuẩn bị truy vấn với prepared statements
    public function prepare($query) {
        $stmt = $this->link->prepare($query);
        if ($stmt === false) {
            die("Lỗi chuẩn bị truy vấn: " . $this->link->error);
        }
        return $stmt;
    }

    // Phương thức để lấy kết nối cơ sở dữ liệu
    public function getConnection() {
        return $this->link;
    }
}
?>
