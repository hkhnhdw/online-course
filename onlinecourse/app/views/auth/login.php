<?php require __DIR__ . '/../../views/layouts/header.php'; ?>

<h2>Đăng nhập</h2>

<?php if (!empty($_SESSION['flash_error'])): ?>
<div style="color:red"><?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?></div>
<?php endif; ?>

<form method="POST" action="/?route=auth.login.post">
    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Mật khẩu:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Đăng nhập</button>
</form>

<?php require __DIR__ . '/../../views/layouts/footer.php'; ?>
