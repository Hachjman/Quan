<?php
session_start();
include("php/config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: index1.php");
    exit();
}

// Khóa bí mật (nên được lưu trữ an toàn)
$secretKey = 'your-secret-key-here'; // Thay thế bằng khóa bí mật của bạn

$successMessage = '';
$res_Uname = '';
$res_Email = '';
$res_Age = '';
$res_cccd = '';
$req_status = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['scan'])) {
        if (isset($_FILES['qr_code']) && $_FILES['qr_code']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['qr_code']['tmp_name'];
            $fileName = $_FILES['qr_code']['name'];
            $fileSize = $_FILES['qr_code']['size'];
            $fileType = $_FILES['qr_code']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                // Call the QR code scanning function
                $qr_code_data = scanQRCode($fileTmpPath);
                if ($qr_code_data) {
                    $id = $_SESSION['id'];
                    $encryptedOtp = encrypt($qr_code_data, $secretKey); // Mã hóa mã OTP
                    $sql = "UPDATE users SET otp='$encryptedOtp' WHERE Id=$id";
                    if (mysqli_query($con, $sql)) {
                        $successMessage = "Mã QR đã được quét và lưu thành công!";
                    } else {
                        $successMessage = "Có lỗi xảy ra khi lưu mã QR.";
                    }
                } else {
                    $successMessage = "Không quét được mã QR từ ảnh.";
                }
            } else {
                $successMessage = "Định dạng file không hợp lệ. Vui lòng tải lên file hình ảnh.";
            }
        }
    }

    if (isset($_POST['request'])) {
        $user_id = $_SESSION['id'];
        $change_type = 'Request QR Code Resend';

        // Insert into quest table
        $sql_insert = "INSERT INTO quest (user_id, change_type, request_time) VALUES ($user_id, '$change_type', NOW())";
        if (mysqli_query($con, $sql_insert)) {
            // Update Req to 1 in users table
            $update_req = "UPDATE users SET Req = 1 WHERE Id = $user_id";
            if (mysqli_query($con, $update_req)) {
                $req_status = 1; // Immediately update the $req_status variable
                $successMessage = "Yêu cầu đã được gửi, vui lòng chờ được phê duyệt.";
            }
        } else {
            $successMessage = "Có lỗi xảy ra khi ghi nhận yêu cầu.";
        }
    }

    // Optional: Redirect to avoid form resubmission
    header("Location: home.php");
    exit();
}

$id = $_SESSION['id'];
$query = mysqli_query($con, "SELECT * FROM users WHERE Id = $id");
if ($query) {
    while ($result = mysqli_fetch_assoc($query)) {
        $res_Uname = $result['Username'];
        $res_Email = $result['Email'];
        $res_Age = $result['Age'];
        $res_cccd = $result['CCCD'];
        $res_otp = $result['otp'];
        $req_status = $result['Req'];
    }
}

// Hàm mã hóa
function encrypt($plaintext, $secretKey) {
    $ivLength = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($ivLength);
    $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $secretKey, 0, $iv);
    return base64_encode($iv . $ciphertext);
}

// Hàm giải mã
function decrypt($ciphertext, $secretKey) {
    $ciphertext = base64_decode($ciphertext);
    $ivLength = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($ciphertext, 0, $ivLength);
    $ciphertext = substr($ciphertext, $ivLength);
    return openssl_decrypt($ciphertext, 'aes-256-cbc', $secretKey, 0, $iv);
}

// Function to scan QR code using an external API
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

    // Process the response
    $result = json_decode($response, true);
    return $result[0]['symbol'][0]['data'] ?? null;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Hồ sơ người dùng</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="trangchu.php" style="color: white; text-decoration: none;">TRANG CHỦ</a></p>
        </div>
        <div class="right-links">
            <?php 
            $query = mysqli_query($con, "SELECT * FROM users WHERE Id = $id");
            while ($result = mysqli_fetch_assoc($query)) {
                $res_id = $result['Id'];
                echo "<a href='edit.php?Id=$res_id' style='color: white; margin-right: 15px;'>Thay đổi hồ sơ</a>";
            }
            ?>
            <a href="php/logout.php"> <button class="btn">Đăng xuất</button> </a>
        </div>
    </div>
    
    <div class="main-box">
        <h2>Hồ sơ người dùng</h2>
        <?php if (!empty($successMessage)) : ?>
            <p style="color: green; font-weight: bold;"><?php echo $successMessage; ?></p>
        <?php endif; ?>
        <div>
            <label>Username: </label><?php echo htmlspecialchars($res_Uname); ?><br>
            <label>Email: </label><?php echo htmlspecialchars($res_Email); ?><br>
            <label>CCCD: </label><?php echo htmlspecialchars($res_cccd); ?><br>
            <label>Tuổi: </label><?php echo htmlspecialchars($res_Age); ?><br>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div>
                <?php if (empty($res_otp)) : ?>
                    <label>Tải lên mã QR:</label>
                    <input type="file" name="qr_code" required>
                    <button type="submit" name="scan">Quét</button>
                <?php else: ?>
                    <label>Mã QR đã lưu:</label>
                    <p><?php echo htmlspecialchars(substr(decrypt($res_otp, $secretKey), 0, 3)) . '*****'; ?></p>
                    <?php if ($req_status == 0) : ?>
                        <button type="submit" name="request">Xin phép tải lại mã QR</button>
                    <?php else: ?>
                        <p>Yêu cầu đã được gửi, vui lòng chờ được phê duyệt</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </form>
    </div>
</body>
</html>
