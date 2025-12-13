<?php
class User {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]);  
        $user = $stmt->fetch();

        if ($user) {
            return $user;
        }
        return false;
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
?>