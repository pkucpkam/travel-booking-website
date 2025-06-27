<?php
require_once '../config.php'; 

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Kết nối không thành công: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy ID của địa điểm cần xóa
    $placeID_to_delete = $_POST["deletePlaceID"];

    $tables_to_check = array("comments", "bookdetail", "hotdeals");

    foreach ($tables_to_check as $table) {
        $check_query = "SELECT * FROM $table WHERE placeID='$placeID_to_delete'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $delete_query = "DELETE FROM $table WHERE placeID='$placeID_to_delete'";
            if (!mysqli_query($conn, $delete_query)) {
                echo "Lỗi khi xóa bản ghi từ bảng $table: " . mysqli_error($conn);
            }
        }
    }
    // Sau khi xóa dữ liệu từ các bảng liên quan,  xóa địa điểm từ bảng place
    $delete_place_query = "DELETE FROM place WHERE placeID='$placeID_to_delete'";
    if (mysqli_query($conn, $delete_place_query)) {
    } else {
        echo "Lỗi khi xóa địa điểm: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>