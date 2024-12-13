<?php
require_once('php/dbhelp.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['Id'];
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $cccd = $_POST['CCCD'];
    $age = $_POST['Age'];

    $sql = "UPDATE users SET Username = '$username', Email = '$email', CCCD = '$cccd', Age = '$age' WHERE Id = $id";
    if (execute($sql)) {
        echo 'Cập nhật thông tin sinh viên thành công!';
    } else {
        echo 'Có lỗi xảy ra khi cập nhật thông tin.';
    }
    exit();
}
?>
