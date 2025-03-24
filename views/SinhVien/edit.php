<?php include_once 'views/shares/header.php'; ?>

<h1>Chỉnh sửa sinh viên</h1>

<form action="index.php?action=update_student" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="MaSV"  class="form-label">Mã Sinh Viên</label>
        <input type="text" class="form-control" id="MaSV" name="MaSV" 
        value="<?php echo isset($idSV) ? htmlspecialchars($idSV) : ''; ?>" disabled>
    </div>

    <div class="mb-3">
        <label for="HoTen" class="form-label">Họ và Tên</label>
        <input type="text" class="form-control" id="HoTen" name="HoTen" required>
    </div>

    <div class="mb-3">
        <label for="GioiTinh" class="form-label">Giới tính</label>
        <input type="text" class="form-control" id="GioiTinh" name="GioiTinh" required>
    </div>

    <div class="mb-3">
        <label for="NgaySinh" class="form-label">Ngày Sinh</label>
        <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" required>
    </div>

    <div class="mb-3">
        <label for="MaNganh" class="form-label">Mã Ngành</label>
        <select class="form-select" id="MaNganh" name="MaNganh">
            <?php 
            while ($nganh = $nganhHocs->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $nganh['MaNganh'] . "'>" . htmlspecialchars($nganh['TenNganh']) . "</option>";
            }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="Hinh" class="form-label">Ảnh Đại Diện</label>
        <input type="file" class="form-control" id="Hinh" name="Hinh" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
    <a href="index.php?action=students" class="btn btn-secondary">Quay Lại</a>
</form>

<?php include_once 'views/shares/footer.php'; ?>
