<?php
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    public function showLogin()
    {
        require __DIR__ . '/../views/auth/login.php';
    }

    public function login()
    {
        $userModel = new User();
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: /?route=home.index");
            exit;
        }

        $_SESSION['flash_error'] = "Email hoặc mật khẩu sai!";
        header("Location: /?route=auth.login");
        exit;
    }

    public function showRegister()
    {
        require __DIR__ . '/../views/auth/register.php';
    }

    public function register()
    {
        $userModel = new User();

        $username = $_POST['username'];
        $email    = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if ($userModel->findByEmail($email)) {
            $_SESSION['flash_error'] = "Email đã tồn tại!";
            header("Location: /?route=auth.register");
            exit;
        }

        $userModel->create($username, $email, $password);

        $_SESSION['flash_success'] = "Đăng ký thành công!";
        header("Location: /?route=auth.login");
        exit;
    }

    public function logout()
    {
        session_destroy();
        header("Location: /?route=home.index");
        exit;
    }
}
?>