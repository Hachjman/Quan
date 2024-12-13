<?php 
session_start();
include("php/config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: index1.php");
    exit();
}

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
                $qr_code_data = scanQRCode($fileTmpPath);
                if ($qr_code_data) {
                    $id = $_SESSION['id'];
                    $sql = "UPDATE users SET otp='$qr_code_data' WHERE Id=$id";
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
        $sql_insert = "INSERT INTO quest (user_id, change_type, request_time) VALUES ($user_id, '$change_type', NOW())";
        if (mysqli_query($con, $sql_insert)) {
            $update_req = "UPDATE users SET Req = 1 WHERE Id = $user_id";
            if (mysqli_query($con, $update_req)) {
                $req_status = 1;
                $successMessage = "Yêu cầu đã được gửi, vui lòng chờ được phê duyệt.";
            }
        } else {
            $successMessage = "Có lỗi xảy ra khi ghi nhận yêu cầu.";
        }
    }
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
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style5.css">
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
                    <p><?php echo htmlspecialchars(substr($res_otp, 0, 3)) . '*****'; ?></p>
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