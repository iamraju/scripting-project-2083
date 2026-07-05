<?php

// this the file to handle database operations
class Database {
    public mysqli $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function query(string $sql) {
        return $this->db->query($sql);
    }

    public function escape_string(string $string) {
        return $this->db->real_escape_string($string);
    }

    public function insert(string $sql): mixed {
        return '';
    }

    public function update(string $sql): mixed {
        return '';
    }

    public function close() {
        $this->db->close();
    }
}