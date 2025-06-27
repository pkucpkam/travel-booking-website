<?php
require_once '../config.php'; 

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Kết nối không thành công: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$phoneNumber = $_POST['phone'];
$email = $_POST['email'];

$sql_check = "SELECT * FROM users WHERE username='$username'";
$result_check = mysqli_query($conn, $sql_check);
if (mysqli_num_rows($result_check) > 0) {
    // Nếu username đã tồn tại, hiển thị thông báo cảnh báo
    echo "<script>alert('Username đã tồn tại. Vui lòng chọn một username khác.')</script>";
} else {
    // Nếu username chưa tồn tại, thêm người dùng mới vào cơ sở dữ liệu
    $sql_add = "INSERT INTO users (username, password, name, phoneNumber, email) VALUES ('$username', '$password', '$name', '$phoneNumber', '$email')";
    if (mysqli_query($conn, $sql_add)) {
        echo "<script>alert('Thêm người dùng thành công.'); window.location.href = 'admin.html'; </script>";
    } else {
        echo "Lỗi: " . $sql_add . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
