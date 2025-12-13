<?php require 'app/views/layouts/header.php'; ?>
<?php require 'app/views/layouts/sidebar.php'; ?>

<div class="content">
    <h2>Chào mừng giảng viên: <?= $_SESSION['user']['fullname'] ?></h2>
</div>

<?php require 'app/views/layouts/footer.php'; ?>