<?php
require_once '../config.php'; 

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Lấy dữ liệu từ form chỉnh sửa
$edit_username = $_POST['edit-username'];
$edit_name = $_POST['edit-name'];
$edit_phone = $_POST['edit-phone'];
$edit_email = $_POST['edit-email'];

// Cập nhật thông tin người dùng
$sql = "UPDATE users SET name='$edit_name', phoneNumber='$edit_phone', email='$edit_email' WHERE username='$edit_username'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Thông tin người dùng đã được cập nhật thành công.'); window.location.href = 'admin.html';</script>";

} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
