<?php

require_once 'app/models/Course.php';
require_once 'app/models/Lesson.php';

class InstructorController {
    private $course;
    private $lesson;

    public function __construct() {
        // Kiểm tra đăng nhập và role giảng viên
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
            header("Location: index.php");
            exit();
        }

        $this->course = new Course();
        $this->lesson = new Lesson();
    }

    // Dashboard
    public function dashboard() {
        $courses = $this->course->getByInstructor($_SESSION['user']['id']);
        require 'app/views/instructor/dashboard.php';
    }

    // ========== QUẢN LÝ KHÓA HỌC ==========
    public function courses() {
        $courses = $this->course->getByInstructor($_SESSION['user']['id']);
        $categories = $this->course->getAllCategories();
        require 'app/views/instructor/courses.php';
    }

    public function courseSave() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'title'        => trim($_POST['title']),
                'description'  => $_POST['description'] ?? '',
                'category_id'  => $_POST['category_id'],
                'price'        => $_POST['price'] ?? 0,
                'image'        => '',
                'instructor_id'=> $_SESSION['user']['id']
            ];

            // Xử lý upload ảnh
            if (!empty($_FILES['image']['name'])) {
                $target_dir = "assets/uploads/courses/";
                $target_file = $target_dir . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                $data['image'] = $_FILES['image']['name'];
            }

            if (!empty($_POST['id'])) {
                $this->course->update($_POST['id'], $data);
            } else {
                $this->course->create($data);
            }
        }
        header("Location: index.php?page=courses");
        exit();
    }

    public function courseDelete($id) {
        $this->course->delete($id, $_SESSION['user']['id']);
        header("Location: index.php?page=courses");
        exit();
    }

    // ========== QUẢN LÝ BÀI HỌC (của một khóa cụ thể) ==========
    public function lessons($course_id) {
        $course = $this->course->find($course_id, $_SESSION['user']['id']);
        if (!$course) {
            die("Khóa học không tồn tại hoặc bạn không có quyền truy cập!");
        }

        $lessons = $this->lesson->getByCourse($course_id);
        require 'app/views/instructor/lessons.php';
    }

    public function lessonSave() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'course_id'  => $_POST['course_id'],
                'title'      => trim($_POST['title']),
                'content'    => $_POST['content'] ?? '',
                'video_url'  => $_POST['video_url'] ?? '',
                'order'      => $_POST['order'] ?? 0
            ];

            if (!empty($_POST['id'])) {
                $this->lesson->update($_POST['id'], $data);
            } else {
                $this->lesson->create($data);
            }
        }
        header("Location: index.php?page=lessons&course_id=" . $_POST['course_id']);
        exit();
    }

    public function lessonDelete($id, $course_id) {
        // Kiểm tra quyền trước khi xóa (an toàn hơn)
        $course = $this->course->find($course_id, $_SESSION['user']['id']);
        if ($course) {
            $this->lesson->delete($id, $course_id);
        }
        header("Location: index.php?page=lessons&course_id=$course_id");
        exit();
    }
}
?>