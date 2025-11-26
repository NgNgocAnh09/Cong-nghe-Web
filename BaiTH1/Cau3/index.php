<?php
$csv_file = '65HTTT_Danh_sach_diem_danh.csv';
$data = [];
$headers = []; 

if (($handle = fopen($csv_file, "r")) !== FALSE) {
    if (($headers = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $headers = array_map('trim', $headers);
    }
    
    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if (count($row) === count($headers)) {
            $row = array_map('trim', $row);
            $data[] = $row;
        }
    }
    
    fclose($handle);
} else {
    $error_message = "Lỗi: Không thể mở hoặc tìm thấy tệp tin CSV: " . htmlspecialchars($csv_file);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hiển Thị Danh Sách Tài Khoản từ CSV</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        h1 { text-align: center; color: #007bff; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .error { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <h1>Danh Sách Tài Khoản</h1>

    <?php if (isset($error_message)): ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php elseif (empty($data) && empty($headers)): ?>
        <p>Tệp CSV trống hoặc không có dữ liệu hợp lệ.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <?php foreach ($headers as $header): ?>
                        <th><?php echo htmlspecialchars($header); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <?php foreach ($row as $cell): ?>
                            <td><?php echo htmlspecialchars($cell); ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>