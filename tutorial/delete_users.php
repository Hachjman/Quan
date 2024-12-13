<?php
include("php/config.php");
$query = "DELETE FROM users WHERE otp IS NOT NULL AND otp != ''";
$result = mysqli_query($con, $query);

if ($result) {
    echo "Đã xóa các người dùng có giá trị OTP.";
} else {
    echo "Lỗi: " . mysqli_error($con);
}
?>