<?php include_once 'views/shares/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Danh sách học phần</h1>
    <a href="index.php?action=create_hocphan" class="btn btn-primary">Thêm học phần</a>
</div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Mã HP</th>
            <th>Tên Học Phần</th>
            <th>Số Tín Chỉ</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['MaHP']); ?></td>
                <td><?php echo htmlspecialchars($row['TenHP']); ?></td>
                <td><?php echo htmlspecialchars($row['SoTinChi']); ?></td>
                <td>
                    <a href="index.php?action=register_hocphan&MaHP=<?php echo $row['MaHP']; ?>" class="btn btn-success btn-sm">Đăng ký</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include_once 'views/shares/footer.php'; ?>