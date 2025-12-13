<?php
require_once 'app/models/User.php';

class AuthController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->user->login($username, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: index.php?page=dashboard");
                exit();
            } else {
                $error = "Sai tên đăng nhập hoặc mật khẩu!";
            }
        }
        require 'app/views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>