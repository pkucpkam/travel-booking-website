<?php 
 session_start();

require_once '../config.php'; 

 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (isset($_SESSION['username'])) {
    $loginButtonStyle = "none";
    $logoutButtonStyle = "block";
} else {
    $loginButtonStyle = "block";
    $logoutButtonStyle = "none";
}

 $currentUsername = $_SESSION['username'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Comment</title>
    <style>
        .delete-comment {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 5px;
            margin-left: 10px;
        }

        .delete-comment:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>

    <?php
   
    // Xử lý yêu cầu AJAX
    if (isset($_POST['placeID'])) {

        $placeID = $_POST['placeID'];
        // Truy vấn cơ sở dữ liệu để lấy các đánh giá dựa trên placeID
        $sql = "SELECT comments.content, comments.username, users.name FROM comments JOIN users ON comments.username = users.username WHERE comments.placeID = '$placeID'";
        $result = $conn->query($sql);

        // Kiểm tra nếu có kết quả trả về
        if ($result->num_rows > 0) {
            // Hiển thị các đánh giá dưới dạng HTML
            while ($row = $result->fetch_assoc()) {
                // Bổ sung một giá trị dấu nháy đơn cho tên comment để tránh lỗi khi sử dụng trong JavaScript
                $commentContent = addslashes($row["content"]);
                echo '<div class="comment">';
                echo '<div class="user-info">';
                echo '<p class="name-comment"><strong>Name: </strong><span class="username-comments">' . $row["name"] . '</span></p>';
                echo '</div>';
                echo '<div class="comment-content">';
                echo '<p><strong>Comment: </strong>' . $row["content"] . '</p>';
                // Kiểm tra nếu người dùng hiện tại là chủ sở hữu của comment, hiển thị nút delete
                if ($currentUsername == $row["username"]) {
                    // Truyền placeID và nội dung comment cho hàm JavaScript deleteComment khi người dùng nhấn nút "Delete"
                    echo '<button onclick="test()" class="delete-comment" data-place-id="' . $placeID . '" data-comment-content="' . $commentContent . '">Delete</button>';
                }
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p class="no-comments">No comments available for this place.</p>';
        }
    }

    "
    function test() {
        console.log(;Test function is called.'); 
    }
    ";

    $conn->close();
    ?>

    <script>
        // Hàm JavaScript để xóa bình luận
        function deleteComment(placeID, commentContent) {
            console.log("Deleting comment: ", placeID, commentContent); 
            // Tạo một yêu cầu AJAX để gửi thông tin đến tệp PHP xử lý
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    if (response.status === "success") {
                        location.reload();
                    } else {
                        alert('Error deleting comment. Please try again later.');
                    }
                }
            };
            xhttp.open("POST", "../comment/delete_comment.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            // Truyền placeID và commentContent trong yêu cầu POST
            xhttp.send("placeID=" + placeID + "&commentContent=" + commentContent);
        }
        

        window.onload = function () {
            // Gán sự kiện click cho tất cả các nút "Delete" có lớp delete-comment
            var deleteButtons = document.querySelectorAll('.delete-comment');
            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    // Lấy placeID và commentContent từ thuộc tính data
                    var placeID = this.getAttribute('data-place-id');
                    var commentContent = this.getAttribute('data-comment-content');
                    deleteComment(placeID, commentContent);
                });
            });

            test();
        };


        // Gán sự kiện click cho tất cả các nút "Delete" có lớp delete-comment
        var deleteButtons = document.querySelectorAll('.delete-comment');
        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Lấy placeID và commentContent từ thuộc tính data
                var placeID = this.getAttribute('data-place-id');
                var commentContent = this.getAttribute('data-comment-content');
                deleteComment(placeID, commentContent);
            });
        });


    </script>

</body>

</html>