<?php
class Session {
    
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    
    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    
    public static function get($key) {
        self::start();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    
    public static function exists($key) {
        self::start();
        return isset($_SESSION[$key]);
    }

    
    public static function delete($key) {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    
    public static function destroy() {
        self::start();
        session_unset();
        session_destroy();
    }
}
?>
