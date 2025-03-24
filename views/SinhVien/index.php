<?php include_once 'views/shares/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Trang sinh viên</h1>
    <a href="index.php?action=create_student" class="btn btn-primary">Thêm sinh viên</a>
</div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>MaSV/th>
            <th>Hoten</th>
            <th>GioiTinh</th>
            <th>NgaySinh</th>
            <th>Hinh</th>
            <th>MaNganh/th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['MaSV']); ?></td>
                <td><?php echo htmlspecialchars($row['HoTen']); ?></td>
                <td><?php echo htmlspecialchars($row['GioiTinh']); ?></td>
                <td><?php echo date('d/m/Y', strtotime($row['NgaySinh'])); ?></td>
                <td>
                    <img src="public/<?php echo htmlspecialchars($row['Hinh']); ?>" alt="Hình ảnh" width="100">
                </td>

                <td><?php echo htmlspecialchars($row['MaNganh']); ?></td>
                <td>
                    <a href="index.php?action=show_student&MaSV=<?php echo $row['MaSV']; ?>" class="btn btn-info btn-sm">Xem</a>
                    <a href="index.php?action=edit_student&MaSV=<?php echo $row['MaSV']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="index.php?action=delete_student&MaSV=<?php echo $row['MaSV']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include_once 'views/shares/footer.php'; ?>
