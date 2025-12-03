<?php
/**
 * Database Configuration and Connection
 */

class Database
{
    private $host = 'localhost';
    private $db_name = 'cnweb';
    private $user = 'root';
    private $password = '';
    private $charset = 'utf8mb4';
    private $pdo;

    public function connect()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=' . $this->charset;

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
            return null;
        }
    }

    public function query($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}
?>
