<?php

class Request {
    public static function isPost(): bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public static function getPost(string $key, $default = null) {
        return isset($_POST[$key]) ? self::purifyValue($_POST[$key]) : $default;
    }

    public static function getGet(string $key, $default = null) {
        return isset($_GET[$key]) ? self::purifyValue($_GET[$key]) : $default;
    }

    private static function purifyValue(string $value): string {
        return trim(htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
    }
}