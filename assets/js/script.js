function openModal() {
    document.getElementById('courseModal').style.display = 'block';
    document.getElementById('modalTitle').textContent = 'Thêm khóa học';
    document.querySelector('#courseModal form').reset();
    document.getElementById('course_id').value = '';
}

function closeModal() {
    document.getElementById('courseModal').style.display = 'none';
}

function editCourse(course) {
    document.getElementById('modalTitle').textContent = 'Sửa khóa học';
    document.getElementById('course_id').value = course.id;
    document.getElementById('title').value = course.title;
    document.getElementById('description').value = course.description;
    document.querySelector('[name="category_id"]').value = course.category_id;
    document.querySelector('[name="price"]').value = course.price;
    document.getElementById('courseModal').style.display = 'block';
}

window.onclick = function(e) {
    if (e.target.classList.contains('modal')) closeModal();
}

function openLessonModal() {
    document.getElementById('lessonModal').style.display = 'block';
    document.getElementById('lessonModalTitle').textContent = 'Thêm bài học mới';
    document.querySelector('#lessonModal form').reset();
    document.getElementById('lesson_id').value = '';
}

function closeLessonModal() {
    document.getElementById('lessonModal').style.display = 'none';
}

function editLesson(lesson) {
    document.getElementById('lessonModalTitle').textContent = 'Sửa bài học';
    document.getElementById('lesson_id').value = lesson.id;
    document.getElementById('lesson_title').value = lesson.title;
    document.getElementById('lesson_content').value = lesson.content || '';
    document.getElementById('lesson_video_url').value = lesson.video_url || '';
    document.getElementById('lesson_order').value = lesson.order || 0;
    document.getElementById('lessonModal').style.display = 'block';
}

// Đóng modal khi click bên ngoài
window.addEventListener('click', function(e) {
    const courseModal = document.getElementById('courseModal');
    const lessonModal = document.getElementById('lessonModal');
    if (e.target === courseModal) closeModal();
    if (e.target === lessonModal) closeLessonModal();
});

// Modal Bài học
function openLessonModal() {
    document.getElementById('lessonModal').style.display = 'block';
    document.getElementById('lessonModalTitle').textContent = 'Thêm bài học mới';
    document.querySelector('#lessonModal form').reset();
    document.getElementById('lesson_id').value = '';
    document.getElementById('lesson_order').value = '0';
}

function closeLessonModal() {
    document.getElementById('lessonModal').style.display = 'none';
}

function editLesson(lesson) {
    document.getElementById('lessonModalTitle').textContent = 'Sửa bài học';
    document.getElementById('lesson_id').value = lesson.id;
    document.getElementById('lesson_title').value = lesson.title;
    document.getElementById('lesson_content').value = lesson.content || '';
    document.getElementById('lesson_video_url').value = lesson.video_url || '';
    document.getElementById('lesson_order').value = lesson.order || 0;
    document.getElementById('lessonModal').style.display = 'block';
}

// Đóng modal khi click bên ngoài
window.onclick = function(event) {
    const modal = document.getElementById('lessonModal');
    if (event.target == modal) {
        closeLessonModal();
    }
    const courseModal = document.getElementById('courseModal');
    if (courseModal && event.target == courseModal) {
        courseModal.style.display = 'none';
    }
}