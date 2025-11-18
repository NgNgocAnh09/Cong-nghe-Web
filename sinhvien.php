<!DOCTYPE html> 
<html lang="vi"> 
<head> 
<meta charset="UTF-8"> 
<title>PHT Chương 2 - PHP Căn Bản</title> 
</head> 
<body> 
<h1>Kết quả PHP Căn Bản</h1> 
<?php 

     $ho_ten = "Nguyễn Thị Ngọc Ánh";
     $diem_tb = 9.5 ; 
     $co_di_hoc_chuyen_can = true;  
 
    echo "Họ tên: $ho_ten", "<br>", "Điểm: $diem_tb";
    echo "<br>";
     
    if ($diem_tb >= 8.5 && $co_di_hoc_chuyen_can == true) { echo "Xếp loại: Giỏi";}
    else if ($diem_tb >= 6.5 && $co_di_hoc_chuyen_can == true) { echo "Xếp loại: Khá"; }
    else if ($diem_tb >= 5.0 && $co_di_hoc_chuyen_can == true) { echo "Xếp loại: Trung bình";}
    else {echo "Xếp loại: Yếu (Cần cố gắng thêm!)"; }

echo "<br>";
function chaoMung() 
	{ echo "Chúc mừng bạn đã hoàn thành PHT";}
  
 chaoMung();
 
    ?>
    </body> 
</html> 

