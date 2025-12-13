<!DOCTYPE html>
<html><head><title>Đăng nhập</title>
<link rel="stylesheet" href="assets/css/style.css">
</head><body>
<div class="login-container">
    <h2>Đăng nhập</h2>
    <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Tên đăng nhập" required><br>
        <input type="password" name="password" placeholder="Mật khẩu" required><br>
        <button type="submit">Đăng nhập</button>
    </form>
</div>
</body></html>