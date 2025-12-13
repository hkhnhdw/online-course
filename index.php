<?php
session_start();
require_once 'config/Database.php';
require_once 'app/controllers/AuthController.php';

$auth = new AuthController();

// Tạo controller chung cho instructor (nếu đã đăng nhập và là giảng viên)
if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 1) {
    require_once 'app/controllers/InstructorController.php';
    $instructor = new InstructorController();
}

$page = $_GET['page'] ?? '';

if (!isset($_SESSION['user'])) {
    $auth->login();  
    exit();
}

if ($page === 'logout') {
    $auth->logout();
    exit();
}

// Kiểm tra role giảng viên
if ($_SESSION['user']['role'] != 1) {
    die("Bạn không có quyền truy cập khu vực này!");
}

switch ($page) {
    case 'dashboard':
        $instructor->dashboard();
        break;

    case 'courses':
        // Xử lý lưu/sửa khóa học
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $instructor->courseSave();
            exit();
        }
        // Xử lý xóa khóa học
        if (isset($_GET['delete'])) {
            $instructor->courseDelete($_GET['delete']);
            exit();
        }
        $instructor->courses();
        break;

    case 'lessons':
        // Bắt buộc phải có course_id
        if (!isset($_GET['course_id']) || !is_numeric($_GET['course_id'])) {
            echo "<h3 style='color:red;'>Lỗi: Vui lòng chọn khóa học trước!</h3>";
            echo '<a href="index.php?page=courses">← Quay lại Quản lý Khóa học</a>';
            exit();
        }

        $course_id = (int)$_GET['course_id'];

        // Xử lý lưu/sửa bài học
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $instructor->lessonSave();
            exit();
        }

        // Xử lý xóa bài học
        if (isset($_GET['delete'])) {
            $instructor->lessonDelete($_GET['delete'], $course_id);
            exit();
        }

        // Hiển thị trang lessons
        $instructor->lessons($course_id);
        break;

    default:
        // Trang mặc định là dashboard
        $instructor->dashboard();
        break;
}
?>