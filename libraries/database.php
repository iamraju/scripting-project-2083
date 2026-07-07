<?php

// this the file to handle database operations
class Database {
    public mysqli $db;
    
    protected string $table;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function selectAll(string $sql) {
        return $this->db->query($sql);
    }

    public function selectOne(string $sql) {
        $result = $this->db->query($sql);
        return $result->fetch_assoc(); // return first result
    }

    public function findById(int $id) {
        $sql = "select * from {$this->table} where id=$id";
        $result = $this->db->query($sql);
        return $result->fetch_assoc(); // return first result
    }

    public function dbSanitizedValue(string $string) {
        return $this->db->real_escape_string($string);
    }

    
    public function insert(array $data): mixed {
        $sql = "INSERT INTO {$this->table} SET ";
        // /$sql .= "name='Ram', email='ram@gmail.com'";

        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "`{$key}` = '{$this->dbSanitizedValue($value)}'";
        }

        $sql .= implode(', ', $fields);

        if ($this->db->query($sql)) {
            return $this->db->insert_id;
        }

        return null;
    }

    public function update(array $data, int $id): mixed {
        if(!$id) return null;

        $sql = "UPDATE {$this->table} SET ";

        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "`{$key}` = '{$this->dbSanitizedValue($value)}'";
        }

        $sql .= implode(', ', $fields);
        $sql .= ' WHERE id = ' . $id;
        
        if ($this->db->query($sql)) {
            return $id;
        }

        return null;
    }

    public function delete(int $id): mixed {
        $sql = "delete from $this->table where id=$id";
        return $this->db->query($sql);
    }

    public function close() {
        $this->db->close();
    }
}