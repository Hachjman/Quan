<?php
// Định nghĩa các hằng số cấu hình
if (!defined('HOST')) {
    define('HOST', 'localhost');
}

if (!defined('DATABASE')) {
    define('DATABASE', 'tutorial');
}

if (!defined('USERNAME')) {
    define('USERNAME', 'root');
}

if (!defined('PASSWORD')) {
    define('PASSWORD', '');
}

// Kết nối đến cơ sở dữ liệu
$con = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);

// Kiểm tra kết nối
if ($con->connect_error) {
    die("Kết nối thất bại: " . $con->connect_error);
}

// Yêu cầu file dbhelp.php để tái sử dụng các hàm
require_once('dbhelp.php');
?>
