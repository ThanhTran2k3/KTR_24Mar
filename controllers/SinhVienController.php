<?php
class SinhVienController {
    private $sinhVienModel;
    private $nganhHocModel;

    public function __construct($db) {
        require_once 'models/SinhVienModel.php';
        require_once 'models/NganhHocModel.php';
        $this->sinhVienModel = new SinhVienModel($db);
        $this->nganhHocModel = new NganhHocModel($db);
    }

    // Hiển thị danh sách sinh viên
    public function index() {
        $stmt = $this->sinhVienModel->read();
        include_once 'views/sinhvien/index.php';
    }

    // Hiển thị form thêm sinh viên
    public function create() {
        $nganhHocs = $this->nganhHocModel->read();
        include_once 'views/sinhvien/create.php';
    }

    // Lưu sinh viên mới
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['MaSV']) && !empty($_POST['HoTen'])) {
            $this->sinhVienModel->MaSV = $_POST['MaSV'];
            $this->sinhVienModel->HoTen = $_POST['HoTen'];
            $this->sinhVienModel->GioiTinh = $_POST['GioiTinh'];
            $this->sinhVienModel->NgaySinh = $_POST['NgaySinh'];
            $this->sinhVienModel->MaNganh = $_POST['MaNganh'];

            if (!empty($_FILES['Hinh']['name'])) {
                $targetDir = "public/content/"; // Thư mục lưu ảnh
                $fileName = time() . "_" . basename($_FILES["Hinh"]["name"]); // Đổi tên file tránh trùng lặp
                $targetFilePath = $targetDir . $fileName; // Đường dẫn đầy đủ
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
            

                $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $targetFilePath)) {
                        $this->sinhVienModel->Hinh = "Content/images/" . $fileName;
                    } else {
                        echo "❌ Lỗi khi tải ảnh lên.";
                        return;
                    }
                } else {
                    echo "❌ Chỉ chấp nhận định dạng JPG, JPEG, PNG, GIF.";
                    return;
                }
            }
            


            if ($this->sinhVienModel->create()) {
                header("Location: index.php?action=students");
                exit;
            } else {
                $nganhHocs = $this->nganhHocModel->read();
                include_once 'views/sinhvien/create.php';
            }
        } else {
            $nganhHocs = $this->nganhHocModel->read();
            include_once 'views/sinhvien/create.php';
        }
    }

    // Hiển thị chi tiết một sinh viên
    public function show() {
        if (isset($_GET['MaSV'])) {
            $this->sinhVienModel->MaSV = $_GET['MaSV'];
            if ($this->sinhVienModel->readOne()) {
                include_once 'views/sinhvien/detail.php';
            } else {
                header("Location: index.php?action=students");
                exit;
            }
        } else {
            header("Location: index.php?action=students");
            exit;
        }
    }

    // Hiển thị form chỉnh sửa sinh viên
    public function edit() {
        if (isset($_GET['MaSV'])) {
            $this->sinhVienModel->MaSV = $_GET['MaSV'];
            if ($this->sinhVienModel->readOne()) {
                $nganhHocs = $this->nganhHocModel->read();
                $idSV = $_GET['MaSV'];
                include_once 'views/sinhvien/edit.php';
            } else {
                header("Location: index.php?action=students");
                exit;
            }
        } else {
            header("Location: index.php?action=students");
            exit;
        }
    }

    // Cập nhật thông tin sinh viên
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['MaSV']) && !empty($_POST['HoTen'])) {
            $this->sinhVienModel->MaSV = $_POST['MaSV'];
            $this->sinhVienModel->HoTen = $_POST['HoTen'];
            $this->sinhVienModel->GioiTinh = $_POST['GioiTinh'];
            $this->sinhVienModel->NgaySinh = $_POST['NgaySinh'];
            $this->sinhVienModel->Hinh = $_POST['Hinh'];
            $this->sinhVienModel->MaNganh = $_POST['MaNganh'];

            if (!empty($_FILES['Hinh']['name'])) {
                $targetDir = "public/content/"; // Thư mục lưu ảnh
                $fileName = time() . "_" . basename($_FILES["Hinh"]["name"]); // Đổi tên file tránh trùng lặp
                $targetFilePath = $targetDir . $fileName; // Đường dẫn đầy đủ
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
            

                $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $targetFilePath)) {
                        $this->sinhVienModel->Hinh = "Content/images/" . $fileName;
                    } else {
                        echo "❌ Lỗi khi tải ảnh lên.";
                        return;
                    }
                } else {
                    echo "❌ Chỉ chấp nhận định dạng JPG, JPEG, PNG, GIF.";
                    return;
                }
            }

            
            if ($this->sinhVienModel->update()) {
                header("Location: index.php?action=students");
                exit;
            } else {
                $nganhHocs = $this->nganhHocModel->read();
                include_once 'views/sinhvien/edit.php';
            }
        } else {
            header("Location: index.php?action=students");
            exit;
        }
    }

    // Xóa sinh viên
    public function delete() {
        if (isset($_GET['MaSV'])) {
            $this->sinhVienModel->MaSV = $_GET['MaSV'];
            if ($this->sinhVienModel->delete()) {
                header("Location: index.php?action=students");
                exit;
            } else {
                echo "Không thể xóa sinh viên.";
            }
        } else {
            header("Location: index.php?action=students");
            exit;
        }
    }
}
?>
