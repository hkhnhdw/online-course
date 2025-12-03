<?php
session_start();

$route = $_GET['route'] ?? 'home.index';

list($controller, $action) = explode('.', $route) + [1 => 'index'];

switch ($controller) {

    // AUTH CONTROLLER
    case 'auth':
        require_once __DIR__ . '/app/controllers/AuthController.php';
        $c = new AuthController();

        if ($action === 'login') $c->showLogin();
        elseif ($action === 'login.post') $c->login();
        elseif ($action === 'register') $c->showRegister();
        elseif ($action === 'register.post') $c->register();
        elseif ($action === 'logout') $c->logout();
        else echo "404 - Action not found";
        break;

    // ADMIN
    case 'admin':
        require_once __DIR__ . '/app/controllers/AdminController.php';
        $c = new AdminController();

        if ($action === 'users') $c->users();
        elseif ($action === 'changeRole') $c->changeRole();
        else echo "404 - Admin action not found";
        break;

    // HOME
    case 'home':
    default:
        require __DIR__ . '/app/views/layouts/header.php';
        echo "<h2>Trang chủ</h2>";
        require __DIR__ . '/app/views/layouts/footer.php';
        break;
}
?>