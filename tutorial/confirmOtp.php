<?php
session_start();
include("php/config.php");

$error_message = "";
$success_message = "";
$scanned_data = "";
$db_otp = "";

if (isset($_POST['quick_login'])) {
    if (isset($_FILES['qr_code']) && $_FILES['qr_code']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['qr_code']['tmp_name'];
        $fileName = $_FILES['qr_code']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
        
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $qr_code_data = scanQRCode($fileTmpPath);
            if ($qr_code_data) {
                $scanned_data = htmlspecialchars($qr_code_data);
                $sql = "SELECT * FROM users WHERE otp = '$qr_code_data'";
                $query = mysqli_query($con, $sql);

                if ($query) {
                    if (mysqli_num_rows($query) > 0) {
                        $user = mysqli_fetch_assoc($query);
                        $_SESSION['valid'] = true;
                        $_SESSION['id'] = $user['Id'];
                        header("Location: home.php");
                        exit();
                    } else {
                        $error_message = "Sai mã QR.";
                    }
                } else {
                    $error_message = "Lỗi khi truy vấn cơ sở dữ liệu: " . mysqli_error($con);
                }
            } else {
                $error_message = "Không quét được mã QR từ ảnh.";
            }
        } else {
            $error_message = "Định dạng file không hợp lệ. Vui lòng tải lên file hình ảnh.";
        }
    }
}

function scanQRCode($filePath) {
    $apiUrl = 'https://api.qrserver.com/v1/read-qr-code/';
    $fileData = new CURLFile($filePath);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => $fileData]);
    $response = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($response, true);
    return $result[0]['symbol'][0]['data'] ?? null;
}

// Include this at the end to handle any error messages
if (!empty($error_message)) {
    echo "<div class='error-message'>$error_message</div>";
}
?>
