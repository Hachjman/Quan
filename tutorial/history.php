<?php
session_start();
include("php/config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: index1.php");
    exit();
}

$userId = $_SESSION['id'];
$query = "SELECT * FROM quiz_history WHERE user_id = $userId ORDER BY date_taken DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử Làm Bài</title>
    <link rel="stylesheet" href="style/style1.css">
    <link rel="stylesheet" href="style/style2.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Lịch sử Làm Bài</h2>

        <?php if (mysqli_num_rows($result) > 0) { ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Môn Học</th>
                        <th>Điểm</th>
                        <th>Thời Gian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $index++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['score']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['date_taken']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-info" role="alert">
                Bạn chưa có lịch sử làm bài nào.
            </div>
        <?php } ?>

        <a href="trangchu.php" class="btn btn-secondary">Trở về Trang Chủ</a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
