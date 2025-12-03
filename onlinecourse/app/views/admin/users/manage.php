<?php require __DIR__ . '/../../../layouts/header.php'; ?>

<h2>Quản lý người dùng</h2>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Tên đăng nhập</th>
        <th>Email</th>
        <th>Quyền</th>
        <th>Hành động</th>
    </tr>

    <?php foreach ($users as $u): ?>
    <tr>
        <td><?= $u['id'] ?></td>
        <td><?= htmlspecialchars($u['username']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>

        <td>
            <?= $u['role'] == 2 ? "Admin" : "User" ?>
        </td>

        <td>
            <?php if ($u['role'] == 1): ?>
                <a href="/?route=admin.changeRole&id=<?= $u['id'] ?>&role=2">Cấp Admin</a>
            <?php else: ?>
                <a href="/?route=admin.changeRole&id=<?= $u['id'] ?>&role=1">Hạ quyền User</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php require __DIR__ . '/../../../layouts/footer.php'; ?>
