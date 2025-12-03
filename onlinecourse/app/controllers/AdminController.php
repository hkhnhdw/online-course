<?php
require_once __DIR__ . '/../models/User.php';

class AdminController
{
    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 2) {
            echo "Không có quyền truy cập";
            exit;
        }
    }

    public function users()
    {
        $model = new User();
        $users = $model->getAll();

        require __DIR__ . '/../views/admin/users/manage.php';
    }

    public function changeRole()
    {
        $id = $_GET['id'];
        $role = $_GET['role'];

        $model = new User();
        $model->updateRole($id, $role);

        header("Location: /?route=admin.users");
        exit;
    }
}
?>