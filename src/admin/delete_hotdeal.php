<?php
require_once '../config.php'; 

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Kết nối không thành công: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $placeID = $_POST['deleteHotDealID'];

    $sql = "DELETE FROM hotdeals WHERE placeID='$placeID'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Xóa hotdeals thành công.'); window.location.href = 'admin.html'; </script>";
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>