<?php require 'app/views/layouts/header.php'; ?>
<?php require 'app/views/layouts/sidebar.php'; ?>

<div class="content">
    <h2>Khóa học của tôi</h2>
    <button onclick="openModal()">Thêm khóa học</button>

    <table border="1" width="100%">
        <tr><th>STT</th><th>Tên</th><th>Danh mục</th><th>Giá</th><th>Hành động</th></tr>
        <?php foreach ($courses as $i => $c): ?>
        <tr>
            <td><?= $i+1 ?></td>
            <td><?= htmlspecialchars($c['title']) ?></td>
            <td><?= htmlspecialchars($c['category_name']) ?></td>
            <td><?= number_format($c['price']) ?>đ</td>
            <td>
                <button onclick='editCourse(<?= json_encode($c) ?>)'>Sửa</button>
                <a href="index.php?page=courses&delete=<?= $c['id'] ?>" 
                   onclick="return confirm('Xóa khóa học này?')">Xóa</a>
                <a href="index.php?page=lessons&course_id=<?= $c['id'] ?>">Bài học</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<!-- Modal -->
<div id="courseModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle">Thêm khóa học</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="course_id">
            <input type="text" name="title" id="title" required placeholder="Tên khóa học"><br>
            <textarea name="description" id="description" placeholder="Mô tả"></textarea><br>
            <select name="category_id" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                <?php endforeach; ?>
            </select><br>
            <input type="number" name="price" value="0"><br>
            <input type="file" name="image"><br>
            <button type="submit">Lưu</button>
        </form>
    </div>
</div>

<script src="assets/js/script.js"></script>
<?php require 'app/views/layouts/footer.php'; ?>