<?php
include_once "config.php";

class Database {
    private static $instance = null; 
    private $link; 
    private $error;

    public $host = DB_HOST;
    public $user = DB_USER;
    public $pass = DB_PASS;
    public $dbname = DB_NAME;

    // Constructor để tự động kết nối DB khi khởi tạo đối tượng
    public function __construct() {
        $this->connectDB();  
    }

    // Singleton pattern: chỉ tạo một instance của Database
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Kết nối tới cơ sở dữ liệu
    private function connectDB() {
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->link->connect_error) {
            $this->error = "Kết nối thất bại: " . $this->link->connect_error;
            throw new Exception($this->error);  // Ném ngoại lệ thay vì die
        }

        // Đặt mã hóa kết nối là UTF-8
        if (!$this->link->set_charset("utf8")) {
            throw new Exception("Lỗi thiết lập mã hóa UTF-8: " . $this->link->error);
        }
    }

    // Thực thi câu lệnh SELECT với prepared statement
    public function select($query, $params = []) {
        $stmt = $this->prepare($query);
        $this->bindParams($stmt, $params);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    // Thực thi câu lệnh INSERT
    public function insert($query, $params = []) {
        $stmt = $this->prepare($query);
        $this->bindParams($stmt, $params);
        if ($stmt->execute()) {
            return $stmt;
        }
        return false;
    }

    // Thực thi câu lệnh UPDATE
    public function update($query, $params = []) {
        $stmt = $this->prepare($query);
        $this->bindParams($stmt, $params);
        if ($stmt->execute()) {
            return $stmt;
        }
        return false;
    }

    // Thực thi câu lệnh DELETE
    public function delete($query, $params = []) {
        $stmt = $this->prepare($query);
        $this->bindParams($stmt, $params);
        if ($stmt->execute()) {
            return $stmt;
        }
        return false;
    }

    // Chuẩn bị câu lệnh SQL
    public function prepare($query) {
        $stmt = $this->link->prepare($query);
        if ($stmt === false) {
            throw new Exception("Lỗi chuẩn bị truy vấn: " . $this->link->error);  // Ném ngoại lệ thay vì die
        }
        return $stmt;
    }

    // Gán các tham số cho prepared statement
    private function bindParams($stmt, $params) {
        if (!empty($params)) {
            $types = ''; 
            foreach ($params as $param) {
                $types .= $this->getType($param);
            }
            $stmt->bind_param($types, ...$params);
        }
    }

    // Lấy loại dữ liệu của tham số để bind
    private function getType($param) {
        if (is_integer($param)) {
            return 'i';
        } elseif (is_double($param)) {
            return 'd';
        } elseif (is_string($param)) {
            return 's';
        } else {
            return 'b';
        }
    }

    // Trả về đối tượng kết nối
    public function getConnection() {
        return $this->link;
    }
}
?>
