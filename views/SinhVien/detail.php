<?php include_once 'views/shares/header.php'; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h1>Thông tin sinh viên: <?php echo htmlspecialchars($this->sinhVienModel->HoTen); ?></h1>
        <div>
            <a href="index.php?action=edit_student&id=<?php echo $this->sinhVienModel->id; ?>" class="btn btn-warning">Sửa</a>
            <a href="index.php?action=students" class="btn btn-secondary">Quay Lại</a>
        </div>
    </div>
    <div class="card-body">
        <h5 class="card-title">Chi tiết sinh viên</h5>
        <p class="card-text">
            <strong>Mã SV:</strong> <?php echo htmlspecialchars($this->sinhVienModel->MaSV); ?><br>
            <strong>Họ Tên:</strong> <?php echo htmlspecialchars($this->sinhVienModel->HoTen); ?><br>
            <strong>Giới Tính:</strong> <?php echo htmlspecialchars($this->sinhVienModel->GioiTinh); ?><br>
            <strong>Ngày Sinh:</strong> <?php echo date('d/m/Y', strtotime($this->sinhVienModel->NgaySinh)); ?><br>
            <strong>Hình :</strong> <img src="public/<?php echo htmlspecialchars($this->sinhVienModel->Hinh); ?>" alt="Ảnh sinh viên" width="150"><br>
            <strong>Mã Ngành:</strong> <?php echo htmlspecialchars($this->sinhVienModel->MaNganh); ?><br>
        </p>
    </div>
</div>

<?php include_once 'views/shares/footer.php'; ?>