<?php
session_start();
include("php/config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: index1.php");
    exit();
}

$userId = $_SESSION['id'];

$query = mysqli_query($con, "SELECT * FROM quiz_history WHERE user_id = $userId ORDER BY date_taken DESC LIMIT 1");
$result = mysqli_fetch_assoc($query);

if ($result) {
    $subject = htmlspecialchars($result['subject']);
    $score = htmlspecialchars($result['score']);
    $dateTaken = htmlspecialchars($result['date_taken']);
} else {

    $subject = "Không có thông tin bài làm.";
    $score = "0";
    $dateTaken = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả Bài Làm</title>
    <link rel="stylesheet" href="style/style1.css">
    <link rel="stylesheet" href="style/style2.css">
</head>
<body>
    <div class="container">
        <h2>Kết Quả Bài Làm</h2>
        <p>Môn Học: <?= $subject ?></p>
        <p>Điểm: <?= $score ?></p>
        <p>Ngày Làm: <?= $dateTaken ?></p>
        <a href="home.php" class="btn btn-secondary">Trở về Trang Chủ</a>
    </div>
</body>
</html>
