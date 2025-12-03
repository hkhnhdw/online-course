<?php
require_once __DIR__ . '/../../config/Database.php';

class User
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($username, $email, $password)
    {
        $sql = "INSERT INTO users (username, email, password, role)
                VALUES (?, ?, ?, 1)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$username, $email, $password]);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateRole($id, $role)
    {
        $sql = "UPDATE users SET role = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$role, $id]);
    }
}
