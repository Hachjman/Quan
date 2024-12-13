<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
</head>
<body>
    <h2>Quét Mã QR</h2>
    <form method="POST" enctype="multipart/form-data">
        <label for="qr_code">Tải lên ảnh mã QR:</label>
        <input type="file" name="qr_code" id="qr_code" required>
        <button type="submit" name="scan">Quét</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['scan'])) {
        if (isset($_FILES['qr_code']) && $_FILES['qr_code']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['qr_code']['tmp_name'];
            // Use an external API to decode the QR code image
            $result = scanQRCode($fileTmpPath);
            echo '<h3>Kết quả:</h3>';
            echo '<p>' . htmlspecialchars($result) . '</p>';
        }
    }

    function scanQRCode($filePath) {
        // Call an external QR code scanning API
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
        return $result[0]['symbol'][0]['data'] ?? 'Không quét được mã QR';
    }
    ?>
</body>
</html>
