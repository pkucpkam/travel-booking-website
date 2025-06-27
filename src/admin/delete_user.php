<?php
require_once '../config.php'; 

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Kết nối không thành công: " . mysqli_connect_error());
}

$username = $_POST['username'];

$sql_check_user = "SELECT * FROM users WHERE username='$username'";
$result_check_user = mysqli_query($conn, $sql_check_user);

if (mysqli_num_rows($result_check_user) > 0) {
    // Nếu người dùng tồn tại trong bảng users, tiến hành xóa
    // Kiểm tra xem người dùng có tồn tại trong các bảng bookdetail và plan không
    $sql_check_bookdetail = "SELECT * FROM bookdetail WHERE username='$username'";
    $result_check_bookdetail = mysqli_query($conn, $sql_check_bookdetail);

    $sql_check_plan = "SELECT * FROM plan WHERE username='$username'";
    $result_check_plan = mysqli_query($conn, $sql_check_plan);

    $sql_check_comments = "SELECT * FROM comments WHERE username='$username'";
    $result_check_comments = mysqli_query($conn, $sql_check_comments);

    if (mysqli_num_rows($result_check_bookdetail) > 0 || mysqli_num_rows($result_check_plan) > 0 || mysqli_num_rows($result_check_comments) >0) {
        // Nếu người dùng tồn tại trong bảng bookdetail hoặc plan, tiến hành xóa
        if (mysqli_num_rows($result_check_bookdetail) > 0) {
            $sql_delete_bookdetail = "DELETE FROM bookdetail WHERE username='$username'";
            if (!mysqli_query($conn, $sql_delete_bookdetail)) {
                die("Lỗi khi xóa dữ liệu từ bảng bookdetail: " . mysqli_error($conn));
            }
        }

        if (mysqli_num_rows($result_check_plan) > 0) {
            $sql_delete_plan = "DELETE FROM plan WHERE username='$username'";
            if (!mysqli_query($conn, $sql_delete_plan)) {
                die("Lỗi khi xóa dữ liệu từ bảng plan: " . mysqli_error($conn));
            }
        }

        if (mysqli_num_rows($result_check_comments) > 0) {
            $sql_delete_comments = "DELETE FROM comments WHERE username='$username'";
            if (!mysqli_query($conn, $sql_delete_comments)) {
                die("Lỗi khi xóa dữ liệu từ bảng comments: " . mysqli_error($conn));
            }
        }

        // Xóa người dùng từ bảng users
        $sql_delete_user = "DELETE FROM users WHERE username='$username'";
        if (mysqli_query($conn, $sql_delete_user)) {
            echo "<script>alert('Người dùng đã được xóa thành công.'); window.location.href = 'admin.html';</script>";
        } else {
            echo "Lỗi khi xóa người dùng: " . mysqli_error($conn);
        }
    } else {
        $sql_delete_user = "DELETE FROM users WHERE username='$username'";
        if (mysqli_query($conn, $sql_delete_user)) {
            echo "<script>alert('Người dùng đã được xóa thành công.'); window.location.href = 'admin.html';</script>";
        } else {
            echo "Lỗi khi xóa người dùng: " . mysqli_error($conn);
        }
    }
} else {
    echo "<script>alert('Người dùng không tồn tại trong hệ thống.'); window.location.href = 'admin.html';</script>";
}

mysqli_close($conn);
?>
