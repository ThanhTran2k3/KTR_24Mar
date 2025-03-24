<?php
class HocPhanController {
    private $hocPhanModel;

    public function __construct($db) {
        require_once 'models/HocPhanModel.php';
        $this->hocPhanModel = new HocPhanModel($db);
    }

    // Hiển thị danh sách sinh viên
    public function index() {
        $stmt = $this->hocPhanModel->read();
        include_once 'views/hocphan/index.php';
    }

    
}
?>
