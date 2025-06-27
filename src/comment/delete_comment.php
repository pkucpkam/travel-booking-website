<?php
require_once '../config.php';
if(isset($_POST['commentID'])) {
    $commentID = $_POST['commentID'];

    
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM comments WHERE commentID = '$commentID'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error"));
    }

    $conn->close();
} else {
    echo json_encode(array("status" => "error"));
}
?>
