<?php
// Start session
session_start();

// Include database and object files
require_once 'config/database.php';
require_once 'controllers/SinhVienController.php';
require_once 'controllers/HocPhanController.php';

// Khởi tạo database
$database = new Database();
$db = $database->getConnection();

// Tạo đối tượng controllers
$sinhVienController = new SinhVienController($db);
$hocPhanController = new HocPhanController($db);


// Xác định action (mặc định là 'students')
$action = isset($_GET['action']) ? $_GET['action'] : 'students';

// Điều hướng theo action
switch($action) {
    case 'students': 
        $sinhVienController->index();
        break;
    case 'show_student': 
        $sinhVienController->show();
        break;
    case 'create_student': 
        $sinhVienController->create();
        break;
    case 'edit_student': 
        $sinhVienController->edit();
        break;
    case 'store_student': // Xử lý thêm sinh viên
        $sinhVienController->store();
        break;
    case 'update_student': 
        $sinhVienController->update();
        break;
    case 'delete_student': // Xử lý xóa sinh viên
        $sinhVienController->delete();
        break;
    case 'hocphan': // Xử lý xóa sinh viên
        $hocPhanController->index();
        break;
    default:
        $studentController->index(); // Nếu action không hợp lệ, vào trang sinh viên
        break;
}
?>
