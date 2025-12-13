<?php require 'app/views/layouts/header.php'; ?>
<?php require 'app/views/layouts/sidebar.php'; ?>

<div class="content">
    <h2>Quản lý Bài học - Khóa: <?= htmlspecialchars($course['title']) ?></h2>
    <p><a href="index.php?page=courses">&larr; Quay lại danh sách khóa học</a></p>

    <button onclick="openLessonModal()">Thêm bài học mới</button>

    <table border="1" width="100%" style="margin-top: 20px; border-collapse: collapse;">
        <thead style="background: #f0f0f0;">
            <tr>
                <th width="5%">STT</th>
                <th width="40%">Tiêu đề bài học</th>
                <th width="10%">Thứ tự</th>
                <th width="20%">Video URL</th>
                <th width="25%">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($lessons)): ?>
                <tr>
                    <td colspan="5" style="text-align:center; padding:20px;">Chưa có bài học nào. Hãy thêm bài học đầu tiên!</td>
                </tr>
            <?php else: ?>
                <?php foreach ($lessons as $i => $les): ?>
                <tr>
                    <td style="text-align:center;"><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($les['title']) ?></td>
                    <td style="text-align:center;"><?= $les['order'] ?? ($i + 1) ?></td>
                    <td><?= $les['video_url'] ? '<span style="color:green;">Có</span>' : '<span style="color:red;">Không</span>' ?></td>
                    <td style="text-align:center;">
                        <button onclick='editLesson(<?= json_encode($les) ?>)' style="margin:2px;">Sửa</button>
                        <a href="index.php?page=lessons&course_id=<?= $course['id'] ?>&delete=<?= $les['id'] ?>"
                           onclick="return confirm('Bạn chắc chắn muốn xóa bài học này?')"
                           style="color:red; margin:2px;">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div id="lessonModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeLessonModal()">&times;</span>
        <h2 id="lessonModalTitle">Thêm bài học mới</h2>
        
        <form method="POST">
            <input type="hidden" name="id" id="lesson_id">
            <input type="hidden" name="course_id" value="<?= $course['id'] ?>">

            <label>Tiêu đề bài học *</label><br>
            <input type="text" name="title" id="lesson_title" required style="width:100%; padding:8px; margin:8px 0;"><br>

            <label>Nội dung</label><br>
            <textarea name="content" id="lesson_content" rows="6" style="width:100%; padding:8px; margin:8px 0;"></textarea><br>

            <label>Link video bài giảng</label><br>
            <input type="url" name="video_url" id="lesson_video_url" placeholder="https://..." style="width:100%; padding:8px; margin:8px 0;"><br>

            <label>Thứ tự hiển thị</label><br>
            <input type="number" name="order" id="lesson_order" value="0" style="width:100%; padding:8px; margin:8px 0;"><br><br>

            <button type="submit" style="padding:10px 20px; background:#3498db; color:white; border:none;">Lưu bài học</button>
        </form>
    </div>
</div>

<script src="assets/js/script.js"></script>
<?php require 'app/views/layouts/footer.php'; ?>