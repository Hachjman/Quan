<?php
require_once('php/config.php');

/**
 * Hàm kết nối cơ sở dữ liệu
 */
function getDbConnection() {
    // tạo kết nối tới database
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
    }

    return $conn;
}

/**
 * Hàm thực thi lệnh insert, update, delete
 */
function execute($sql) {
    // Kết nối tới database
    $conn = getDbConnection();

    // Thực hiện truy vấn
    if (mysqli_query($conn, $sql)) {
        // Đóng kết nối và trả về thành công
        mysqli_close($conn);
        return true;
    } else {
        // In ra lỗi nếu truy vấn thất bại
        echo "Lỗi: " . mysqli_error($conn);
        // Đóng kết nối và trả về thất bại
        mysqli_close($conn);
        return false;
    }
}

/**
 * Hàm thực thi lệnh select để trả về nhiều bản ghi
 */
function executeResult($sql) {
    // Kết nối tới database
    $conn = getDbConnection();

    // Thực hiện truy vấn
    $resultset = mysqli_query($conn, $sql);
    $list = [];

    if ($resultset) {
        while ($row = mysqli_fetch_array($resultset, 1)) {
            $list[] = $row;
        }
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

    // Đóng kết nối
    mysqli_close($conn);

    return $list;
}

/**
 * Hàm thực thi lệnh select để trả về một bản ghi duy nhất
 */
function executeSingleResult($sql) {
    // Kết nối tới database
    $conn = getDbConnection();

    // Thực hiện truy vấn
    $resultset = mysqli_query($conn, $sql);
    $row = null;

    // Lấy kết quả một bản ghi duy nhất
    if ($resultset) {
        $row = mysqli_fetch_array($resultset, 1);
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

    // Đóng kết nối
    mysqli_close($conn);

    return $row;
}
?>
