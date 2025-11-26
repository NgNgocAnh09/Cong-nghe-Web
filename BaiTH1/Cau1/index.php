<?php
$flowers=[
    [
        'id'=>1,
        'ten_hoa'=> 'Hoa đỗ quyên',
        'mo_ta'=> 'Hoa đỗ quyên là biểu tượng của tình yêu đôi lứa, tình nghĩa vợ chồng chung thủy, son sắt',
        'anh' => 'doquyen.jpg'
    ],
     [
        'id'=>2,
        'ten_hoa'=> 'Hoa hải đường',
        'mo_ta'=> 'Hoa thường nở vào dịp Tết Nguyên Đán, với nhiều màu sắc như đỏ, hồng, trắng, vàng và có cả hoa đơn và hoa kép. Cánh hoa mềm mại xếp tầng ôm lấy nhụy hoa vàng. ',
        'anh' => 'haiduong.jpg'
    ],
     [
        'id'=>1,
        'ten_hoa'=> 'Hoa mai',
        'mo_ta'=> 'Hoa mai được xem là biểu tượng của sự may mắn và tài lộc. Với sắc vàng tươi sáng, hoa mai mang ý nghĩa của sự phồn vinh, thịnh vượng và hạnh phúc',
        'anh' => 'mai.jpg'
    ],
     [
        'id'=>1,
        'ten_hoa'=> 'Hoa tường vy',
        'mo_ta'=> 'Hoa tường vi là loài hoa mang ý nghĩa cát tường, thường được trồng để thu hút may mắn, tài lộc và tạo không gian tươi đẹp',
        'anh' => 'tuongvy.jpg'
    ]
     ];

     $role = isset($_GET['role']) && $_GET['role'] === 'admin' ? 'admin' : 'guest';
$is_admin = $role === 'admin';

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Các Loài Hoa - Chế độ <?= $is_admin ? 'Quản Trị' : 'Khách' ?></title>
   
    
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="container-content mx-auto p-4 md:p-8">
        <header class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-green-700 mb-2">
                14 loài hoa tuyệt đẹp thích hợp trồng để khoe hương sắc dịp Xuân-Hè
            </h1>
            <p class="text-lg text-gray-500">
                Chế độ hiện tại: 
                <span class="font-semibold text-red-500"><?= $is_admin ? 'QUẢN TRỊ' : 'NGƯỜI DÙNG KHÁCH' ?></span>
            </p>
            <div class="mt-4 space-x-4">
                <a href="index.php?role=guest" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                    Chuyển sang chế độ Khách
                </a>
                <a href="index.php?role=admin" class="text-sm font-medium text-red-600 hover:text-red-800">
                    Chuyển sang chế độ Quản trị
                </a>
            </div>
        </header>

        <?php if ($is_admin): ?>

            <div class="bg-white p-6 shadow-xl rounded-lg">
                <h2 class="text-2xl font-bold mb-4 text-gray-700">Bảng Quản Lý Dữ Liệu Các Loài Hoa</h2>
                <div class="text-right mb-4">
                    <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                        + Thêm Bài Viết Mới 
                    </button>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="admin-table min-w-full divide-y divide-gray-200 border border-gray-100">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="w-1/12">ID</th>
                                <th class="w-2/12">Ảnh</th>
                                <th class="w-2/12">Tên Hoa</th>
                                <th class="w-5/12">Mô Tả</th>
                                <th class="w-2/12">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($flowers as $flower): ?>
                                <tr>
                                    <td class="font-mono text-sm"><?= htmlspecialchars($flower['id']) ?></td>
                                    <td>
                                        <img src="images/<?= htmlspecialchars($flower['anh']) ?>" 
                                             alt="<?= htmlspecialchars($flower['ten_hoa']) ?>" 
                                             class="w-20 h-20 object-cover rounded-md shadow-sm"
                                    </td>
                                    <td class="font-semibold text-lg text-indigo-600">
                                        <?= htmlspecialchars($flower['ten_hoa']) ?>
                                    </td>
                                    <td class="text-sm text-gray-600">
                                        <?= htmlspecialchars($flower['mo_ta']) ?>
                                    </td>
                                    <td>
                                        <div class="space-y-2">
                                            <button class="w-full text-xs bg-yellow-400 hover:bg-yellow-500 text-white py-1 px-2 rounded">
                                                Sửa 
                                            </button>
                                            <button class="w-full text-xs bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded">
                                                Xóa
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php else: ?>
            
            <div class="space-y-12">
                <?php foreach ($flowers as $index => $flower): ?>
                    <article class="bg-white p-6 shadow-lg rounded-xl border-t-4 border-green-500">
                        <h2 class="text-2xl font-bold text-green-600 mb-3">
                            <span class="text-red-500 mr-2">#<?= $index + 1 ?>.</span> 
                            <?= htmlspecialchars($flower['ten_hoa']) ?>
                        </h2>
                        
                        <figure class="mb-4">
                            <img src="images/<?= htmlspecialchars($flower['anh']) ?>" 
                                 alt="Hình ảnh <?= htmlspecialchars($flower['ten_hoa']) ?>" 
                                 class="flower-image"
                            
                        </figure>
                        
                        <p class="text-base leading-relaxed text-gray-700">
                            <?= htmlspecialchars($flower['mo_ta']) ?>
                        </p>
                    </article>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </div>
</body>
</html>