<?php
class Session {
    // Khởi tạo session (nếu chưa có)
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Thiết lập giá trị cho một session
    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    // Lấy giá trị của một session
    public static function get($key) {
        self::start();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // Kiểm tra xem một session có tồn tại hay không
    public static function exists($key) {
        self::start();
        return isset($_SESSION[$key]);
    }

    // Xóa một session
    public static function delete($key) {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    // Xóa toàn bộ session
    public static function destroy() {
        self::start();
        session_unset();
        session_destroy();
    }
}
?>
