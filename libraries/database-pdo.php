<?php

class DatabasePDO
{
    protected static ?PDO $connection = null;

    protected PDO $db;

    protected string $table;

    public function __construct()
    {
        $this->db = self::getConnection();
    }

    /**
     * Shared PDO connection (singleton) so every model doesn't
     * open its own separate connection.
     */
    protected static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=utf8mb4',
                DB_HOST,
                DB_NAME
            );

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false, // use real prepared statements
            ];

            try {
                self::$connection = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
            } catch (PDOException $e) {
                // Don't leak connection details to the browser in production
                throw new RuntimeException('Database connection failed: ' . $e->getMessage());
            }
        }

        return self::$connection;
    }

    /**
     * Run a raw SELECT with optional bound params, return all rows.
     * Prefer this over building SQL with string concatenation.
     */
    public function selectAll(string $sql, array $params = []): array
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Run a raw SELECT with optional bound params, return first row (or null).
     */
    public function selectOne(string $sql, array $params = []): ?array
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        return $this->selectOne($sql, ['id' => $id]);
    }

    public function insert(array $data): int|false
    {
        $columns      = array_keys($data);
        $placeholders = array_map(fn($col) => ":{$col}", $columns);

        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $this->table,
            '`' . implode('`, `', $columns) . '`',
            implode(', ', $placeholders)
        );

        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);

        return (int) $this->db->lastInsertId();
    }

    public function update(array $data, int $id): int|false
    {
        if (!$id) {
            return false;
        }

        $assignments = array_map(fn($col) => "`{$col}` = :{$col}", array_keys($data));

        $sql = sprintf(
            'UPDATE %s SET %s WHERE id = :id',
            $this->table,
            implode(', ', $assignments)
        );

        $data['id'] = $id;

        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);

        return $id;
    }

    public function delete(int $id): bool
    {
        $sql  = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Handy for multi-step writes (e.g. Order + OrderItems).
     */
    public function transaction(callable $callback): mixed
    {
        $this->db->beginTransaction();

        try {
            $result = $callback($this->db);
            $this->db->commit();
            return $result;
        } catch (Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function lastInsertId(): string
    {
        return $this->db->lastInsertId();
    }

    /**
     * PDO connections close automatically when the object is
     * garbage collected / script ends, but exposed for explicit use.
     */
    public function close(): void
    {
        self::$connection = null;
    }
}