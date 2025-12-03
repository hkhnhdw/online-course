<?php require __DIR__ . '/../../layouts/header.php'; ?>

<h2>Đăng ký</h2>

<?php if (!empty($_SESSION['flash_error'])): ?>
<div style="color:red"><?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?></div>
<?php endif; ?>

<?php if (!empty($_SESSION['flash_success'])): ?>
<div style="color:green"><?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?></div>
<?php endif; ?>

<form method="POST" action="/?route=auth.register.post">

    <label>Tên đăng nhập:</label>
    <input type="text" name="username" required><br>

    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Mật khẩu:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Đăng ký</button>
</form>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>
