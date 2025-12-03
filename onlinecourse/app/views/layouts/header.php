<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$user = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Online Course</title>
</head>
<body>

<nav>
    <a href="/?route=home.index">Trang chủ</a>

    <?php if ($user): ?>
        | Xin chào <b><?= htmlspecialchars($user['username']) ?></b>
        | <a href="/?route=auth.logout">Đăng xuất</a>
        <?php if ($user['role'] == 2): ?>
            | <a href="/?route=admin.users">Quản lý người dùng</a>
        <?php endif; ?>
    <?php else: ?>
        | <a href="/?route=auth.login">Đăng nhập</a>
        | <a href="/?route=auth.register">Đăng ký</a>
    <?php endif; ?>
</nav>
<hr>
