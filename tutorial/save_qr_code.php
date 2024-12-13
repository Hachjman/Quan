<?php
session_start();
include("php/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $encodedQRCode = $_POST['otp']; 
    $userId = $_SESSION['id']; 

    $query = "UPDATE users SET otp = ? WHERE Id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("si", $encodedQRCode, $userId);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "Mã QR đã được lưu thành công."]);
    } else {
        echo json_encode(["message" => "Lỗi khi lưu mã QR."]);
    }
}
?><script>
function saveQRCode(encodedString) {
    fetch('save_qr_code.php', { // Đường dẫn đến tệp PHP của bạn
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'otp=' + encodeURIComponent(encodedString),
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message); // Tùy chọn: xử lý phản hồi
    })
    .catch(error => console.error('Error:', error));
}
</script>