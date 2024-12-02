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

    
    public function __construct() {
      $this->connectDB();  
  }

    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    
    private function connectDB() {
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->link->connect_error) {
            $this->error = "Kết nối thất bại: " . $this->link->connect_error;
            die($this->error);
        }
    }

    
    public function select($query) {
      $result = $this->link->query($query) or die($this->link->error . __LINE__);
      if ($result->num_rows > 0) {
          return $result;
      } else {
          return false;
      }
  }
    
    public function insert($query) {
        $insert_row = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($insert_row) {
            return $insert_row;
        } else {
            return false;
        }
    }

    
    public function update($query) {
        $update_row = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($update_row) {
            return $update_row;
        } else {
            return false;
        }
    }

    
    public function delete($query) {
        $delete_row = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($delete_row) {
            return $delete_row;
        } else {
            return false;
        }
    }

    
    public function prepare($query) {
        $stmt = $this->link->prepare($query);
        if ($stmt === false) {
            die("Lỗi chuẩn bị truy vấn: " . $this->link->error);
        }
        return $stmt;
    }

   
    public function getConnection() {
        return $this->link;
    }
}
?>
